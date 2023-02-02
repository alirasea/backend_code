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

<?php
session_start();
    include "php/config.php";
    
    $sql = "SELECT * FROM signup WHERE `signup`.`id` = {$_GET['id']}";
    $result = $conn->query($sql);
    

    if ($result->num_rows > 0)  {


        // $select = "SELECT * FROM team_table INNER JOIN teams ON team_table.club = teams.club INNER JOIN signup ON teams.unique_id = signup.unique_id WHERE NOT signup.id = {$_GET['id']}";
        $select = "SELECT * FROM team_table";
        $result = $conn->query($select);

            // echo $_GET['teamid'];


        $sql = mysqli_query($conn, "SELECT * FROM signup WHERE `signup`.`id` = {$_GET['id']}");
        if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        }
        
?>
<header>
<a href="profileforadmin.php?page=profile&id=<?php echo $row['id'] ?>" class="terug"><h3>Terug</h3></a>
</header>
<h2 class="titel">Team toevoegen aan speler <?php echo $row['name'];?></h2>
<form class="form" action="updateTeamAdmin.php" method="post">
    <div class="centerselect">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" ></br></br>
    <input type="hidden" name="name" value="<?php echo $row['name']; ?>" ></br></br>
    <input type="hidden" name="unique_id" value="<?php echo $row['unique_id']; ?>" ></br></br>
    <!-- <div class="class"> -->
    <select name="club" class="form-control club" required>
        <option value="">--Select team--</option>
        <?php foreach($result as $rows): ?>
        <!-- <option><?php echo $_GET['teamid'];?></option> -->
        <option class="thuisclub" value="<?php echo $rows['club'];?>" ><?php echo $rows['club'];?></option>  
        
        <?php endforeach; ?>
    </select>

<button type="submit" name="save_select" id="toegevoegd" class="btn btn-primary">Invoeren</button>
</div>
</form>

<?php
    }
    $sql->close();
    ?>