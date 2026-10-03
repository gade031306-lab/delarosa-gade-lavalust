<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->database();
        $this->call->model('ProductModel');
    }

    // GET /products
    public function index()
    {
        $this->api->require_method('GET');

        $products = $this->ProductModel->all();

        $this->api->respond($products);
    }

    // GET /products/{id}
    public function show($id)
    {
        $this->api->require_method('GET');

        $product = $this->ProductModel->find($id);

        if (!$product) {
            $this->api->respond_error('Product not found', 404);
        }

        $this->api->respond($product);
    }

    // POST /products
    public function store()
    {
        $this->api->require_method('POST');

        $input = $this->api->body();

        if (
            empty($input['product_name']) ||
            !isset($input['description']) ||
            !isset($input['price']) ||
            !isset($input['quantity'])
        ) {
            $this->api->respond_error('All product fields are required', 400);
        }

        $data = [
            'product_name' => $input['product_name'],
            'description'  => $input['description'],
            'price'        => $input['price'],
            'quantity'     => $input['quantity']
        ];

        $this->ProductModel->insert($data);

        $this->api->respond([
            'message' => 'Product created successfully'
        ], 201);
    }

    // PUT /products/{id}
    public function update($id)
    {
        $this->api->require_method('PUT');

        $product = $this->ProductModel->find($id);

        if (!$product) {
            $this->api->respond_error('Product not found', 404);
        }

        $input = $this->api->body();

        $data = [
            'product_name' => $input['product_name'] ?? $product->product_name,
            'description'  => $input['description'] ?? $product->description,
            'price'        => $input['price'] ?? $product->price,
            'quantity'     => $input['quantity'] ?? $product->quantity
        ];

        $this->ProductModel->update($id, $data);

        $this->api->respond([
            'message' => 'Product updated successfully'
        ]);
    }

    // DELETE /products/{id}
    public function delete($id)
    {
        $this->api->require_method('DELETE');

        $product = $this->ProductModel->find($id);

        if (!$product) {
            $this->api->respond_error('Product not found', 404);
        }

        $this->ProductModel->delete($id);

        $this->api->respond([
            'message' => 'Product deleted successfully'
        ]);
    }
}