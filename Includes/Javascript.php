<?php
    $var1 = $_POST['status']; 
    $var2 = explode("_",$var1);
    $var3 = $var2[1];
    print_r($var2[0]);
    print_r($var3);
    if($var2[0]==0)
        {                   
            require "connection.php";
            $sql001 = "UPDATE tasks SET Finished = 1 
                       WHERE Task_id = '$var3';";
            if ($connection->query($sql001) === TRUE) {
                header('Location: ../index.php');
            } else {
                echo "Error: " . $sql001 . "<br>" . $connection->error;
            }      
            $connection->close(); 
        }
    else if ($var2[0]==1)
        {   
            require "connection.php";
            $sql002 = "UPDATE tasks SET Finished = 0 
                       WHERE Task_id = '$var3';";
        if ($connection->query($sql002) === TRUE) {
                header('Location: ../index.php');
            } else {
                echo "Error: " . $sql002 . "<br>" . $connection->error;
            }      
            $connection->close(); 
        }
?>