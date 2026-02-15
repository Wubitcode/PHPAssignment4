<?php
//  Include database connection
require_once __DIR__ . '/../db/database.php';

/**
 * Fetch a customer record from the database by email
 *
 * @param string $email The email address of the customer to look up
 * @return array|false Returns associative array of customer data if found, false otherwise
 */
function get_customer_by_email($email) {
    //  Use the global $db PDO object
    global $db;

    //  Prepare SQL statement to safely select customer by email
    $stmt = $db->prepare("SELECT * FROM customers WHERE email = :email");

    //  Bind the email parameter to prevent SQL injection
    $stmt->bindValue(':email', $email);

    //  Execute the query
    $stmt->execute();

    //  Fetch the result as an associative array
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    //  Close the cursor to free connection resources
    $stmt->closeCursor();

    //  Return the customer data (or false if not found)
    return $customer;
}
