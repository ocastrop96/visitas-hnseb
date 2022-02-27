<?php
$host = "localhost";
$user = "rvmanage";
$password = "@pdSBNX5+lCa3i|r83u~";
$dbname = "rvisitas";
$con = mysqli_connect($host, $user, $password,$dbname);
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}