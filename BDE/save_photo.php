<?php 
include('../config.php');
session_start();
// header("location:mindex.php");
?>

<?php
$input = $_GET['q'];

// Query the database for goods suggestions
$sql = "SELECT description_of_goods FROM goods WHERE description_of_goods LIKE '%$input%'";
$result = $conn->query($sql);

// Prepare the suggestions array
$suggestions = array();
while ($row = $result->fetch_assoc()) {
  $suggestions[] = $row['description_of_goods'];
}

// Return the suggestions as JSON response
header('Content-Type: application/json');
echo json_encode($suggestions);

?>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $currentDate = date("Y-m-d");

    $selectedItems = json_decode(file_get_contents("php://input"), true);

    foreach ($selectedItems as $item) {
        $name = $item["name"];
        $quantity = $item["quantity"];

        // Prepare and execute the SQL statement with current date
        $stmt = $conn->prepare("INSERT INTO goods_item (name, quantity, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $name, $quantity, $currentDate);
        $stmt->execute();
    }

    // Close the prepared statement
    $stmt->close();
}
?>
