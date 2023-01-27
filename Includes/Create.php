<!-- php for the create new tasks -->
<?php
require "connection.php";
 
$sql2 = "INSERT INTO tasks (`Task_name`, `Task_description`, `Categories_id`)
         VALUES ('".$_POST['Task_name']."', '". $_POST['Task_description']."', '". $_POST['Categories_id']."');";

if ($connection->query($sql2) === TRUE) {
  header('Location: ../index.php');
} else {
  echo "Error: " . $sql2 . "<br>" . $connection->error;
}      
$connection->close();
?>