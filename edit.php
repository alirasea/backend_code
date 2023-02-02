<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header('Location: login.php');
}
include "php/config.php";


$sql = mysqli_query($conn, "SELECT * FROM signup WHERE unique_id = {$_SESSION['unique_id']}");
if(mysqli_num_rows($sql) > 0){
$row = mysqli_fetch_assoc($sql);
}


        $sql = "SELECT club FROM team_table";
        $result = $conn->query($sql);
 
?>
<html>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<link href="style/links.css" rel="stylesheet">
<style>
        ::placeholder {
    color: white;
    opacity: 1; /* Firefox */
}

    </style>
    <body>
<header>
<a href="profile.php" class="terug"><h3>Terug</h3></a>
</header>

<h1 class="titel">Profiel bewerken</h1>

<form action="edit.php" method="post">
    <div class="center">
    Naam: <input type="text" name="name" value="<?php echo $row['name']; ?>" ></br></br>
    E-mail: <input type="text" name="email" value="<?php echo $row['email']; ?>" ></br></br>
 

<form action="" class="knoppen" method="post">

<div class="buttons">
    <button name="edit">Profiel bewerken</button>
</div>
</div>
    </form>
        
<?php
 
 if(isset($_POST['edit'])){
 $unique_id=$_SESSION['unique_id'];
 $name=$_POST['name'];
 $email=$_POST['email'];
 $select= "SELECT * FROM signup WHERE unique_id='$unique_id'";
 $sql = mysqli_query($conn,$select);
 $row = mysqli_fetch_assoc($sql);
 $res= $row['unique_id'];
 if($res === $unique_id){
    $update = "UPDATE signup SET name='$name',email='$email' WHERE unique_id='$unique_id'";
    $sql2=mysqli_query($conn,$update);
if($sql2){ 
        /*Successful*/
        header('location:profile.php');
    }
    else{
        /*sorry your profile is not update*/
        header('location:homepage.php');
    }
 }
 else{
     /*sorry your id is not match*/
     header('location:homepage.php');
 }
 if($res === $unique_id){
    $update = "UPDATE goals SET naam='$name' WHERE unique_id='$unique_id'";
    $sql3=mysqli_query($conn,$update);
if($sql3){ 
        /*Successful*/
        header('location:profile.php');
    }
    else{
        /*sorry your profile is not update*/
        header('location:homepage.php');
    }
 }
 else{
     /*sorry your id is not match*/
     header('location:homepage.php');
 }
}
?>