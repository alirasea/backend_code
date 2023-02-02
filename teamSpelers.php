<?php  
 $connect = mysqli_connect("localhost", "root", "", "stattracker");  
 $sql = "SELECT * FROM team_table INNER JOIN teams ON team_table.club = teams.club INNER JOIN signup ON teams.naam = signup.name WHERE `team_table`.`TeamId` = {$_GET['TeamId']}";  
 $result = mysqli_query($connect, $sql);  
 ?>  
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

<body>
    <header>
<a href="adminhome.php" class="terug"><h3>Terug</h3></a>
</header>
<?php
include "php/config.php";
$select = mysqli_query($conn, "SELECT * FROM team_table WHERE `team_table`.`TeamId` = {$_GET['TeamId']}");
if(mysqli_num_rows($select) > 0){
$rows = mysqli_fetch_assoc($select);
}
?>

<h2 class="titel">Team <?php echo $rows['club'];?></h2>

<div class="center">

<?php
           if ($result->num_rows > 0) {
            // output data of each row
            ?>
            <table class="orderedTeams">
                    <tr>
                        <th class="tableRow">Naam speler</th>
                        <th class="tableRow">Goals</th>
                        <th class="tableRow">Assists</th>
                        <th></th>
                    </tr>
                    <?php
            $select = "SELECT * FROM team_table INNER JOIN goals ON team_table.club = goals.team WHERE `team_table`.`TeamId` = {$_GET['TeamId']}";
            $results = $conn->query($select);

            foreach($results as $row):   
                $select = mysqli_query($conn, "SELECT * FROM signup WHERE signup.name = '{$row['naam']}'");
                if(mysqli_num_rows($select) > 0){
                $rows = mysqli_fetch_assoc($select);
                }
    

            echo    "<tr>
            <td class='tableRow'><a href='profile2.php?page=speler&id=" . $rows['id']. "''>". $row['naam'] . "</a></td>
                        <td class='tableRow'>". $row['goals'] . "</td>
                        <td class='tableRow'>". $row['assist'] . "</td>
                        <td class='tableRow'><a style='color: black;' href='puntenToevoegen.php?page=toevoegen&id=" . $row['goals_id']. "'>Gegevens aanpassen</a></td>
                    </tr>";
            endforeach;
            ?>
                        <tr>
                        <td></td>
                        <td><?php
                                        $sql = mysqli_query($conn, "SELECT SUM(goals) AS allGoals FROM goals WHERE team = '{$_GET['club']}'");
                                        if(mysqli_num_rows($sql) > 0){
                                        $rows = mysqli_fetch_assoc($sql);
                                        }
                        echo $rows['allGoals']; 
                        ?></td>
                        <td><?php
                                        $sql = mysqli_query($conn, "SELECT SUM(assist) AS allAssists FROM goals WHERE team = '{$_GET['club']}'");
                                        if(mysqli_num_rows($sql) > 0){
                                        $rows = mysqli_fetch_assoc($sql);
                                        }
                        echo $rows['allAssists']; 
                        ?></td>
                    </tr>
        </table>
        <?php
        } else {
            echo "0 Spelers";
        }
        ?>
</div>