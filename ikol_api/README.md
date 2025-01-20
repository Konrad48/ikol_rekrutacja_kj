# Laravel API Project

A brief description of your Laravel API project.

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js & NPM

## Installation

1. Install PHP dependencies via Composer
```bash
composer install
```

2. Copy the `.env.example` file to `.env`

We don't use database migrations in this project.

## Running the Project

1. Start the Laravel development server
```bash
php artisan serve
```
The API will be accessible at `http://localhost:8000`

## Testing

Run the automated tests:
```bash
php artisan test
```

## Sample request to endpoint

```bash
curl --location 'http://127.0.0.1:8000/api/calculate-distance' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "pointA": {
        "latitude": 552.2297,
        "longitude": 21.0122
    },
    "pointB": {
        "latitude": 12.6392,
        "longitude": -8.0029
    }
}'
```