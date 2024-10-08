# Tableo Laravel Assessment

## Project Setup Guide

## 1. Clone the repository using the following command:

git clone https://github.com/Nweke273/tableo-laravel-assessment.git

## 2. Navigate to the project directory

Change to the project directory:

    cd tableo-laravel-assessment

## 3. Install Project Dependencies

Install the PHP dependencies using Composer:

    composer install

## 4. Create Environment Files

     cp .env.example .env

## 5. Generate a new application key:

    php artisan key:generate

## 6. Configure Database

Create a database with the name tableo_laravel_assessment (or any name of your choice) on your database server. Then, update the following configuration settings in the .env file located in the root directory of your project:

    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password

## 7. Configure External API

Update the .env file with the following configuration:

    KANYE_QUOTE_API_URL="https://api.kanye.rest"
    KANYE_QUOTE_LIMIT=5

## 8. Run Migrations

Create the database tables using the migration command:

    php artisan migrate

## 9. Seed the Database

Seed the database with initial data:

    php artisan db:seed

## 10. Serve the Application

You can access the application using the link generated by the php artisan serve command.

    php artisan serve

## Login Access

Quote access password:

    12345678

## Running Tests

To run tests, use PHPUnit:
Make sure to uncomment the two commented lines in the phpunit.xml, then run the command below to test

    php artisan test
