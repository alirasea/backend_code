<?php
 session_start();
 if(!isset($_SESSION['unique_id'])){
    header('Location: login.php');
}
if($_SESSION['unique_id'] !== '815362009'){
    header("Location: homepage.php");
}
?>
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

        $dbc = mysqli_connect('localhost','root','','stattracker')
        or die('Error connecting to MySQL server');

        $query = "SELECT * FROM signup  WHERE NOT name ='admin'";

$result = mysqli_query($dbc,$query)
or die('Error querying database');

$count=mysqli_num_rows($result);

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
    
<form method="post">
    <?php
    
while ($row=mysqli_fetch_array($result)) {

    $select = mysqli_query($conn, "SELECT *,SUM(goals) AS allGoals, SUM(assist) AS allAssists FROM goals INNER JOIN signup ON goals.unique_id = signup.unique_id WHERE signup.id = {$row['id']}");
    if(mysqli_num_rows($select) > 0){
    $rows = mysqli_fetch_assoc($select);
    }
?>
    <li class='spelers'><div class="hallo"><input name='checkbox[]'  type='checkbox' class="checkbox" id="checkbox" value='<?php echo $row['unique_id']; ?>'><i class="fa-regular fa-futbol"></i><div class='zoekInfo'><a href='profileforadmin.php?page=profiel&id=<?php echo $row["id"]; ?>'><?php echo $row["name"]; ?></a><span> Goals:  <?php echo $rows['allGoals']; ?> <br> Assists: <?php echo $rows['allAssists']; ?></span></div><br><a href='updateSpelerAdmin.php?page=edit&id=<?php echo $row["id"]; ?>' class='adminupdate'><span>Verander gegevens</span></a></div><a href='delete.php?page=delete&id=<?php echo $row["id"];?>' id='names'><i class='fas fa-trash-alt'></i></a></li>
<?php    
}

$sql = "SELECT * FROM team_table";

$results = mysqli_query($dbc,$sql)
or die('Error querying database');

$count=mysqli_num_rows($results);

while ($rows=mysqli_fetch_array($results)) {
    $select = mysqli_query($conn, "SELECT SUM(goals) AS allGoalsTeams, SUM(assist) AS allAssistsTeams FROM goals INNER JOIN team_table ON goals.team = team_table.club WHERE goals.team = '{$rows['club']}'");
    if(mysqli_num_rows($select) > 0){
    $row = mysqli_fetch_assoc($select);
    }
 ?>
 

<li class='spelers'><div class="hallo"><i class="fa-solid fa-people-group"></i><div class="zoekInfo"><a href='teamSpelers.php?page=team&TeamId=<?php echo $rows["TeamId"] ?>&club=<?php echo $rows['club'];?>'><?php echo $rows["club"]; ?></a><span> Goals:  <?php echo $row['allGoalsTeams']; ?> <br> Assists: <?php echo $row['allAssistsTeams']; ?></span></div></div><a href='deleteTeam.php?page=delete&club=<?php echo $rows["club"];?>' id='names'><i class='fas fa-trash-alt'></i></a></li>   

<?php } ?>
<input name="delete" class="bulkdelete" id="bulkdelete" type="submit" value="Delete">
<?php

if(isset($_POST['delete']))
{
    $checkbox = $_POST['checkbox'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];
$sql = "DELETE FROM signup WHERE unique_id='$del_id'";
$result = mysqli_query($dbc, $sql);
}

for($i=0;$i<count($checkbox);$i++){

    $del_id = $checkbox[$i];
    $sql = "DELETE FROM teams WHERE unique_id='$del_id'";
    $result = mysqli_query($dbc, $sql);
    }

    for($i=0;$i<count($checkbox);$i++){

        $del_id = $checkbox[$i];
        $sql = "DELETE FROM goals WHERE unique_id='$del_id'";
        $result = mysqli_query($dbc, $sql);
        }

// if successful redirect to delete_multiple.php 
if($result){
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=homepage.php\">";
}
 }

mysqli_close($dbc);
?>
</form>
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
