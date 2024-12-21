<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h2>Version :</h2>
<ul>
    <li>
        <p style="font-size: 20px"> LARAVEL  <span style="color: red">10</span></p>
    </li>
    <li>
        <p style="font-size: 20px"> PHP <span style="color: red">min 8.2</span></p>
    </li>
    <li>
        <p style="font-size: 20px"> COMPOSER <span style="color: red">2.7</span></p>
    </li>
    <li>
        <p style="font-size: 20px"> PostgreSQL</p>
    </li>
    <li>
        <p style="font-size: 20px"> NPM  <span style="color: red">10</span></p>
    </li>
    <li>
        <p style="font-size: 20px"> NODE.JS  <span style="color: red">min 18
    </span></p>
    </li>
    <li>
        <p style="font-size: 20px"> DOCKER  <span style="color: red">min 3</span></p>
    </li>
</ul>

- [Docker install](#docker-install)
- [Install Laravel](#install-laravel)
    - [Commands of first install](#commands-of-first-install)
    - [For update](#--for-update)
    - [Full reinstall database tables](#full-reinstall-database-tables)
- [REST API](#rest-api)
  - [Products](#products)
    - [Get products](#get-products)
    - [Get one product](#get-one-product)
    - [Create product](#create-product)
    - [Update Product](#update-product)
    - [Delete product](#delete-product)


Clone the project and in the terminal go to the level with the backend and frontend folders

You need to create a `.env` file. To register a user, you need to configure the parameters in the file. After registration, a letter is sent to the email address to verify the email.

### docker install

    docker-compose up -d

Next, go to the backend folder and run the list of commands

## INSTALL LARAVEL

### commands of first install

```
composer install

php artisan key:generate
php artisan migrate

npm install
```

#### - for update
```
composer install

php artisan cache:clear
php artisan config:clear
php artisan route:clear

php artisan migrate

npm install
```

### full reinstall database tables
```
php artisan migrate:fresh --seed
```

## REST API

### PRODUCTS

### Get products

Request `GET /api/v1/products`

    Params: { name, count_product, price_min, price_max, price_from, price_to}

Response `200 Success`

    { 
      "success": bool,
      "message": string,
      "data": array
    }

### Get one product

Request `GET /api/v1/products/{id}`

Response `200 Success`

    { 
      "success": bool,
      "message": string,
      "data": array
    }

Bad Response `404 Not Found`

    {
      'success': bool,
      'message': string
    }

### Create product

Request `POST /api/v1/products`

    Body: { name: string, count_product: numeric|null, price: numeric|null}

Response `201 Created`

    { 
      "success": bool,
      "message": string,
      "data": array
    }

Bad Response `400 Bad Request`

    {
      'success': bool,
      'message': string
    }

### Update product

Request `PUT /api/v1/products/{id}`

    Body: { name: string, count_product: numeric|null, price: numeric|null}

Response `200 Success`

    { 
      "success": bool,
      "message": string,
      "data": array
    }

Bad Response `400 Bad Request`

    {
      'success': bool,
      'message': string
    }

Bad Response `404 Not Found`

    {
      'success': bool,
      'message': string
    }

### Delete product

Request `POST /api/v1/products/{id}`

    Body: { name: string, count_product: numeric|null, price: numeric|null}

Response `204 No Content`

Bad Response `404 Not Found`

    {
      'success': bool,
      'message': string
    }
