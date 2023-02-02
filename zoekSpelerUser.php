<script src="https://kit.fontawesome.com/066abe0b65.js" crossorigin="anonymous"></script>
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
        include "php/config.php";
        
        // $sql = mysqli_query($conn, "SELECT name FROM signup");
        // if(mysqli_num_rows($sql) > 0){
        // $row = mysqli_fetch_assoc($sql);
        // }

        $sql = "SELECT * FROM signup WHERE NOT name = 'admin'";
        $result = $conn->query($sql);


?>
<body>
    <header>
<a href="adminhome.php" class="terug"><h3>Terug</h3></a>
</header>

<h2 class="titel">Speler of team zoeken</h2>

<div class="myInput">
<label>Zoek naam of team:</label>
<input type="text" id="myInput" name="input" onkeyup="myFunction()" title="Type in a name">
</div>
<div class="wrapper">
<ul id="myUL">
    <?php
    
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
    $select = mysqli_query($conn, "SELECT *,SUM(goals) AS allGoals, SUM(assist) AS allAssists FROM goals INNER JOIN signup ON goals.unique_id = signup.unique_id WHERE signup.id = {$row['id']}");
                if(mysqli_num_rows($select) > 0){
                $rows = mysqli_fetch_assoc($select);
                }
?>

                    <li class='spelers'><div class="hallo"><i class="fa-regular fa-futbol"></i><div class='zoekInfo'><a href='profile2.php?page=profiel&id=<?php echo $row["id"]; ?>'><?php echo $row["name"]; ?></a><span> Goals: <?php echo $rows['allGoals']; ?><br> Assists: <?php echo $rows['allAssists']; ?></span></div></div><br></li>
            <?php
                }
        } else {
            echo "0 results";
        }

        $sql = "SELECT TeamId, club FROM team_table ";
$results = $conn->query($sql);

 foreach($results as $rows):
        $select = mysqli_query($conn, "SELECT SUM(goals) AS allGoalsTeams, SUM(assist) AS allAssistsTeams FROM goals INNER JOIN team_table ON goals.team = team_table.club WHERE goals.team = '{$rows['club']}'");
        if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        }
 ?>

<li class='spelers'><div class="hallo"><i class="fa-solid fa-people-group"></i><div class='zoekInfo'><a href='teamSpelersUser.php?page=team&TeamId=<?php echo $rows["TeamId"] ?>&club=<?php echo $rows['club'];?>'><?php echo $rows["club"]; ?></a><br><span> Goals:  <?php echo $row['allGoalsTeams']; ?> <br> Assists: <?php echo $row['allAssistsTeams']; ?></span></div></div><br></li> 

<?php endforeach; ?>
    
</ul>
</div>

<br>
</body>
<script>

var UL = document.getElementById("myUL");
// hilde the list by default
UL.style.display = "none";

var searchBox = document.getElementById("myInput");

// show the list when the input receive focus
searchBox.addEventListener("focus",  function(){
    // UL.style.display = "block";
});

// hide the list when the input receive focus
searchBox.addEventListener("click", function(){
    UL.style.display = "none";
});


function myFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    ul = document.getElementById("myUL");
    filter = input.value.toUpperCase();
    // if the input is empty hide the list
    if(filter.trim().length < 1) {
        ul.style.display = "none";
        return false;
    } else {
        ul.style.display = "block";
    }
    
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];

        // This is when you want to find words that contain the search string
     if (a.innerHTML.toUpperCase().indexOf(filter) > -1) { 
        li[i].style.display = "";
     } else {
        li[i].style.display = "none";
    } 
    
    }

}
</script>
