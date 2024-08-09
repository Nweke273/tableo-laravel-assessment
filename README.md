# Laravel Kanye West Quotes Application

## Setup

1. Clone the repository:

    ```bash
    git clone https://github.com/Nweke273/tableo-laravel-assessment.git
    ```

2. Navigate to the project directory:

    ```bash
    cd tableo-laravel-assessment
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

4. Set up your environment file:

    ```bash
    cp .env.example .env
    ```

5. Generate an application key:

    ```bash
    php artisan key:generate
    ```

6. Set up your database configuration in the `.env` file.

7. Run migrations:

    ```bash
    php artisan migrate
    ```

8. Seed your database:
    ```bash
    php artisan db:seed
    ```
9. Quote access password: 12345678

## Running Tests

To run tests, use PHPUnit: php artisan test

```bash
./vendor/bin/phpunit
```
