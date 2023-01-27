<?php
require "connection.php";

$sql4 = "DELETE FROM tasks WHERE `task_id` = ('".$_POST['task_del']."');";

if ($connection->query($sql4) === TRUE) {
  header('Location: ../index.php');
} else {
  echo "Error: " . $sql4 . "<br>" . $connection->error;
}      
$connection->close();
?>