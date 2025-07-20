# Boilerplate Laravel 12

This project is built with Laravel 12 and PHP 8.3, featuring an admin dashboard and Swagger OpenAPI documentation.

## About This Repository

This repository serves as a test project to demonstrate backend development capabilities using Laravel framework. It showcases various features and best practices in modern web development, including:
- RESTful API implementation
- Role-based access control
- Server-side data processing
- API documentation
- Admin dashboard implementation

### Architecture & Design Pattern

This project is built using the Repository Design Pattern, which provides several benefits:
- Separation of data access logic from business logic
- Centralized data access layer
- Improved code maintainability and testability
- Consistent data access approach across the application
- Easier to switch between different data sources if needed

The implementation follows these key principles:
- Repository interfaces define the contract for data access
- Repository classes implement both data access and business logic
- Controllers remain thin and focused on HTTP concerns
- Business logic is encapsulated within repository classes for better organization

## Author

**Hermawan Safrin**
- Email: hermawansafrin19@gmail.com
- GitHub: [@hermawansafrin](https://github.com/hermawansafrin/backend-test)
- LinkedIn: [Hermawan Safrin](https://www.linkedin.com/in/hermawan-safrin-2b511b1a6/)

## Prerequisites

Before you begin, ensure you have the following installed on your local machine:
- PHP 8.0 or higher
- MySQL 8.0 or higher
- Composer (PHP package manager)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/hermawansafrin/boilerplate-laravel-12.git
cd boilerplate-laravel-12
```

2. Install PHP dependencies:
```bash
composer install
```

3. Configure your environment:
   - Copy `.env.example` to `.env`
   - Update the following in your `.env` file:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_username
     DB_PASSWORD=your_database_password
     ```

4. Generate application key:
```bash
php artisan key:generate
```

5. Run database migrations and seeders:
```bash
php artisan app:fresh-install
```

## Technology Stack & Packages

### Core Framework
- **Laravel 12 with PHP 8.4**
  - A modern PHP framework that provides an elegant syntax and powerful tools for web application development
  - Built with PHP 8.4 during development, leveraging the latest PHP features and performance improvements

### Frontend & UI
- **AdminLTE Template**
  - A popular open-source admin dashboard template
  - Provides a responsive and modern user interface with pre-built components
  - Includes various UI elements, charts, and widgets for admin dashboards

### Data Management
- **Yajra DataTables Server-Side**
  - Laravel package for handling server-side processing of DataTables
  - Provides excellent performance for large datasets by processing data on the server
  - Reduces client-side load and improves overall application performance
  - Features include sorting, searching, and pagination handled server-side

### Authentication & Authorization
- **Spatie Role and Permission**
  - Comprehensive role and permission management system
  - Allows fine-grained control over user access rights
  - Enables creation of roles and permissions with different access levels
  - Perfect for multi-user applications with varying access requirements

### API Development
- **Swagger OpenAPI**
  - API documentation tool that provides interactive documentation
  - Allows developers to test API endpoints directly from the documentation
  - Generates clean and comprehensive API documentation
  - Supports API versioning and endpoint testing

- **Laravel Sanctum**
  - Lightweight authentication system for SPAs, mobile applications, and simple token-based APIs
  - Provides secure token-based authentication
  - Supports multiple authentication methods
  - Ideal for API authentication and SPA development


## Running the Application

You have two options to run the application:

1. Using Laravel's built-in server:
```bash
php artisan serve
```

2. Using your local domain (if configured):
   - Access the application through your configured local domain

## Features

- Admin Dashboard
- Swagger OpenAPI Documentation
- RESTful API endpoints
- Database migrations and seeders

## API Documentation

The API documentation is available through Swagger UI. After running the application, you can access it at:
```
http://your-domain/api/documentation
```

## Testing Accounts

The following accounts are available for testing purposes:

1. Administrator Account:
   - Email: admin@mail.test
   - Password: 123456

## License

This project is open-sourced software licensed under the MIT license.
