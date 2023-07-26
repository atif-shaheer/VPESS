<?php 
include('../config.php');
session_start();
// header("location:mindex.php");
?>

<?php
$selected_engineer_ids = $_POST['id'];
$work_id = $_POST['site_id'];

// Combine engineer ids into a comma-separated string
$selected_engineer_ids_str = implode(",", $selected_engineer_ids);

// Assign the selected engineers to the work
$query = "UPDATE customer_work SET id = '$selected_engineer_ids_str' WHERE id = $work_id";

// Execute the update query
$result = mysqli_query($conn, $query);

// Check if update was successful
if ($result) {
    echo "<script>alert('Task Assigned Successfully!');window.location.href='testingpage.php'</script>";
} else {
    echo "<script>alert('Failed to Assign Task!');window.location.href='testingpage.php'</script>";
}
?>



