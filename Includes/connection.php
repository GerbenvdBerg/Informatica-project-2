<!-- allows Create.php to have the connection to the server-->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "to-do2";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("connection failed: " . $connection->connect_error);
}
?>