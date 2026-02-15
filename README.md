# PHPAssignment4 - SportsPro Technical Support

## Overview
This project is a **PHP and MySQL web application** for managing customer product registrations for a technical support system.  

The project allows:
- Customers to **register themselves** with their details.
- Customers to **log in**.
- Customers to **register products**.
- Admin to **add products**.
- System to handle **success, error, and duplicate messages** during registration.

## Features

### Customer Side
1. **Registration**
   - Customers can register with **first name, last name, email, and password**.
   - Passwords are **hashed** for security.
   - After registration, the customer is **automatically logged in**.

2. **Login**
   - Customers can log in with their **email**.
   - Session is used to track logged-in users.

3. **Product Registration**
   - Logged-in customers can register products from a **dropdown of available products**.
   - Success message includes the **product code**.
   - Handles **duplicate registrations** and missing selection errors.



### Admin Side
- Admin can **add new products** (name, version, release date) via `project_controller.php`.
- Admin can view all products in `project_manager.php`.

## Database Structure
- **customers**: stores customer info (first name, last name, email, passwordHash, etc.)  
- **products**: stores products (productCode, name, version, releaseDate)  
- **registrations**: stores which customer registered which product and when  


## How It Works
1. Customer visits **login page**:  
   `http://localhost/PHPAssignment4/views/registrations/customer_login.php`

2. After login:
   - Customer is redirected to **register_product.php** to select and register products.
   - Messages show **success, duplicate, or error**.

3. Product registration is handled by `save_registration.php`:
   - Inserts record into `registrations` table.
   - Redirects back with appropriate status.

4. Admin can add products via `project_controller.php`:
   - Uses the `add` action to insert new product into `products` table.

