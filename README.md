<<<<<<< HEAD
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



=======
# PHPAssignment2

This is my PHPAssignment2 project for school. It is a technical support system built using PHP and organized using the MVC (Model-View-Controller) structure.

## Project Structure

- `controllers/` – Handles the logic of the application.
- `models/` – Stores the data structure (currently empty, `.gitkeep` added).
- `views/` – Contains all the front-end pages:
  - `incidents/` – Incident management pages.
  - `registrations/` – Product registration pages.
  - `technicians/` – Technician management pages.
  - `header.php` and `footer.php` – Common layout files.
- `db/` – Database scripts.
- `index.php` – Main entry point of the project.
- `export/` – Files for exporting data.

* Features

- Create, view, update, and assign incidents.
- Register products.
- Manage technicians.
- Organized with MVC for scalability and maintainability.

* Future Work

This project is part of a series of assignments. Not all features are fully implemented yet.  
The remaining functionalities will be completed in subsequent assignments.  

Examples of future improvements:  
- Complete database models in the `models/` folder.  
- Add advanced incident reporting features.  
- Enhance user interface and styling.

# PHPAssignment3
>>>>>>> 876668e (Initial commit - PHPAssignment4 project with registration and product features)
