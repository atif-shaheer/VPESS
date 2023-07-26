<?php 
include('../config.php');
session_start();
// header("location:mindex.php");
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $currentDate = date("Y-m-d");

    $selectedItems = json_decode(file_get_contents("php://input"), true);

    foreach ($selectedItems as $item) {
        $name = $item["name"];
        $quantity = $item["quantity"];

        // Prepare and execute the SQL statement with current date
        $stmt = $conn->prepare("INSERT INTO rectification (name, quantity, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $name, $quantity, $currentDate);
        $stmt->execute();
    }

    // Close the prepared statement
    $stmt->close();
}
?>