<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header('Location: login.php');
}

    include "php/config.php";

    // if(isset($_SESSION['unique_id'])){

    // }

    $sql = "SELECT * FROM signup WHERE unique_id = {$_SESSION['unique_id']}";
    $result = $conn->query($sql);



?>
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
<a href="homepage.php" class="terug"><h3>Terug</h3></a>
</header>

<h1 class="titel">Profiel</h1>

<form action="edit.php" method="post">
<div class="center">
    <?php foreach($result as $row): ?>
    Naam: <input type="text" name="name" placeholder="<?php echo $row['name']; ?>" disabled></br>
    E-mail: <input type="text" name="email" placeholder="<?php echo $row['email']; ?>" disabled></br>
    <?php
    
endforeach;

?>
    <!-- Team: <input type="text" name="team" placeholder=" " disabled></br></br> -->

<?php    if($_SESSION['unique_id'] != '815362009'){
        echo "Team: ";
    
        $select = "SELECT * FROM signup INNER JOIN goals ON signup.name = goals.name INNER JOIN team_table ON goals.team = team_table.club WHERE signup.unique_id = {$_SESSION['unique_id']}";
$result = $conn->query($select);
foreach($result as $rows):
    ?>
    <div class="goalnumbers">
        <a href='teamSpelersUser.php?page=team&TeamId=<?php echo $rows["TeamId"] ?>&club=<?php echo $rows['club'];?>' id='teamlink'> 
            <div class='goalteams'><?php echo $rows["team"]; ?></div>
        </a><br>
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
        </form>
        <?php
}
?>
    </div>   
<div class="knoppen">
<div class="buttons">
    <a href="edit.php"><button>Profiel bewerken</button></a>
</div> 
</div>
</body><br>