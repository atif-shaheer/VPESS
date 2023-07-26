<?php
include('../config.php');
session_start();

$id = $_POST['id'];
$sql = "SELECT id FROM customer_work WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
    echo "<div class='modal fade bd-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' style='display: none;' aria-hidden='true'>";
    echo "<div class='modal-dialog modal-lg'>";
    echo "<div class='modal-content'>";
    echo "<div class='modal-header'>";
    echo "<h5 class='modal-title' id='myLargeModalLabel'>Update Customer Report</h5>";
    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>";
    echo "</div>";
    echo "<div class='modal-body'>";
    echo "<h1>Hello This is Model</h1>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
} else {
    echo "No data found";
}
?>