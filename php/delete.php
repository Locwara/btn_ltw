<?php

require 'connect.php';  
 $id= $_GET['id'];
 $sql = "DELETE FROM products WHERE id=$id";
 if ($conn->query($sql) === TRUE) {
    header("Location: trangchu.php");
  } else {
    echo "Error deleting record: " . $conn->error;

}
?>