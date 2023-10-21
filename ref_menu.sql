<?php
// Database connection parameters
$hostname = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database_name";

// Create a database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare a SQL statement
$query = "SELECT id, menu_name, menu_desc FROM ref_menu WHERE id = ?";
if ($stmt = $conn->prepare($query)) {
    // Bind parameters
    $id = 2; // Replace with the desired ID
    $stmt->bind_param("i", $id); // "i" for integer, adjust based on data type

    // Execute the statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($id, $menu_name, $menu_desc);

    // Fetch the results
    while ($stmt->fetch()) {
        echo "ID: $id, Name: $menu_name, Description: $menu_desc<br>";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error in preparing the statement: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
