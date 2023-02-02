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
include "php/config.php";

 $sql = ("SELECT * FROM goals WHERE `goals`.`goals_id` = {$_GET['id']}");
$result = $conn->query($sql); 
    while ($row=$result->fetch_assoc()) { 


    $id = $row['goals_id']; 

    ?>
<header>
<a href="zoekSpeler.php" class="terug"><h3>Terug</h3></a>
</header>
<body>
<h1 class="titel">Voeg punten toe aan speler <?php echo  $row['name']; ?></h1>
<tr> 
<td>   
    <form method="post" action="updateGoals.php">
    <div class="center">

    <label>Goals:</label>
    <input type="number" name="goals" class="goal" value="<?php echo  $row['goals']; ?>" min="0"><br>

    <label>Assists:</label>
    <input type="number" name="assist" class="goal" value="<?php echo  $row['assist']; ?>" min="0"><br><br>


    <?php 
    $select = mysqli_query($conn, "SELECT * FROM signup INNER JOIN goals ON signup.unique_id = goals.unique_id WHERE goals.goals_id = {$_GET['id']} ");
    if(mysqli_num_rows($select) > 0){
    $rows = mysqli_fetch_assoc($select);
    }
    ?>
        <input type="hidden" value="<?php echo $rows['id']; ?>" name="homeId" >
        <input type="hidden" value="<?php echo $id; ?>" name="id" >
        <input type="submit" class="btn btn-info" value="UPDATE" name="update" >
    </div>
</td>
</form>
</tr>
<?php }  ?> 
</table>