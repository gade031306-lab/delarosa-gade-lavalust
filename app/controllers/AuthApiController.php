<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->database();
        $this->call->model('UsersModel');
        $this->call->library('api');
    }

    public function options()
    {
        $this->api->respond([], 204);
    }

    public function login()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();

        $username = trim((string) ($input['username'] ?? ''));
        $password = (string) ($input['password'] ?? '');

        if ($username === '' || $password === '') {
            $this->api->respond_error('Username and password are required', 400);
        }

        $statement = $this->UsersModel->raw(
            'SELECT id, username, password, role, is_active FROM users WHERE username = ? LIMIT 1',
            [$username]
        );
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (
            !$user ||
            !(bool) $user['is_active'] ||
            !password_verify($password, $user['password'])
        ) {
            $this->api->respond_error('Invalid username or password', 401);
        }

        $tokens = $this->api->issue_tokens([
            'id' => $user['id'],
            'role' => $user['role'],
        ]);

        $this->api->respond([
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
            ],
            'tokens' => $tokens,
        ]);
    }

    public function register()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();

        $username = trim((string) ($input['username'] ?? ''));
        $email = trim((string) ($input['email'] ?? ''));
        $password = (string) ($input['password'] ?? '');

        if ($username === '' || strlen($username) > 100) {
            $this->api->respond_error(
                'Username is required and must be at most 100 characters',
                400
            );
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
            $this->api->respond_error('A valid email address is required', 400);
        }

        if (strlen($password) < 8) {
            $this->api->respond_error('Password must be at least 8 characters', 400);
        }

        $existing = $this->UsersModel->raw(
            'SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1',
            [$username, $email]
        )->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $this->api->respond_error(
                'Username or email is already registered',
                409
            );
        }

        $this->UsersModel->insert([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'user',
            'is_active' => 1,
        ]);

        $user = $this->UsersModel->raw(
            'SELECT id, username, role FROM users WHERE username = ? LIMIT 1',
            [$username]
        )->fetch(PDO::FETCH_ASSOC);

        $tokens = $this->api->issue_tokens([
            'id' => $user['id'],
            'role' => $user['role'],
        ]);

        $this->api->respond([
            'message' => 'Account created successfully',
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
            ],
            'tokens' => $tokens,
        ], 201);
    }

    public function refresh()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();
        $refreshToken = $input['refresh_token'] ?? '';

        if (!is_string($refreshToken) || $refreshToken === '') {
            $this->api->respond_error('Refresh token is required', 400);
        }

        $this->api->refresh_access_token($refreshToken);
    }

    public function logout()
    {
        $this->api->require_method('POST');
        $payload = $this->api->require_jwt();
        $input = $this->api->body();
        $refreshToken = $input['refresh_token'] ?? '';

        if (!is_string($refreshToken) || $refreshToken === '') {
            $this->api->respond_error('Refresh token is required', 400);
        }

        $refreshPayload = $this->api->validate_jwt($refreshToken, 'refresh');
        if (
            !$refreshPayload ||
            (string) $refreshPayload['sub'] !== (string) $payload['sub']
        ) {
            $this->api->respond_error('Invalid refresh token', 400);
        }

        $this->api->revoke_refresh_token($refreshToken);
        $this->api->respond(['message' => 'Logged out successfully']);
    }
}
