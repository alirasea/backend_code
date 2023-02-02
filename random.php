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
    include "php/config.php";
    $sql = "SELECT * FROM `signup` ORDER BY RAND() LIMIT 5";
$result = $conn->query($sql);

$dbc = mysqli_connect('localhost','root','','stattracker')
or die('Error connecting to MySQL server');

$query = "SELECT * FROM signup WHERE NOT name ='admin' ORDER BY RAND() LIMIT 5";

$result = mysqli_query($dbc,$query)
or die('Error querying database');

$count=mysqli_num_rows($result);

?>
<body>
    <header>
<a href="adminhome.php" class="terug"><h3>Terug</h3></a>
</header>

<h2 class="titel">Random team aanmaken</h2>

<form action='' method='post'>
<div class="center">
<?php

while ($row=mysqli_fetch_array($result)) {
echo "
    <input style='display: none;'  name='randomnames[]'  type='checkbox' value='" .$row['name'] . "' checked>
    <label>" .$row['name'] . "</label>
    <input style='display: none;' type='checkbox' name='unique_id[]' value=" .$row['unique_id'] . " checked><br>
";
}
$sql = "SELECT * FROM `team_table`";
$result = $conn->query($sql);

?>


<input type="text" class="addTeam" name="club" placeholder="Team naam invullen..." required>
    <input type='submit' id='random' name='random' value='Aanmaken'>
    </div>
    </form>
<?php

if(isset($_POST['random']))
{
    $checkbox = $_POST['randomnames'];
    $checkBox = $_POST['unique_id'];
    $club = $_POST['club'];

for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];
$unique_id = $checkBox[$i];
$sql = "INSERT INTO teams(name, unique_id, club) VALUE('$del_id', '$unique_id', '$club')";
$result = mysqli_query($dbc, $sql);
}
for($i=0;$i<count($checkbox);$i++){

$del_id = $checkbox[$i];
$unique_id = $checkBox[$i];
$sql2 = "INSERT INTO goals(name, unique_id, team) VALUE('$del_id', '$unique_id', '$club')";
$results = mysqli_query($dbc, $sql2);
}

$sql = "INSERT INTO team_table(club) VALUE('$club')";
$result = mysqli_query($dbc, $sql);

// if successful redirect to delete_multiple.php 
if($result){
    
    if($result > 0){
        echo $result;
    }
    //echo "<meta http-equiv=\"refresh\" content=\"0;URL=homepage.php\">";
}else{
    echo "your data is not inserted";
}
 }

mysqli_close($dbc);
?>

</body>