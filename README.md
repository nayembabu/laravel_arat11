# Arat Software

Brief description  
Arat is a lightweight business application designed to manage product listings, stock control, and sales accounts easily. It is PHP-based and easily customizable.

## Key Features
- Product and category management  
- Stock in/out tracking  
- Sales and invoice generation  
- User and role management  
- Reporting (daily close, monthly)

## Technology Stack
- Language: PHP  
- Database: MySQL / MariaDB  
- Framework: Laravel (or custom PHP stack)  
- Package Manager: Composer

## Quick Start
Requirements: PHP 8+, Composer, MySQL

1. Clone the repo
    ```bash
    git clone <repo-url>
    cd arat-app
    ```
2. Install dependencies
    ```bash
    composer install
    ```
3. Copy configuration file and set environment
    ```bash
    cp .env.example .env
    # Set DB, APP_URL, etc. in .env
    php artisan key:generate
    ```
4. Run database migrations and seeders
    ```bash
    php artisan migrate --seed
    ```
5. Run the local server
    ```bash
    php artisan serve
    ```

## Configuration Tips
- Set DB_CONNECTION, DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD correctly in the .env file.  
- Verify storage configuration for product images and file uploads (link the public disk: php artisan storage:link).

## Contributing & Issue Reporting
- Open an issue for bug reports or feature requests.  
- Code contributions: feature branch → pull request → review.

## License
MIT License (see the LICENSE file for details).