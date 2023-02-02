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
<h2 class="titel">Stand</h2>
<div class="center">
    <?php
    include "php/config.php";
    ?><br>
    <table  class='thclass'>
        <tr>
            <th>Teams</th>
            <th>Total goals</th>
            <th>Total assist</th>
        </tr>
        <?php
            $select = mysqli_query($conn, "SELECT *, SUM(goals) AS allGoals, SUM(assist) AS allAssists FROM goals");
            if(mysqli_num_rows($select) > 0){
            $rows = mysqli_fetch_assoc($select);
            }
            $sql = "SELECT team_table.club as team, SUM(goals) AS allGoals, SUM(assist) AS allAssists FROM goals INNER JOIN team_table ON goals.team = team_table.club GROUP BY team_table.club ORDER BY allGoals DESC";
            $results = $conn->query($sql);
            foreach($results as $row):
                $select = mysqli_query($conn, "SELECT * FROM goals INNER JOIN team_table ON goals.team = team_table.club WHERE goals.team = '{$row['club']}'");
            if(mysqli_num_rows($select) > 0){
                $rows = mysqli_fetch_assoc($select);
            }
        
        
        
        
        
        
            echo "
            <tr>
            <td class='statsTeam'><a href='teamSpelersUser.php?page=team&TeamId=".$rows["TeamId"] ."&club=".$rows['team'] ."'>".$row['team'] ."</a></td>
            <td class='stats'>".$row['allGoals'] ."</td>
            <td class='stats'>".$row['allAssists'] ."</td>
            </tr>"; 
        endforeach;
        
    /*    $sql = "SELECT team_table.club as team, SUM(goals) AS allGoals, SUM(assist) AS allAssists FROM goals INNER JOIN team_table ON goals.team = team_table.club GROUP BY team_table.club ORDER BY allGoals DESC";
$results = mysqli_query($conn, $sql);

if (!$results) {
    die("Query failed: " . mysqli_error($conn));
}

if(mysqli_num_rows($results) > 0){
    while($row = mysqli_fetch_assoc($results)) {
        echo "Team: " . $row['team'] ."<br>" . " Total Goals: " . $row['allGoals'] . "<br>" ." Total Assists: " . $row['allAssists'] . "<br>" ."<br>";
    }
} else {
    echo "No results found";
}
*/



        
        ?>
</table>
</div>