<?php
include "php/config.php";   
if(isset($_POST['update']) ){
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $sql =("UPDATE signup SET name = '$name'WHERE id = '$id' ");
    $result = $conn->query($sql);
}

if(isset($_POST['update']) ){
  $unique_id = $_POST['unique_id'];
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $sql =("UPDATE goals SET naam='$name' WHERE unique_id = '$unique_id' ");
  $result = $conn->query($sql);
}

if(isset($_POST['update']) ){
  $unique_id = $_POST['unique_id'];
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $sql =("UPDATE teams SET naam='$name' WHERE unique_id = '$unique_id' ");
  $result = $conn->query($sql);
}

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    header("Location:profileforadmin.php?page=profiel&id=" . $_POST['id'] ." " );
  } else {
    echo "Error updating record: " . $conn->error;
  }
?>


