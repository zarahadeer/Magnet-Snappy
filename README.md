# 🎀 Magnet Snappy

**Snap It. Stick It. Cherish It.**

Magnet Snappy is a colorful and playful e-commerce website for personalized and customized photo magnets. Customers can browse available magnets, add products to their cart, and place orders.

The website also includes an **admin panel** where the website owner can manage products, stock, orders, and admin account settings.

---

## 🌸 Project Overview

Magnet Snappy was created as a full-stack e-commerce website with a fun and colorful design using a **pink, purple, and blue theme**.

The website has two main parts:

### 👩‍💻 Customer Website
Customers can:

- View the homepage
- Browse available magnets
- View product details
- Add products to the cart
- View their cart
- Place orders
- Read FAQs
- Contact the business
- View personalized and customized magnet options

### 🔐 Admin Panel
The website owner can:

- Login to the admin dashboard
- Add new products
- Edit existing products
- Delete products
- View all products
- Manage product stock
- View customer orders
- Update admin username and password
- Logout securely

---

## ✨ Features

### 🏠 Homepage

- Attractive hero section
- Three-color heading:
  - **Snap It.** – Purple
  - **Stick It.** – Pink
  - **Cherish It.** – Blue
- Personalized and Customized branding
- Call-to-action buttons
- About section
- Product preview
- FAQ section
- Contact section
- Responsive footer

### 🛍️ Shop

- Products loaded dynamically from MySQL database
- Product images
- Product name
- Product description
- Product price in GBP (£)
- Stock availability
- Add to Cart button
- Out-of-stock message

### 🛒 Shopping Cart

- Add products to cart
- View selected products
- Manage quantities
- Calculate order total

### 📦 Orders

Customer orders are stored in the database and can be viewed from the admin panel.

### 🔑 Admin Panel

The admin panel includes:

- Admin Login
- Dashboard
- Add Product
- Products Management
- Edit Product
- Delete Product
- Orders
- Settings
- Logout

---

## 🎨 Design

The website uses a playful pastel color palette.

| Color | Purpose |
|---|---|
| 💗 Pink | Buttons, highlights and accents |
| 💜 Purple | Headings and navigation |
| 💙 Blue | Cart buttons and secondary elements |
| 🤍 White | Cards and navigation |
| 🌸 Light Pink | Hero and background sections |

The design is responsive and works on:

- 💻 Desktop
- 📱 Mobile
- 📟 Tablet

---

## 🛠️ Technologies Used

### Frontend

- HTML5
- CSS3
- Bootstrap 5
- Bootstrap Icons
- JavaScript

### Backend

- PHP
- MySQL

### Development Environment

- XAMPP
- Apache
- phpMyAdmin
- Visual Studio Code

---

## 📁 Project Structure

```text
magnet-shop/
│
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   ├── add-product.php
│   ├── products.php
│   ├── edit-product.php
│   ├── delete-product.php
│   ├── orders.php
│   ├── settings.php
│   └── logout.php
│
├── includes/
│   ├── connection.php
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
│
├── images/
│   ├── hero.jpg
│   ├── about.jpg
│   └── products/
│
├── css/
│   └── style.css
│
├── js/
│   └── script.js
│
├── index.php
├── products.php
├── cart.php
├── checkout.php
├── faq.php
├── contact.php
│
└── README.md