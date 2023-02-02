<?php 
session_start();


?>
<link rel="stylesheet" href="style/home.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<body>
    <header>
        <h2>Admin</h2>
        <div class="uitloggen">
        <a id="uitloggen" href="zoekSpeler.php">Zoeken</a>
        <a id="uitloggen" href="profile.php">Profiel</a>
        <a id="uitloggen" href="logout.php">Uitloggen</a>
        </div>
    </header>

<div id="links">
<a class="links" href="addTeam.php">Manage teams</a><br>
<a class="links" href="random.php">Add User to team</a><br>
<a class="links" href="uitslagInvoeren.php">Uitslag invoeren</a><br>
<a class="links" href="uitslag.php">Uitslag overzicht</a><br>
<a class="links" href="uitslag.php">Edit user stats</a><br>
</div>

</body>