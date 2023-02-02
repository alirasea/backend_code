<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<link href="style/links.css" rel="stylesheet">

<?php
session_start();

include "php/config.php";

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

 
$delete = array("id"=>$_GET["id"]);
$sql = "SELECT * FROM `signup` WHERE `signup`.`id` = :id";
$stmt = $verbinding->prepare($sql);
$stmt->execute($delete);
$result = $stmt->fetch();

if(isset($_POST["toevoegen"])){
    header("Location:veranderTeam.php");
}



?>
    <style>
        ::placeholder {
    color: white;
    opacity: 1; /* Firefox */
}

    </style>
<!-- <body> -->
<header>
<a href="zoekSpelerUser.php" class="terug"><h3>Terug</h3></a>
</header>
<div class="container">
<h1 class="titel">Profiel</h1>
    <div class="center">
        Naam speler: <input type="text" name="name" placeholder="<?php echo $result["name"]; ?>" disabled><br><br>
        <?php
        $select = "SELECT * FROM signup INNER JOIN goals ON signup.name = goals.name INNER JOIN team_table ON goals.team = team_table.club WHERE signup.id = {$_GET['id']}";
$result = $conn->query($select);
foreach($result as $rows):
    ?>
    <div class="goalnumbers">
        <table id="userClubs">
            <tr>
                <td class="tdclass">
        <a href='teamSpelersUser.php?page=team&TeamId=<?php echo $rows["TeamId"] ?>&club=<?php echo $rows['club'];?>' id='teamlink'> 
            <div class='userClubs2'><?php echo $rows["team"]; ?></div>
         </a>
        </td>
        </td>
            </tr>
        </table>
        <div class='scores'>
            <div class='goal'>
            <label>Goals:</label>
            <div class='goals'><?php echo $rows['goals']; ?></div>
            </div>
            <div class='goal'>
            <label>Assits:</label>
            <div class='goals'><?php echo $rows['assist']; ?></div>
            </div>  
        </div><br><br>
        <?php endforeach;?>
</div>
        <!-- <div class='scores'>
        <div class='goal'>
        <label>Goals:</label>
        <div class='goals'><?php echo $result['goals']; ?></div>
        </div>
        <div class='goal'>
        <label>Assits:</label>
        <div class='goals'><?php echo $result['assist']; ?></div>
        </div>
        </div> -->
        Team: 

        <ul id="userClubs2">
            <li>
        <?php 
        $sql = "SELECT * FROM goals WHERE unique_id = {$result['unique_id']}";
        $results = $conn->query($sql);
        foreach($results as $rows): ?>

        <?php endforeach; ?>
        </li>
        </ul>
        


    </div>
</div>

<!-- </body> -->

<!-- </body> -->