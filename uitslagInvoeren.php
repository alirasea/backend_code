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

                    $sql = "SELECT club FROM team_table";
                    $result = $conn->query($sql);
                ?>

    <h2 class="titel">Uitslag invoeren</h2>
    <form action="insertUitslag.php" method="POST">
        <table class="uitslag">
            <tr>
                <th><label for="">Thuisteam</label></th>
                <th><label for="">Thuisgoals</label></th>
                <th><label for="">Uitteam</label></th>
                <th><label for="">Uitgoals</label></th>
            </tr>
            <tr>
                <td>
                <select name="thuisteam" class="form-control" required>
                    <option value="" >--Select team--</option>
                    <?php foreach($result as $row): ?>
                    <option class="thuisclub" ><?php echo $row['club']; ?></option>
                    <?php endforeach; ?>
                </select>
                </td>
                <td class="points">
                    <input type="number" name="thuisgoals" class="form-control" value="0" />
                </td>
                <td>
                    <select name="uitteam" class="form-control" required>
                        <option value="">--Select team--</option>
                        <?php foreach($result as $row): ?>
                        <option class="thuisclub"><?php echo $row['club'];?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <input type="number" name="uitgoals" class="form-control" value="0" />
                </td>
                <td>
                    <button type="submit" name="save_select" id="save_select" class="btn btn-primary">Invoeren</button>
                </td>
            </tr>
            </table>
    </form>
</body>
</html>