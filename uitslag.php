<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>uitslag</title>
</head>
<body>
<header>
<a href="adminhome.php" class="terug"><h3>Terug</h3></a>
</header>


<?php 
                    include "php/config.php";
            
                    $sql = "SELECT thuisteam,thuisgoals,uitteam,uitgoals FROM uitslag";
                    $result = $conn->query($sql);
                ?>
<h2 class="titel">Uitslag</h2>
<div class="uitslagen">
<table >
    <!-- <tr>
    <td>
            thuisteam <span class="padding"></span> thuisgoals <span class="padding"></span> uitteam <span class="padding"></span> uitgoals
        </td>
    </tr> -->
    <th>Thuisteam</th>
    <th>Thuisgoals</th>
    <th>Uitteam</th>
    <th>Uitgoals</th>
<?php foreach($result as $row): ?>
    <tr>
        <td class="padding">
                <?php echo $row['thuisteam']; ?>     
        </td>
        <td class="padding">
            <?php echo $row['thuisgoals']; ?>
        </td>
        <td class="padding">
            <?php echo $row['uitteam']; ?>
        </td>
        <td class="padding">
            <?php echo $row['uitgoals']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    
</table>
</div>

</body>
</html>
