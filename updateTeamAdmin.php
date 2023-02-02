<?php
session_start();
$con = mysqli_connect("localhost","root","","stattracker");

if(isset($_POST['save_select']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $unique_id = $_POST['unique_id'];
    $club = $_POST['club'];

    // if($club = ){

    // }
    $check_club = mysqli_query($con, "SELECT * FROM teams WHERE club = '$club' AND unique_id = '$unique_id' ");
if(mysqli_num_rows($check_club) > 0){
        echo "
        <link rel='preconnect' href='https://fonts.googleapis.com'>
<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
<link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap' rel='stylesheet'>
        <link href='style/links.css' rel='stylesheet'>
        <header>
        <a href='profileforadmin.php?page=profiel&id=" . $id . "' class='terug'><h3>Terug</h3></a>
        </header>
        
        <h2 class='titel'>Zit al in dit team</h2>";
}else{

    $query = "INSERT INTO teams (naam, unique_id, club) VALUES ('$name','$unique_id','$club')";
    $query_run = mysqli_query($con, $query);
    $query = "INSERT INTO goals (unique_id, naam, team) VALUES ('$unique_id','$name','$club')";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['status'] = "Inserted Succesfully";
        header("Location:profileforadmin.php?page=profiel&id=" . $id ." ");
    }
    }
    }

?>