<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->database();
        $this->call->model('ProductModel');
        $this->call->library('api');
    }

    // GET /
    public function health()
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'status' => 'ok',
            'service' => 'LavaLust Products API',
            'endpoints' => [
                'login' => '/api/auth/login',
                'register' => '/api/auth/register',
                'products' => '/api/products',
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function options()
    {
        $this->api->respond([], 204);
    }

    // GET /api/products
    public function index()
    {
        $this->api->require_method('GET');
        $this->api->require_jwt();

        $products = $this->ProductModel->all();

        $this->api->respond($products);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $this->api->require_method('GET');
        $this->api->require_jwt();
        $id = $this->validated_id($id);

        $product = $this->ProductModel->find($id);

        if (!$product) {
            $this->api->respond_error('Product not found', 404);
        }

        $this->api->respond($product);
    }

    // POST /api/products
    public function store()
    {
        $this->api->require_method('POST');
        $this->api->require_jwt();

        $input = $this->api->body();
        $data = $this->validated_product($input);

        $this->ProductModel->insert($data);

        $this->api->respond([
            'message' => 'Product created successfully'
        ], 201);
    }

    // PUT /api/products/{id}
    public function update($id)
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? '');
        if (!in_array($method, ['PUT', 'PATCH'], true)) {
            $this->api->respond_error('Method Not Allowed', 405);
        }

        $this->api->require_jwt();
        $id = $this->validated_id($id);

        $product = $this->ProductModel->find($id);

        if (!$product) {
            $this->api->respond_error(
                'Product not found',
                404
            );
        }

        $input = $this->api->body();
        $data = $this->validated_product($input, $product);

        $this->ProductModel->update($id, $data);

        $this->api->respond([
            'message' => 'Product updated successfully'
        ]);
    }

    // DELETE /api/products/{id}
    public function delete($id)
    {
        $this->api->require_method('DELETE');
        $this->api->require_jwt();
        $id = $this->validated_id($id);

        $product = $this->ProductModel->find($id);

        if (!$product) {
            $this->api->respond_error(
                'Product not found',
                404
            );
        }

        $this->ProductModel->delete($id);

        $this->api->respond([
            'message' => 'Product deleted successfully'
        ]);
    }

    private function validated_id($id)
    {
        $validated = filter_var($id, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1]
        ]);

        if ($validated === false) {
            $this->api->respond_error('Invalid product ID', 400);
        }

        return $validated;
    }

    private function validated_product(array $input, $existing = null)
    {
        $fields = ['product_name', 'description', 'price', 'quantity'];
        $data = [];

        foreach ($fields as $field) {
            if (array_key_exists($field, $input)) {
                $data[$field] = $input[$field];
            } elseif ($existing === null) {
                $this->api->respond_error("The {$field} field is required", 400);
            }
        }

        if ($existing !== null && !$data) {
            $this->api->respond_error('At least one product field is required', 400);
        }

        if (array_key_exists('product_name', $data)) {
            if (
                !is_string($data['product_name']) ||
                trim($data['product_name']) === '' ||
                strlen($data['product_name']) > 100
            ) {
                $this->api->respond_error(
                    'Product name must be between 1 and 100 characters',
                    400
                );
            }
        }

        if (
            array_key_exists('description', $data) &&
            !is_string($data['description'])
        ) {
            $this->api->respond_error('Description must be text', 400);
        }

        if (array_key_exists('price', $data)) {
            if (!is_numeric($data['price']) || (float) $data['price'] < 0) {
                $this->api->respond_error(
                    'Price must be a non-negative number',
                    400
                );
            }

            $data['price'] = number_format((float) $data['price'], 2, '.', '');
        }

        if (array_key_exists('quantity', $data)) {
            $quantity = filter_var($data['quantity'], FILTER_VALIDATE_INT);
            if ($quantity === false || $quantity < 0) {
                $this->api->respond_error(
                    'Quantity must be a non-negative integer',
                    400
                );
            }

            $data['quantity'] = $quantity;
        }

        if ($existing !== null) {
            foreach ($fields as $field) {
                if (!array_key_exists($field, $data)) {
                    $data[$field] = $existing->$field;
                }
            }
        }

        return $data;
    }
}