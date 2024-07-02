<!DOCTYPE html>
<?php
include("../connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['submit'])) && ($_POST['submit'] == 'Submit')) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password = md5($password);

  $sql = "INSERT INTO users (roleuser, fname, lname, email, password) VALUES ('1', '$fname', '$lname', '$email', '$password')";
  if ($conn->query($sql) === TRUE) {
    header('Location: login_signup.php');
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eclass</title>

    <link rel="stylesheet" href="style_loginsignup.css" />

    <script
      src="https://kit.fontawesome.com/52b0a695e8.js"
      crossorigin="anonymous"
    ></script>
    <script defer src="../script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <header>
      <div class="container">
        <h1 class="logo">
          <a href="../index.html"> <i class="fas fa-graduation-cap"></i>Eclass </a>
        </h1>
        </div>
    </header>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Login Form</div>
        <div class="title signup">Signup Form</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form action="../home/student.html" class="login">
            <div class="field">
              <input type="text" placeholder="Email Address" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Password" required>
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Login">
            </div>
            <div class="signup-link">Not a member? <a href="">Signup now</a></div>
            <div class="signup-link">Are you a professor? <a href="../professor/login_signup.php">Log in here</a></div>
          </form>
          <form action="login_signup.php" method="POST" class="signup">
            <div class="field">
              <input type="text" name="fname" placeholder="First Name" required>
            </div>
            <div class="field">
              <input type="text" name="lname" placeholder="Last Name" required>
            </div>
            <div class="field">
              <input type="text" name="email" placeholder="Email Address" required>
            </div>
            <div class="field">
              <input type="password" name="password" placeholder="Password" required>
            </div>
            <!-- <div class="field">
              <input type="password" placeholder="Confirm password" required>
            </div> -->
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name="submit" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>

  </body>
</html>
