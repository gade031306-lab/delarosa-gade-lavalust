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

    public function index()
    {
        $products = $this->ProductModel->all();

        $data['products'] = $products;

        $this->call->view('products/index', $data);
    }
}