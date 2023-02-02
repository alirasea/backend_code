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

 $sql = ("SELECT * FROM signup WHERE `signup`.`id` = {$_GET['id']}");
$result = $conn->query($sql); 
    while ($row=$result->fetch_assoc()) { 
    $id = $row['id']; 
    $unique_id = $row['unique_id']; 
    ?>
<header>
<a href="zoekSpeler.php" class="terug"><h3>Terug</h3></a>
</header>
<body>
<h1 class="titel">Speler profiel update</h1>
<tr> 
<td>   
    <form method="post" action="update.php">
    <div class="center">
    Naam:<br> <input type="text" name="name" value="<?php echo  $row['name']; ?>"><br><br>

          <input type="hidden" value="<?php echo $id; ?>" name="id" >
          <input type="hidden" value="<?php echo $unique_id; ?>" name="unique_id" >
        <input type="submit" class="btn btn-info" value="UPDATE" name="update" >
    </div>
</td>
</form>
</tr>
<?php }  ?> 
</table>