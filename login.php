<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: homepage.php");
  }
?>
    <script src=
        "https://www.google.com/recaptcha/api.js" async defer>
    </script>
<link href="style/index.css" rel="stylesheet">
<body>
  <!-- <div class="container"> -->
  <div class="wrapper">
    <section class="form login">
      <h1>Login</h1>
      <form action="action.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="form-group">
          <label>Email Address</label><br>
          <input class="form-control" type="text" name="email" required>
        </div>
        <div class="form-group">
          <label>Password</label><br>
          <input class="form-control" type="password" name="password" required>
          <i class="fas fa-eye"></i>
        </div>
                <!-- div to show reCAPTCHA -->
        <div class="g-recaptcha"
          data-sitekey="6Lez8WAiAAAAAIkZgkK1Q4XAea0zUGkthdHJnKGf">
        </div>

        <div class="field button">
          <input type="submit" class="btn" name="submit_btn" value="Login">
        </div>
      </form>
      <div class="link">Nog geen account? <a href="index.php">Account aanmaken</a></div>
    </section>
  </div>
        <!-- </div> -->

</body>
</html>
<script src="javascript/login.js"></script>