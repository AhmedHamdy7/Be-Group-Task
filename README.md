<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Task Manager API

This is a RESTful API for managing tasks, built with Laravel 10.x. It supports essential CRUD operations and features like filtering and pagination.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [API Endpoints](#api-endpoints)
- [Testing](#testing)
- [Optional Features](#optional-features)
- [Contributing](#contributing)

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL or another supported database

## Installation

1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd TaskManager

2. **Install dependencies::**
composer install

3. **Copy the example environment file:**
cp .env.example .env

4. **Generate the application key:**
php artisan key:generate

**Configuration:**
Update your .env file with your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kingbus
DB_USERNAME=root
DB_PASSWORD=

**Database Setup:**

1. **Run migrations to create the tasks table:**
php artisan migrate

1. **Seed the database:**
php artisan db:seed

**API Endpoints:**
The following endpoints are available for managing tasks:

GET /api/v1/tasks: Fetch all tasks
GET /api/v1/tasks/{id}: Fetch a single task by ID
POST /api/v1/tasks: Create a new task
PUT/PATCH /api/v1/tasks/{id}: Update an existing task
DELETE /api/v1/tasks/{id}: Soft delete a task

Alternatively, you can use the request documentation:
http://127.0.0.1:8000/request-docs


**Request and Response Format:**
**Request Body (for POST/PUT/PATCH):**
{
  "status": "success",
  "message": "resource fetched successfully",
  {
  "name": "ahmed hmady",
  "email": "ahmed.hamdy@test.com",
  "password": "123456789",
  "password_confirmation": "123456789"
}
}
**Response (for GET):**
{
  "status": "success",
  "message": "resource fetched successfully",
  "data": [
    {
      "id": 21,
      "name": "Qui consequuntur ut mollitia.",
      "description": "Optio repellat fugiat nostrum officia. Non nisi earum blanditiis atque. Enim doloremque rerum architecto sint in itaque. Et nulla voluptas minus voluptatem. Ratione vitae optio quos nostrum.",
      "status": "pending",
      "created_at": "2025-02-12T12:42:04.000000Z",
      "updated_at": "2025-02-12T12:42:04.000000Z"
    },
    {
      "id": 22,
      "name": "Dicta ea voluptas doloribus ut.",
      "description": "Laboriosam veritatis rerum quia delectus delectus quia. Eius dolor quis suscipit sunt numquam porro. Doloremque qui iure sunt commodi. Magnam sunt qui est sint dolores quod et.",
      "status": "completed",
      "created_at": "2025-02-12T12:42:04.000000Z",
      "updated_at": "2025-02-12T12:42:04.000000Z"
    }
  ]
}

**Optional Features:**
Filtering: Filter tasks using query parameters, e.g., /api/tasks?status=pending.
Pagination: Tasks are paginated by default.
Resource Classes: Use resource classes to shape responses.
