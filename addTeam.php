<?php

require_once "php/config.php";
 
// Define variables and initialize with empty values
$club = $team = "";
$club_err = $team_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate team
    if(empty(trim($_POST["club"]))){
        $team_err = "Please enter a club.";
    } else{
        // Prepare a select statement
        $sql = "SELECT * FROM team_table WHERE club = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_team);
            
            // Set parameters
            $param_team = trim($_POST["club"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $team_err = "This club is already taken.";
                } else{
                    $club = trim($_POST["club"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Check input errors before inserting in database
    if(empty($club_err) && empty($team_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO team_table (club) VALUES (?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_club);
            
            // Set parameters
            $param_club = $club;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: adminhome.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>team toevoegen</title>
    <style>
        ::placeholder {
    color: white;
    opacity: 1; /* Firefox */
}

    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<link href="style/links.css" rel="stylesheet">
</head>
<body>
<header>
<a href="adminhome.php" class="terug"><h3>Terug</h3></a>
</header>
    <div class="wrapper">
        <h2 class="titel">Team toevoegen</h2>
        <form class="info" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Club</label>
                <input type="text" name="club" class="form-control <?php echo (!empty($club_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $club; ?>" required>
                <span class="invalid-feedback"><?php echo $team_err; ?></span>
            </div>    
            <div class="toevoegen">
            <input type="submit" class="btn btn-primary" value="Toevoegen">
            </div>
        </form>
    </div>    
</body>
</html>


