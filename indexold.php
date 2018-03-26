<?php
session_start();

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    header('Location: logout.php');
  }
  else if(isset($_POST['login'])&&isset($_POST['username'])&&isset($_POST['password'])){
    $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $username = $_POST['username'];
    $result = mysqli_query($conn,"SELECT * FROM Organization WHERE org_id = '$username'");
    if (mysqli_num_rows($result) == 1){
      while($row = mysqli_fetch_array($result)){
        if($row['pass'] == $_POST['password']){        
          $_SESSION['loggedin']=true;
          $_SESSION['id']=$username;
          header('Location: Pro/index.php');
        }
      } 
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  
</head>

<body>
  <div class="log-form">
  <h2>Login to your account</h2>
  <form method="post" action="index.php">
    <input type="text" name="username" title="username" placeholder="Username" />
    <input type="password" name="password" title="password" placeholder="Password" />
    <!-- <a class="forgot" href="signup.php">Don't have an account? Create one.</a> -->
    <button type="submit" class="btn" name="login" value="Login" style="display: inline-block; float: left;font-size:0.9em;">Login User</button>
    <button type="submit" class="btn" name="login" value="Login" style="display: inline-block; float: right;font-size:0.9em;">Login Organisation</button>
    <a class="forgot" href="index.html" style="float: left; display: inline-block;">Return to Home</a>
    <a class="forgot" href="signup.php" style="display: inline-block;">Don't have an account? Create one</a>
    <br>
    <br>
    <br>
    <br>
    <!-- <a href="index.html" class="btn" style="text-decoration: none">Return to Home</a>  -->
    
  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 

</body>

</html>
