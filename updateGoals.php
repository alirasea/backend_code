<?php
include "php/config.php";   
if(isset($_POST['update']) ){
    $id = $_POST['id'];
    $assist = mysqli_real_escape_string($conn, $_POST['assist']);
    $goals = mysqli_real_escape_string($conn, $_POST['goals']);
    $sql =("UPDATE goals SET assist = '$assist', goals = '$goals' WHERE goals_id = '$id' ");
    $result = $conn->query($sql);
}

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    $homeId = $_POST['homeId'];
    header("Location:profileforadmin.php?page=profiel&id=$homeId");
  } else {
    echo "Error updating record: " . $conn->error;
  }
?>