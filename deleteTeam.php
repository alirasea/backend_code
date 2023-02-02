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
$hostname = "localhost";
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
}

$delete = array("club"=>$_GET["club"]);
$sql = "SELECT * FROM `team_table` WHERE `team_table`.`club` = :club";
$stmt = $verbinding->prepare($sql);
$stmt->execute($delete);
$result = $stmt->fetch();

if(isset($_POST["delete"])){

    $delete = array("club"=>$_GET["club"]);
    $sql = "DELETE FROM `team_table` WHERE `team_table`.`club` = :club";
    $stmt = $verbinding->prepare($sql);
    $stmt->execute($delete);

    $delete = array("club"=>$_GET["club"]);
    $sql = "DELETE FROM `teams` WHERE `teams`.`club` = :club";
    $stmt = $verbinding->prepare($sql);
    $stmt->execute($delete);

    $delete = array("club"=>$_GET["club"]);
    $sql = "DELETE FROM `goals` WHERE `goals`.`team` = :club";
    $stmt = $verbinding->prepare($sql);
    $stmt->execute($delete);

    header("Location:zoekSpeler.php");
}

?>
<body>
    <header>
<a href="zoekSpeler.php" class="terug"><h3>Terug</h3></a>
</header>

<h2 class="titel">Speler of team zoeken</h2>
<div class="center">
    <div class="buttons">
        <p>Weet u zeker dat u de speler <span class="highlight"><?php echo $result["club"]; ?></span> wilt verwijderen?</p>
        <form action="" class="knoppen" method="post">
            <input type="submit" class="cancel" id="delete" name="delete" value="Verwijderen">
        </form>

    </div>
    </div>