<?php
//  Include the database connection
require_once __DIR__ . '/../db/database.php';

/**
 * Fetch all products from the database, ordered by name
 *
 * @return array Returns an array of products, each as an associative array
 */
function get_products() {
    //  Use the global $db PDO object
    global $db;

    //  Prepare the SQL query to select all products, ordered alphabetically by name
    $stmt = $db->prepare("SELECT * FROM products ORDER BY name ASC");

    //  Execute the query
    $stmt->execute();

    //  Fetch all results as an associative array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //  Close the cursor to free connection resources
    $stmt->closeCursor();

    //  Return the array of products
    return $products;
}

