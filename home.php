

<?php
    session_start();
    include "php/config.php";
    if($_SESSION['unique_id'] == '815362009') {
        header("Location: adminhome.php");
    }

    $sql = "SELECT unique_id FROM teams WHERE unique_id = {$_SESSION['unique_id']}";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        header("Location: homepage.php");
    } else {

    $sql = "SELECT * FROM teams";
    $result = $conn->query($sql);

    $sql = mysqli_query($conn, "SELECT * FROM signup WHERE unique_id = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="style/home.css" rel="stylesheet">
    <title>Welkom</title>
</head>
<body>
<header>
    <h2>Speler</h2>
</header>
<form action="insertTeam.php" method="post">
    <h2 class="titel">Selecteer jou team</h2>
    <div class="center">
        <input type="hidden" name="name" value="<?php echo $row['name']; ?>" ></br></br>
        <input type="hidden" name="unique_id" value="<?php echo $row['unique_id']; ?>" ></br></br>
        <input type="hidden" name="goals" value="0" ></br></br>
        <input type="hidden" name="assist" value="0" ></br></br>
    <select name="club" class="form-control">
        <option value="">--Select team--</option>
        <option value="">Ömar</option>
        <option value="">Ehsan</option>
        <option value="">Ali</option>
        <option value="">Mohammed</option>
        <option value="">Khaled</option>
        <?php foreach($result as $row): ?>
        <option class="thuisclub" value="<?php echo $row['club'];?>" ><?php echo $row['club'];?></option>  
        <?php endforeach; ?>
    </select>
    <button type="submit" name="save_select" class="btn btn-primary">Invoeren</button>
    </div>
</form>
<?php
}
    $sql->close();
?>