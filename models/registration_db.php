<?php
//  Include the database connection
require_once __DIR__ . '/../db/database.php';

/**
 * Add a product registration for a customer
 *
 * @param int $customerID The ID of the customer registering the product
 * @param string $productCode The code of the product being registered
 */
function add_registration($customerID, $productCode) {
    //  Use the global $db PDO object
    global $db;

    //  Prepare the SQL INSERT statement
    // The registrationDate is set to NOW() automatically
    $stmt = $db->prepare(
        "INSERT INTO registrations (customerID, productCode, registrationDate)
         VALUES (:customerID, :productCode, NOW())"
    );

    //  Bind values to the prepared statement to prevent SQL injection
    $stmt->bindValue(':customerID', $customerID);
    $stmt->bindValue(':productCode', $productCode);

    //  Execute the statement
    $stmt->execute();

    //  Close the cursor to free connection resources
    $stmt->closeCursor();
}
