# SalesInventory Documentation

## Description / Overview

**SalesInventory** is a web-based sales and stock management system built with Laravel. 
It provides a platform for users to efficiently manage products, monitor stock levels, and organize items into
categories, reducing manual record-keeping and improving inventory accuracy.

---

## Objectives

- To provide a **user-friendly** web application for managing product stocks and categories.
- To implement **CRUD (Create, Read, Update, Delete)** operations for accurate and up-to-date product information
- To categorize stocks for better classification and retrieval.
- To ensure **data reliability and security** through Laravel's database management techniques.

---

## Features / Functionality

### Product Management
- **Add/Edit/Delete Products:** Manage product details such as name, quantity, price, and image.  
- **Stock Updates:** Easily adjust stock levels to reflect inventory changes.  

### Category Management
- **Add/Edit/Delete Categories:** Organize products into categories for easier tracking and retrieval.  
- **Category Overview:** Quickly view and manage existing categories.  

---

## Installation Instructions
1. **Clone the repository:**  
   ```sh
   git clone <repo-url>
   cd salesInventory
   ```

2. **Install dependencies:**  
   ```sh
   composer install
   ```

3. **Environment setup:**  
   - Copy `.env.example` to `.env` and configure database credentials.
   - Generate application key:
     ```sh
     php artisan key:generate
     ```
4. **Start MySQL service via XAMPP Control Panel.**

5. **Run the Laravel server:**
   ```sh
    php artisan serve
   ```

6. **Access the application:**
   ```sh
    - Categories: http://127.0.0.1:8000/categories
    - Products: http://127.0.0.1:8000/product
   ```

---

## Usage

### Category Management
- Navigate to /categories.
- Click Add Category, fill out the form, and save.
- Edit existing categories by selecting Edit, updating the details, and clicking Update.

### Product Management
- Navigate to /product.
- Click Add Product, enter the product details, and save.
- Edit existing products by selecting Edit, updating fields (name, stock, price, image), and clicking Update.

---

## Code Snippets

### Add Product
````php
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
    ]);

    Product::create([
        'name' => $request->name,
        'quantity' => $request->quantity,
        'price' => $request->price,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('product.index')->with('success', 'Product added successfully.');
}
````

### Edit Product
````php
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
    ]);

    $product->update($request->all());
    return redirect()->route('product.index')->with('success', 'Product updated successfully.');
}
````

### Delete Product
````php
public function destroy($id)
{
    Product::findOrFail($id)->delete();
    return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
}
````
---

## Folder Structure
- app/Models: Eloquent models (Product, Category)
- app/Http/Controllers: Controllers for managing products and categories
- resources/views: Blade templates for UI
- routes/web.php: Route definitions
- database/migrations: Database schema
- database/seeders: Initial data

---

## Database Schema
- products: id, name, quantity, price, category_id
- categories: id, name, description

---

## Contributors

- **Gavian, Jesiel L.**