<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
<?php

/*$hostname = "localhost";
$username = "root";
$password = "";

try{
    $verbinding = new
    PDO("mysql:host=localhost;dbname=stattracker",$username,$password);
    $verbinding->setAttribute
    (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();
    echo "Kon geen verbinding maken";
}*/

include "php/config.php";



//if(isset($_GET['id'])){

    $stmt = mysqli_prepare($conn, "SELECT * FROM signup INNER JOIN teams ON signup.name = teams.name WHERE `signup`.`unique_id` = ?");
mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if(mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_assoc($result);
}
/*$sql = mysqli_query($conn, "SELECT * FROM signup INNER JOIN teams ON signup.name = teams.name WHERE `signup`.`unique_id` = {$_GET['id']}");
if(mysqli_num_rows($sql) > 0){
$row = mysqli_fetch_assoc($sql);
}*/
//}

    //else {
      //  echo" Redirect or show an error message";
       // }


if(isset($_POST["delete"])){

    $id = $_GET['id'];
    $club = $_GET['club'];

   // sql to delete a record
$sql = "DELETE FROM goals WHERE team='$club' AND unique_id='$id'";

   // print_r($sql);

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    header("Location:profileforadmin.php?page=profiel&id=".$row['id']."");
} 
else {
    echo "Error deleting record: " . mysqli_error($conn);
}

$sql2 = "DELETE FROM teams WHERE club='$club' AND unique_id='$id'";

   // print_r($sql);

if (mysqli_query($conn, $sql2)) {
    echo "Record deleted successfully";
    header("Location:profileforadmin.php?page=profiel&id=".$row['id']."");
} 
else {
    echo "Error deleting record: " . mysqli_error($conn);
}

}

if(isset($_POST['cancel'])){
    header("Location:profileforadmin.php?page=profiel&id=".$row['id']."");

}

?>
    <header>
<a href="profileforadmin.php?page=profiel&id=<?php echo $row['id'];?>" class="terug"><h3>Terug</h3></a>
</header>

<h2 class="titel">Team verwijderen</h2>
<div class="container">
    <div class="buttons">
        
        <p class="titel">Weet u zeker dat u <span class="highlight"><?php echo $row["name"] ." van de club ". htmlspecialchars($_GET['club'], ENT_QUOTES); ?></span> wilt verwijderen?</p>

        <form action="" class="knoppen" method="post">
            <div class="buttons">
            <input type="submit" class="cancel" id="delete" name="delete" value="Verwijderen">
            </div>
        </form>

    </div>
</div>