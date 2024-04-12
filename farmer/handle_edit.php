<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "agriconnect";


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variables for update
$id = 1; // Example: the ID of the record you want to update
$newName = "Updated Name"; // Example: the new name value for the 'name' column



if (isset($_POST['action']) && $_POST['action'] == 'update') {
   

    $categories = $_POST['product_cat'];
    $product_name = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_desc'];
    $contact = $_POST['contact'];
    $product_keywords = $_POST['product_keywords'];
    $id = $_POST['id'];
    // [product_cat] => 1 
    // [product_title] => 1
    // [product_price] => 1
    // [product_desc] => 1                                                
    // [contact] => 11
    // [product_keywords] => 111
    // [action] => update

    // SQL update query
    $sql = "UPDATE proudct SET categories = '$categories',product_name = '$product_name', 
product_price = '$product_price', product_description = '$product_description',
 contact = '$contact', product_keywords = '$product_keywords'
WHERE id = $id";

    // Execute update query
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
