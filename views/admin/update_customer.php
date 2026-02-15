<?php
/**
 * This script processes the Edit Customer form.
 * It validates input, updates the customer record in the database,
 * and redirects the user with appropriate success or error messages.
 */

// Include the database connection file
// This file initializes the $db PDO object
require __DIR__ . '/../../db/database.php';

/**
 * Get the customer ID from the submitted form (POST)
 * FILTER_VALIDATE_INT ensures the ID is a valid integer
 */
$customerID = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);

// If the customer ID is missing or invalid, redirect back
if (!$customerID) {
    header("Location: manage_customers.php");
    exit;
}

// Array to store validated form fields
$fields = [];

/**
 * Loop through all expected customer fields
 * - Trim whitespace
 * - Ensure no field is left empty
 */
foreach (
    ['firstName','lastName','email','phone','address','city','state','postalCode','countryCode']
    as $key
) {
    $fields[$key] = trim($_POST[$key] ?? '');

    // If any field is empty, redirect back with an error message
    if ($fields[$key] === '') {
        header("Location: edit_customer.php?id=$customerID&error=Please fill all fields");
        exit;
    }
}

/**
 * Validate email format
 * Prevents invalid email addresses from being saved
 */
if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
    header("Location: edit_customer.php?id=$customerID&error=Invalid email");
    exit;
}

try {
    /**
     * Prepare an SQL UPDATE statement
     * Prepared statements protect against SQL injection
     */
    $stmt = $db->prepare(
        "UPDATE customers SET
            firstName = :firstName,
            lastName = :lastName,
            email = :email,
            phone = :phone,
            address = :address,
            city = :city,
            state = :state,
            postalCode = :postalCode,
            countryCode = :countryCode
         WHERE customerID = :id"
    );

    /**
     * Execute the query
     * Merge form fields with the customer ID
     */
    $stmt->execute($fields + ['id' => $customerID]);

    // Redirect to the manage customers page with success message
    header("Location: manage_customers.php?success=Customer updated successfully");
    exit;

} catch (PDOException $e) {
    /**
     * Catch database errors
     * Do not expose raw database messages to users
     */
    header("Location: edit_customer.php?id=$customerID&error=Database error");
    exit;
}
