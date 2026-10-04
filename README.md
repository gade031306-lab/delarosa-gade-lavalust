# LavaLust Framework

> A lightweight, fast PHP framework built for developers who want clean MVC architecture without unnecessary complexity or performance overhead.

Updated by Gade Dela Rosa - Laboratory Exercise No.2
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-8892BF)](https://www.php.net/)
[![GitHub Stars](https://img.shields.io/github/stars/ronmarasigan/lavalust?style=flat)](https://github.com/ronmarasigan/lavalust/stargazers)

---

## Overview

**LavaLust** is an open-source PHP framework that follows the **MVC (Model–View–Controller)** architectural pattern. It is designed for developers who need a structured, maintainable, and scalable foundation — without the bloat of heavier modern frameworks.

Whether you are building a simple web application, a REST API, or a teaching project, LavaLust provides the right tools with minimal friction.

---

## Features

| Feature | Description |
|---|---|
| **MVC Architecture** | Clean separation of Models, Views, and Controllers for organized, maintainable code |
| **Built-in Routing** | Flexible URL routing that maps requests to controllers with minimal configuration |
| **Libraries & Helpers** | Reusable components for sessions, forms, validation, and database access |
| **Modular Design** | Scalable structure that supports clean organization as your application grows |
| **REST API Support** | First-class support for building RESTful APIs using LavaLust conventions |
| **ORM-like Models** | Simplified, readable database interaction without a heavy abstraction layer |

---

## Requirements

- PHP 7.4 or higher
- A web server with URL rewriting support (Apache `.htaccess` or Nginx config)
- Composer (optional, for dependency management)

---

## Installation

**Clone the repository:**

```bash
git clone https://github.com/ronmarasigan/lavalust.git
cd lavalust
```

**Or download a release directly:**

```bash
wget https://github.com/ronmarasigan/lavalust/archive/refs/heads/main.zip
unzip main.zip
```

Configure your web server to point to the project root and ensure `mod_rewrite` (Apache) or equivalent is enabled.

---

## Quick Start

### 1. Define a Route

**File:** `app/config/routes.php`

```php
$router->get('/', 'Welcome::index');
$router->get('/about', 'Welcome::about');
$router->post('/users/store', 'Users::store');
```

### 2. Create a Controller

**File:** `app/controllers/Welcome.php`

```php
<?php

class Welcome extends Controller
{
    public function index()
    {
        $data['title'] = 'Home';
        $this->call->view('welcome', $data);
    }

    public function about()
    {
        $this->call->view('about');
    }
}
```

### 3. Create a View

**File:** `app/views/welcome.php`

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>
    <h1>Welcome to LavaLust Framework</h1>
    <p>Lightweight. Fast. MVC.</p>
</body>
</html>
```

### 4. Create a Model

**File:** `app/models/User_model.php`

```php
<?php

class User_model extends Model
{
    protected $table = 'users';

    public function getAll()
    {
        return $this->db->table($this->table)->get()->getResult();
    }

    public function findById(int $id)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get()
    }
}
```

---

## Project Structure

```
lavalust/
├── app/
│   ├── config/          # Application configuration (database, routes, etc.)
│   ├── controllers/     # Controller classes
│   ├── models/          # Model classes
│   ├── views/           # View templates
│   └── libraries/       # Custom libraries and helpers
├── scheme/              # Core framework files (do not modify)
├── public/              # Publicly accessible entry point
│   └── index.php
└── runtime/            # Cache, logs, and uploads (must be writable)
```

---

## Configuration

### Database

**File:** `app/config/database.php`

```php
$database['main'] = array(
    'driver'	=> '',
    'hostname'	=> getenv('DB_HOST') ?: '',
    'port'		=> getenv('DB_PORT') ?: '',
    'username'	=> getenv('DB_USERNAME') ?: '',
    'password'	=> getenv('DB_PASSWORD') ?: '',
    'database'	=> getenv('DB_NAME') ?: '',
    'charset'	=> '',
    'dbprefix'	=> '',
    // Optional for SQLite
    'path'      => ''
);
```

### Base URL

**File:** `app/config/config.php`

```php
$config['base_url'] = 'http://localhost:3000/';
```

---

## Building a REST API

LavaLust supports REST API development out of the box. Controllers can return JSON responses for API endpoints.

```php
<?php

class Api extends Controller
{
    $this->call->library('api');

    public function users()
    {
        $this->api->require_method('GET');
        $auth = $this->api->require_jwt(); 

        $this->call->model('User_model');
        $users = $this->User_model->getAll();

        $this->api->respond(['data' => $users]);
    }
}
```

Route definition:

```php
$router->get('/api/users', 'Api::users');
```

---

## Philosophy

LavaLust is built on a single principle: **minimal core, maximum control.**

Modern frameworks often add layers of abstraction that benefit large enterprise teams but get in the way of developers who want to understand exactly what their code is doing. LavaLust provides structure and utilities without hiding the underlying logic — making it an excellent choice for:

- **Rapid prototyping** — Get an application running in minutes
- **Learning MVC** — Understand how each architectural layer works
- **Lightweight production apps** — Deploy without dragging in unused dependencies
- **Teaching PHP development** — Clear conventions, readable source code

---

## Documentation

Full documentation is available at **[https://lavalust.netlify.app](https://lavalust.netlify.app)**

Topics covered include:

- Installation and server configuration
- Routing: static, dynamic, and grouped routes
- Controllers and request handling
- Models and query builder
- Views, layouts, and partials
- Built-in libraries (sessions, form validation, file upload)
- Helper functions
- REST API development
- Security best practices

---

## Contributing

Contributions are welcome. To contribute:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m "Add your feature description"`
4. Push to your branch: `git push origin feature/your-feature-name`
5. Open a pull request against `main`

Please ensure your code follows the existing style conventions and includes relevant documentation or comments where appropriate.

---

## Roadmap

- [ ] CLI tool for generating controllers, models, and migrations
- [ ] Middleware support
- [ ] Improved query builder with relationship support
- [ ] Enhanced error handling and debugging tools

---

## License

LavaLust Framework is open-source software licensed under the **[MIT License](https://opensource.org/licenses/MIT)**.

---

## Links

- **GitHub Repository:** [https://github.com/ronmarasigan/lavalust](https://github.com/ronmarasigan/lavalust)
- **Documentation:** [https://lavalust.netlify.app](https://lavalust.netlify.app)
- **Report an Issue:** [https://github.com/ronmarasigan/lavalust/issues](https://github.com/ronmarasigan/lavalust/issues)

---

## Product Management Lab

This repository contains a LavaLust API and a React/Vite client for the product CRUD activity.

### Run locally

1. Configure the backend `.env` with `APP_ENV=development`, `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE`, `JWT_SECRET`, and `REFRESH_TOKEN_KEY`. Generate independent JWT secrets with `php lava jwt:generate`.
2. Apply the database migrations with `php lava migration run`.
3. Start LavaLust with `php lava serve`.
4. In `frontend`, copy `.env.example` to `.env`, install dependencies with `npm install`, and run `npm run dev`.

The API is available at `http://127.0.0.1:3000`; the Vite client reads its API base address from `VITE_API_URL`.

### API endpoints

| Method | Endpoint | Authentication |
|---|---|---|
| POST | `/api/auth/register` | Public |
| POST | `/api/auth/login` | Public |
| POST | `/api/auth/refresh` | Refresh token in JSON body |
| POST | `/api/auth/logout` | Bearer access token and refresh token |
| GET | `/api/products` | Bearer access token |
| GET | `/api/products/{id}` | Bearer access token |
| POST | `/api/products` | Bearer access token |
| PUT or PATCH | `/api/products/{id}` | Bearer access token |
| DELETE | `/api/products/{id}` | Bearer access token |

Product requests use JSON. The products API returns JSON arrays/objects and JSON error responses. The root URL (`/`) provides an API overview, and `/health` returns the machine-readable JSON health response. HTTP migration routes are intended for local development only; production migrations should be run from the Render shell/CLI.

### Deployment

- **Render:** Deploy the LavaLust repository using its Dockerfile. Set `APP_ENV=production`, `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE`, `JWT_SECRET`, `REFRESH_TOKEN_KEY`, and `FRONTEND_ORIGIN` in the Render service environment. `FRONTEND_ORIGIN` must be the exact deployed Vercel origin (for example, `https://your-project.vercel.app`).
- **Vercel:** Import this repository and set the project root directory to `frontend`. Add `VITE_API_URL` with the Render API base URL (for example, `https://your-api.onrender.com`, without `/api` at the end).
- Keep database credentials and token secrets only in local ignored `.env` files or deployment environment settings. Never put secrets in frontend variables; Vite variables are public in the browser bundle.

After setting the Render database environment variables, run `php lava migration run` from the Render shell before testing registration and product operations.
