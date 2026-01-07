<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# 🛒 E-Commerce API (Laravel)

A production-ready REST API for e-commerce applications featuring authentication, product management, cart functionality, orders, and PayPal payment integration.

## 🌍 Live API (Render Free Tier)

* Base URL:
    - https://your-render-api-url.onrender.com

* ⚠️ Note:
    This API is deployed on Render’s free tier.
    When inactive, Render will put it to sleep, causing the first request to take 30–50 seconds.
    After waking up, all endpoints respond normally.

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

**GET** `/api/v1/products`

Optional query params:

```
?category=
?search=
?sort=price|newest
```

### Get product by ID

**GET** `/api/v1/products/{id}`

### Admin: Create product

**POST** `/api/v1/admin/products`
Requires admin token.

---

## 🛒 Cart

### View cart

**GET** `/api/v1/cart`

### Add product

**POST** `/api/v1/cart/add`

Body:

```
{
  "product_id": 1,
  "quantity": 2
}
```

### Update quantity

**PUT** `/api/v1/cart/update/{itemId}`

### Remove item

**DELETE** `/api/v1/cart/remove/{itemId}`

---

## 📦 Orders

### Create order

**POST** `/api/v1/orders`

### Get user orders

**GET** `/api/v1/orders`

### Get single order

**GET** `/api/v1/orders/{id}`

---

## 💳 PayPal Payments

### Create PayPal Order

**POST** `/api/v1/paypal/create-order`

Response (example):

```
{
  "id": "PAYPAL_ORDER_ID",
  "approve_url": "https://www.paypal.com/checkout?token=..."
}
```

### Capture Payment

**POST** `/api/v1/paypal/capture`

Body:

```
{
  "order_id": "PAYPAL_ORDER_ID"
}
```

### Webhook Entry (optional)

**POST** `/api/v1/paypal/webhook`

---

## 🔧 Environment Variables

```
APP_URL=
APP_ENV=
APP_KEY=

DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

# PayPal
PAYPAL_CLIENT_ID=
PAYPAL_SECRET=
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
