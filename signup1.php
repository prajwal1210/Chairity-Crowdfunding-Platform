<?php
session_start();

  $user_error = array('','','','','','','','','','','','','');
  $flag = 0;
    
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    header('Location: logout.php');
  }
  else if(isset($_POST['signup'])){
    $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $i = 0;
    foreach ($_POST as $param_name => $param_val) {
      if(empty($_POST[$param_name]) && $param_name != 'a_contact_no'){
          $user_error[$i] = 'This is a required field';
          $flag = 1;
      }
      $i = $i + 1;
    }
    if($flag == 0)
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $repassword = $_POST['repassword'];
      $dob = $_POST['dob'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $gender = $_POST['gender'];
      $wallet = $_POST['wallet'];
      $house_no = $_POST['house_no'];
      $street = $_POST['street'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $pin = $_POST['pin'];
      $contact_no = $_POST['contact_no'];
      $a_contact_no = $_POST['a_contact_no'];

      $result = mysqli_query($conn,"SELECT * FROM User WHERE user_id = '$username'");
      if (mysqli_num_rows($result) == 0 && $password == $repassword){
        $pass = md5($password);
        $res = mysqli_query($conn,"INSERT INTO User values('$username','$pass','$name','$gender','$dob','$house_no','$street','$city','$state',$pin,'$email',$wallet)");
        $res1 = mysqli_query($conn,"INSERT INTO User_contact_no values('$username',$contact_no)");
        if (!empty($a_contact_no)) {
          $res2 = mysqli_query($conn,"INSERT INTO User_contact_no values('$username',$a_contact_no)");
        }
        header("Location: index.php");
      } 
      else if(mysqli_num_rows($result) != 0){
          // Username already exists
        echo '<script type="text/javascript">

            window.onload = function () { alert("Username already exists"); }
          </script>'; 
      }
      else if($password!=$repassword){
          echo '<script type="text/javascript">

            window.onload = function () { alert("Passwords do not match"); }
          </script>';
          // Passwords don't match
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

  <div class="log-form" style="overflow:scroll; height:600px; width: 500px; padding:2em;">
  <h2>Create an account</h2>
  <br>
  <form method="post" action="signup1.php">
    <br>
    <?php if($user_error[0] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[0].'</div>';
    } 
    ?>
    <input type="text" name="username" title="username" data-validate = "Username is required" placeholder="Username" />
    <?php if($user_error[1] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[1].'</div>';
    } 
    ?>
    <input type="password" name="password" title="password" placeholder="Password" />
    <?php if($user_error[2] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[2].'</div>';
    } 
    ?>
    <input type="password" name="repassword" title="repassword" placeholder="Re-Enter Password" />
    <?php if($user_error[3] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[3].'</div>';
    } 
    ?>
    <input type="text" name="name" title="name" placeholder="Name" />
    <?php if($user_error[4] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[4].'</div>';
    } 
    ?>
    <input type="email" name="email" title="email" placeholder="Email" />
    <?php if($user_error[5] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[5].'</div>';
    } 
    ?>
    <input type="number" name="wallet" title="wallet" placeholder="Amount you want to add" />
    <?php if($user_error[6] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[6].'</div>';
    } 
    ?>
    <input type="date" name="dob" title="dob"/>
    <?php if($user_error[7] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[7].'</div>';
    } 
    ?>
    <p>Gender: </p>
    <input type="radio" name="gender" value="M" checked> Male<br>
    <input type="radio" name="gender" value="F"> Female<br>
    <input type="radio" name="gender" value="O"> Other<br> 
    <p>Billing Address: </p>
    <?php if($user_error[8] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[8].'</div>';
    } 
    ?>
    <input type="text" name="house_no" title="house_no" placeholder="House No." />
    <?php if($user_error[9] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[9].'</div>';
    } 
    ?>
    <input type="text" name="street" title="street" placeholder="Street" />
    <?php if($user_error[10] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[10].'</div>';
    } 
    ?>
    <input type="text" name="city" title="city" placeholder="City Name" />
    <?php if($user_error[11] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[11].'</div>';
    } 
    ?>
    <input type="text" name="state" title="state" placeholder="State" />
    <?php if($user_error[12] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[12].'</div>';
    } 
    ?>
    <input type="number" name="pin" title="pin" placeholder="Pin Code" />
    <input type="number" name="contact_no" title="contact_no" placeholder="Primary Mobile Number" required />
    <input type="number" name="a_contact_no" title="a_contact_no" placeholder="Alternate Mobile Number" />
    <button type="submit" class="btn" name="signup" value="Sign Up">Sign Up</button>
    <a class="forgot" href="index.php">Already have an account? Login.</a>
  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 

</body>

</html>