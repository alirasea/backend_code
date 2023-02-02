



<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header('Location: login.php');
}
if($_SESSION['unique_id'] == '815362009'){
    header("Location: adminhome.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="style/home.css" rel="stylesheet">
    <title>Welkom</title>
</head>
<body>
<header>
    <h2>Speler</h2>
    <div class="uitloggen">
        <a id="uitloggen" href="zoekSpelerUser.php">Zoeken</a>
        <a id="uitloggen" href="profile.php">Profiel</a>
        <a id="uitloggen" href="logout.php">Uitloggen</a>
    </div>
</header>
<div id="links">
    <a class="links" href="stand.php">Stand</a>
    <a class="links" href="uitslag.php">Uitslag</a>
</div>
</body>
    </html>