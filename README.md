# Banking Web Application

This project is a banking web application designed for educational purposes. It features a Laravel-based backend with a MySQL database and a simple front-end using HTML5 and CSS. The application caters to two types of users: clients and banking agents, providing functionalities like user registration and authentication, bank account management, client and bank agent operations, and basic security features.

## Getting Started

These instructions will guide you through setting up the project on your local machine for development and testing purposes.

### Prerequisites

What you need to install the software:

- PHP >= 7.3
- Composer
- MySQL
- Laravel >= 8.x

### Installing

Follow these steps to set up your development environment.

#### Clone the Repository

```bash
git clone https://github.com/jeanpaulbassil/banking-web-app.git
cd banking-web-app
```

#### Install Dependencies

```bash
composer install
```

#### Configure Environment

Duplicate the `.env.example` file and rename it to `.env`. Update the environment variables, especially the database details.

```bash
cp .env.example .env
```

Edit `.env` with your database connection details:

```plaintext
DB_CONNECTION=mysql
DB_HOST=34.71.134.57
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

#### Generate Application Key

```bash
php artisan key:generate
```

#### Run Migrations

```bash
php artisan migrate
```

#### Starting the Application

```bash
php artisan serve
```

Your application should now be running on [http://localhost:8000](http://localhost:8000).

## Running the Tests

To run the automated tests:

```bash
vendor/bin/phpunit
```

## Deployment

Instructions for deploying the application in a live environment will be provided separately.

## Built With

- [Laravel](https://laravel.com/) - The web framework used
- [MySQL](https://www.mysql.com/) - Database Management

## Authors

- **Jean-Paul Bassil** - [GitHub Profile](https://github.com/jeanpaulbassil)
- **Peter Chahid** - [GitHub Profile](https://github.com/peterchahid)
