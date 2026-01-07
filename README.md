<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# 🛒 E-Commerce API (Laravel)

A production-ready REST API for e-commerce applications featuring authentication, product management, cart functionality, orders, and PayPal payment integration.

---

## 🚀 Features

* **User Authentication**

  * Register, Login, Logout
  * Profile management
  * Token-based auth (Sanctum)

* **Product Module**

  * List products
  * Product details
  * Categories
  * Search and filtering

* **Cart & Wishlist**

  * Add / update / remove items
  * View cart summary

* **Order System**

  * Create orders
  * Order history
  * Order items + shipping info

* **Payments**

  * PayPal Checkout
  * Payment verification

---

## 🧰 Tech Stack

| Layer              | Technology                       |
| ------------------ | -------------------------------- |
| Backend Framework  | Laravel 12+                      |
| Authentication     | Laravel Sanctum                  |
| Database           | MySQL / PostgreSQL               |
| Payments           | PayPal REST API                  |
| Products API       | Dummy JSON                       |

## 🔐 Authentication

### Register

**POST** `/api/v1/auth/register`

### Login

**POST** `/api/v1/auth/login`

### Logout

**POST** `/api/v1/auth/logout`
Requires bearer token.

---

## 🛍 Products

### Get all products

**GET** `/api/products`

Optional query params:

```
?category=
?search=
?sort=price|newest
```

### Get product by ID

**GET** `/api/products/{id}`

### Admin: Create product

**POST** `/api/admin/products`
Requires admin token.

---

## 🛒 Cart

### View cart

**GET** `/api/cart`

### Add product

**POST** `/api/cart/add`

Body:

```
{
  "product_id": 1,
  "quantity": 2
}
```

### Update quantity

**PUT** `/api/cart/update/{itemId}`

### Remove item

**DELETE** `/api/cart/remove/{itemId}`

---

## 📦 Orders

### Create order

**POST** `/api/orders`

### Get user orders

**GET** `/api/orders`

### Get single order

**GET** `/api/orders/{id}`

---

## 💳 PayPal Payments

### Create PayPal Order

**POST** `/api/paypal/create-order`

Response (example):

```
{
  "id": "PAYPAL_ORDER_ID",
  "approve_url": "https://www.paypal.com/checkout?token=..."
}
```

### Capture Payment

**POST** `/api/paypal/capture`

Body:

```
{
  "order_id": "PAYPAL_ORDER_ID"
}
```

### Webhook Entry (optional)

**POST** `/api/paypal/webhook`

---

## 🔧 Environment Variables

```
APP_URL=
APP_ENV=
APP_KEY=

DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=
SESSION_DOMAIN=

# S3 (optional)
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=ap-southeast-1
AWS_BUCKET=

# PayPal
PAYPAL_CLIENT_ID=
PAYPAL_SECRET=
PAYPAL_MODE=sandbox|live
```

---

## ▶️ Installation

```bash
git clone <repo>

composer install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

php artisan serve
```

If using Sanctum for SPA or mobile, set CORS correctly.

---

## 🧪 Testing Endpoints

Recommended tools:

* Postman / Bruno collection
* PHPUnit / Pest tests located in `tests/Feature`

Run tests:

```bash
php artisan test
```

## 📜 License

MIT License — free to use and modify.
