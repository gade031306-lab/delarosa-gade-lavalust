<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/
/** @var object $router **/
// API landing page and machine-readable health check
$router->get('/', 'Welcome::index');
$router->get('/health', 'ProductApiController::health');

$router->get(
    '/login',
    'AuthController::login'
);

$router->post(
    '/login/authenticate',
    'AuthController::authenticate'
);


// Registration
$router->get(
    '/register',
    'AuthController::register'
);

$router->post(
    '/register/store',
    'AuthController::store'
);


// Logout
$router->get(
    '/logout',
    'AuthController::logout'
);


// ================================================================
// AUTHENTICATED WEB ROUTES
// ================================================================

// ------------------------------------------------
// Student Dashboard
// ------------------------------------------------

$router->get(
    '/student',
    'StudentController::index'
)->middleware('auth');

$router->get(
    '/student/profile',
    'StudentController::profile'
)->middleware('auth');


// ------------------------------------------------
// Users
// ------------------------------------------------

$router->get(
    '/users',
    'UsersController::index'
)->middleware('auth');


// ------------------------------------------------
// Products - WEB CRUD
// ------------------------------------------------

// Product List
$router->get(
    '/products',
    'ProductController::index'
)->middleware('auth');

// Create Product Page
$router->get(
    '/products/create',
    'ProductController::create'
)->middleware('auth');

// Create Product
$router->post(
    '/products/store',
    'ProductController::store'
)->middleware('auth');

// Edit Product Page
$router->get(
    '/products/edit/{id}',
    'ProductController::edit'
)->middleware('auth');

// Update Product
$router->post(
    '/products/update/{id}',
    'ProductController::update'
)->middleware('auth');

// Delete Product
$router->get(
    '/products/delete/{id}',
    'ProductController::delete'
)->middleware('auth');


// ================================================================
// PRODUCT API ROUTES
// ================================================================

// Token authentication for browser and API clients
$router->post(
    '/api/auth/login',
    'AuthApiController::login'
);

$router->post(
    '/api/auth/register',
    'AuthApiController::register'
);

$router->post(
    '/api/auth/refresh',
    'AuthApiController::refresh'
);

$router->post(
    '/api/auth/logout',
    'AuthApiController::logout'
);

// CORS preflight for cross-origin browser clients.
$router->options('/api/auth/login', 'AuthApiController::options');
$router->options('/api/auth/register', 'AuthApiController::options');
$router->options('/api/auth/refresh', 'AuthApiController::options');
$router->options('/api/auth/logout', 'AuthApiController::options');
$router->options('/api/products', 'ProductApiController::options');
$router->options('/api/products/{id}', 'ProductApiController::options');

// Get all products
$router->get(
    '/api/products',
    'ProductApiController::index'
);

// Get single product
$router->get(
    '/api/products/{id}',
    'ProductApiController::show'
);

// Create product
$router->post(
    '/api/products',
    'ProductApiController::store'
);

// Update product
$router->put(
    '/api/products/{id}',
    'ProductApiController::update'
);

$router->patch(
    '/api/products/{id}',
    'ProductApiController::update'
);

// Delete product
$router->delete(
    '/api/products/{id}',
    'ProductApiController::delete'
);


// ================================================================
// MIGRATION ROUTES
// ================================================================
$router->get(
    'create-migration/{migration_class}',
    'MigrationController::create_migration'
);

$router->get(
    'migrate',
    'MigrationController::migrate'
);

$router->get(
    'rollback',
    'MigrationController::rollback'
);

$router->get(
    'rollback-all',
    'MigrationController::rollback_all'
);

$router->get(
    'refresh',
    'MigrationController::refresh'
);

$router->get(
    'status',
    'MigrationController::status'
);