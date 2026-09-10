# Oil Change Tracker

A small Laravel 12 app that tells you whether a car is due for an oil change
based on the odometer reading and the date of the last oil change.

A car is due for an oil change if either is true:

- More than 5000km have been driven since the last oil change, or
- Moe than 6 months have passed since the last oil change

## Requirements

- PHP 8.2+
- Composer

## Setup

1. Install dependencies:

```bash
   composer install
```

2. Copy the environment file and generate an app key:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. Create the SQLite database file (the app is already configured to use it
   via `DB_CONNECTION=sqlite` in `.env`):

    ```bash
    touch database/database.sqlite
    ```

    On Windows PowerShell, use `New-Item database/database.sqlite -ItemType File` instead.

4. Run the migrations:

    ```bash
    php artisan migrate
    ```

5. Start the app:

    ```bash
    php artisan serve
    ```

    Visit http://127.0.0.1:8000 in your browser.

## Routes

| Method | URI            | Description                                |
| ------ | -------------- | ------------------------------------------ |
| GET    | `/`            | Blank form to check a car                  |
| POST   | `/check`       | Validates and saves the submission         |
| GET    | `/result/{id}` | Shows the saved result for that submission |

Each submission is saved to the database and gets its own result page
(`/result/{id}`), so the result stays visible even after a page refresh.
There are no user accounts and no listing of past checks.
