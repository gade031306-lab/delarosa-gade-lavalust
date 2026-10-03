<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

if (!function_exists('handle_cors')) {
    function handle_cors()
    {
        header('Content-Type: application/json; charset=utf-8');

        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        $configuredOrigins = (string) (config_item('allow_origin') ?: '*');
        $allowedOrigins = array_map('trim', explode(',', $configuredOrigins));

        if (in_array('*', $allowedOrigins, true)) {
            header('Access-Control-Allow-Origin: *');
        } elseif (
            $origin !== '' &&
            in_array($origin, $allowedOrigins, true)
        ) {
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Vary: Origin');
        }

        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
            http_response_code(204);
            exit;
        }
    }
}
