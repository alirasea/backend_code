<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link href="style/links.css" rel="stylesheet">
<style>
        ::placeholder {
    color: white;
    opacity: 1; /* Firefox */
}

    </style>
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


// $sql = "SELECT * FROM teams WHERE unique_id = {$result['unique_id']}";
// $results = $conn->query($sql);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$select = mysqli_query($conn, "SELECT * FROM signup INNER JOIN goals ON signup.name = goals.name INNER JOIN team_table ON goals.team = team_table.club WHERE signup.id = {$id}");
if(mysqli_num_rows($select) > 0){
$row = mysqli_fetch_assoc($select);
}

?>

<!-- <body> -->
<header>
<a href="zoekSpeler.php" class="terug"><h3>Terug</h3></a>
</header>
<body>
<h1 class="titel">Profiel</h1>
<div class="center">
        Naam speler: <input type="text" name="name" placeholder="<?php echo $result["name"]; ?>" disabled><br>
        Email: <input type="text" name="email" placeholder="<?php echo $result["email"]; ?>" disabled><br>
        
        Team:

        <?php
                $delete = array("id"=>$_GET["id"]);
                $sql = "SELECT * FROM `signup` WHERE `signup`.`id` = :id";
                $stmt = $verbinding->prepare($sql);
                $stmt->execute($delete);
                $results = $stmt->fetch();

                    $select = "SELECT * FROM signup INNER JOIN goals ON signup.name = goals.name INNER JOIN team_table ON goals.team = team_table.club WHERE signup.id = {$_GET['id']}";
    $result = $conn->query($select);
foreach($result as $rows):
    ?>
    <div class="goalnumbers">
        <table id="userClubs">
            <tr>
                <td class="tdclass">
            <a href='teamSpelers.php?page=team&TeamId=<?php echo $rows["TeamId"] ?>&club=<?php echo $rows['club'];?>' id='teamlink'> 
            <div class='goalteams'><?php echo $rows["team"]; ?></div>
         </a>
        </td>
        <td class="tdclass">
        <a style='color: black;' href='removeFromTeam.php?club=<?php echo $rows["club"];?>&id=<?php echo $rows['unique_id'];?>' id='names'>
        <i class='fas fa-trash-alt'></i>
        </a>
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

        <?php endforeach;
                        $sql = "SELECT * FROM signup INNER JOIN goals ON signup.name = goals.name INNER JOIN team_table ON goals.team = team_table.club WHERE signup.id = {$_GET['id']}";
                        $result = $conn->query($sql);

        // $select = mysqli_query($conn, "SELECT * FROM signup INNER JOIN goals ON signup.name = goals.naam INNER JOIN team_table ON goals.team = team_table.club WHERE signup.id = {$_GET['id']}");
        // if(mysqli_num_rows($select) > 0){
        // $row = mysqli_fetch_assoc($select);
        // }
        ?> 
        </div>
        <div class="buttons">
        <a href="userTeamToevoegen.php?page=profiel&id=<?php echo $results["id"]; ?>"><button>Team toevoegen</button></a>
        </div>


</div>
</body><br>