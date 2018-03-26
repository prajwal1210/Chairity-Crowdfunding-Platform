<?php
session_start();

  $uOrC = "Username";
  if(isset($_POST['uOrC'])){
    $uOrC = $_POST['uOrC'];
  }  
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    header('Location: logout.php');
  }
  else if(isset($_POST['signup'])){
    $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    $result = mysqli_query($conn,"SELECT * FROM user_info WHERE username = '$username'");
    if (mysqli_num_rows($result) == 0 && $password == $repassword){
      $res = mysqli_query($conn,"INSERT INTO user_info values('$username','$password')");
      header("Location: account_created.php");
    } 
    else if(mysqli_num_rows($result) != 0){
        // Username already exists
    }
    else if($password!=$repassword){
        // Passwords don't match
    }
  }
  else{
    $_SESSION['loggedin'] = false;
  }
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Simple Login Form Template</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

  <div class="log-form" style="height:300px; width:400px;">
  <h2>Create an account</h2>
  <form method="post" action="signup.php">
	<h3>Choose Your Type</h3><br>
    <a href="signup1.php" class="btn">User</a><br/>
<br>   <a href="signup2.php" class="btn">Organisation</a><br>
    <a class="forgot" href="index.php">Already have an account? Login.</a>
  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 

</body>

</html>
