<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Start session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Require login
        if (!isset($_SESSION['user_id'])) {
            redirect('login');
            exit;
        }

        // Database and Model
        $this->call->database();
        $this->call->model('ProductModel');
    }

    // READ
    public function index()
    {
        $products = $this->ProductModel->all();

        $data['products'] = $products;

        $this->call->view('products/index', $data);
    }

    // CREATE - Show Form
    public function create()
    {
        $this->call->view('products/create');
    }

    // CREATE - Save
    public function store()
    {
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity')
        ];

        $this->ProductModel->insert($data);

        redirect('products');
    }

    // UPDATE - Show Form
    public function edit($id)
    {
        $product = $this->ProductModel->find($id);

        $data['product'] = $product;

        $this->call->view('products/edit', $data);
    }

    // UPDATE - Save
    public function update($id)
    {
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity')
        ];

        $this->ProductModel->update($id, $data);

        redirect('products');
    }

    // DELETE
    public function delete($id)
    {
        $this->ProductModel->delete($id);

        redirect('products');
    }
}