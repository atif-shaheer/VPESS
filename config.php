<?php
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('Asia/Kolkata');
// $conn = mysqli_connect("localhost","dtacuser17marchx","umoO(p)gu]TO","dtac17marchdbx");
$conn = mysqli_connect("localhost","root","","vpess");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('Asia/Kolkata');
// $domain = 'http://www.dagtc.com/portal/';
$domain = 'http://localhost/';
$message = '';
?>