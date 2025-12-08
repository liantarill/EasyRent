# EasyRent Rental System - Quick Start Guide

## Prerequisites

Make sure you have installed:

-   PHP >= 8.1
-   Composer
-   MySQL/PostgreSQL
-   Node.js & NPM
-   Ngrok (for Midtrans webhook testing)

---

## Installation

### 1. Clone Repository

```bash
git clone https://github.com/liantarill/EasyRent.git
cd easyrent
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database

Edit `.env` file:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=easyrent_db
DB_USERNAME=postgres
DB_PASSWORD=
```

Create database:

```bash
CREATE DATABASE easyrent_db;
```

### 5. Run Migrations & Seeders

```bash
php artisan migrate --seed
```

### 6. Create Storage Link

```bash
php artisan storage:link
```

---

## Running the Application

### Terminal 1: Start Laravel Server

```bash
php artisan serve
```

Open: `http://127.0.0.1:8000/`

### Terminal 2: Build Assets

```bash
npm run dev
```

### Terminal 3: Start Queue Worker

```bash
php artisan queue:work
```

### Terminal 4: Start Ngrok (for Payment Testing)

```bash
ngrok http http://127.0.0.1:8000/
```

Copy the ngrok URL (e.g., `https://abc123.ngrok.io`)

Clear cache:

```bash
php artisan config:clear
```

---

## Default Login

**Admin:**

-   Email: `admin@example.com`
-   Password: `admin123`

**Customer:**

-   Email: `budi@example.com`
-   Password: `user123`

---

## Midtrans Setup

Set ngrok URL in Midtrans Dashboard:
URL: `https://abc123.ngrok.io/payments/notification`

---

## Done!
