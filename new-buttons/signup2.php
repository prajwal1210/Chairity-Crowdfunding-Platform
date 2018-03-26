<?php
session_start();

  $user_error = array('','','','','','','','','','','','','','','','','');
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
      if(empty($_POST[$param_name]) && ($param_name != 'Cat1' && $param_name != 'Cat2' && $param_name != 'ph2')){
          $user_error[$i] = 'This is a required field';
          $flag = 1;
      }
      $i = $i + 1;
    }
    if($flag == 0)
    {
      $username = $_POST['organization_id'];
      $password = $_POST['password'];
      $repassword = $_POST['repassword'];
      $name = $_POST['org_name'];
      $registration_no = $_POST['reg_no'];
      $bill_house_no = $_POST['bill_house_no'];
      $bill_street = $_POST['bill_street'];
      $bill_city = $_POST['bill_city'];
      $bill_state = $_POST['bill_state'];
      $bill_pin = $_POST['bill_pin'];

      $ho_house_no = $_POST['ho_house_no'];
      $ho_street = $_POST['ho_street'];
      $ho_city = $_POST['ho_city'];
      $ho_state = $_POST['ho_state'];
      $ho_pin = $_POST['ho_pin'];

      $cat1 = $_POST['Cat1'];
      $cat2 = $_POST['Cat2'];

      $ph1 = $_POST['ph1'];
      $ph2 = $_POST['ph2'];
      //$cat3 = $_POST['Cat1'];

      $email = $_POST['email'];
      $description = $_POST['descr'];
      $result = mysqli_query($conn,"SELECT * FROM Organization WHERE org_id = '$username'");
      if (mysqli_num_rows($result) == 0 && $password == $repassword){
        $res = mysqli_query($conn,"INSERT INTO Organization values('$username','$password','$name',$registration_no,'$bill_house_no','$bill_street','$bill_city','$bill_state',$bill_pin,'$description','$email','$ho_house_no','$ho_street','$ho_city','$ho_state',$ho_pin)");
        if($cat1 != '')
          $res = mysqli_query($conn,"INSERT INTO Organization_category values('$username','$cat1')");
        if($cat2 != '')
          $res = mysqli_query($conn,"INSERT INTO Organization_category values('$username','$cat2')");
        $res = mysqli_query($conn,"INSERT INTO Organization_contact_no values('$username',$ph1)");
        if(!empty($ph2))
          $res = mysqli_query($conn,"INSERT INTO Organization_contact_no values('$username',$ph2)");

        header("Location: logout.php");
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

  <div class="log-form" style="overflow-y:scroll; height:600px; width: 500px; padding:0em;">

  <h2 style="border-radius: 0px 0px 0px 0px">Create an account</h2>
  <br/>

  <form method="post" action="signup2.php">
    <br/>
    
    <?php if($user_error[0] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[0].'</div>';
    } 
    ?>
    <input type="text" name="organization_id" title="organization_id" data-validate = "Id is required" placeholder="Organization Name" /> 
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
    <input type="text" name="org_name" title="org_name" placeholder="Name" />
    <?php if($user_error[4] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[4].'</div>';
    } 
    ?>
    <input type="number" name="reg_no" title="reg_no" placeholder="Registration Number" />
    <p>Billing Address: </p>
    <?php if($user_error[5] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[5].'</div>';
    } 
    ?>
    <input type="text" name="bill_house_no" title="bill_house_no" placeholder="House No." />
    <?php if($user_error[6] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[6].'</div>';
    } 
    ?>
    <input type="text" name="bill_street" title="bill_street" placeholder="Street" />
    <?php if($user_error[7] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[7].'</div>';
    } 
    ?>  
    <input type="text" name="bill_city" title="bill_city" placeholder="City Name" />
    <?php if($user_error[8] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[8].'</div>';
    } 
    ?>
    <input type="text" name="bill_state" title="bill_state" placeholder="State" />
    <?php if($user_error[9] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[9].'</div>';
    } 
    ?>
    <input type="number" name="bill_pin" title="bill_pin" placeholder="Pin Code" />
    <p>Head Office Address: </p>
    <?php if($user_error[10] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[10].'</div>';
    } 
    ?>
    <input type="text" name="ho_house_no" title="ho_house_no" placeholder="House No." />
    <?php if($user_error[11] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[11].'</div>';
    } 
    ?>
    <input type="text" name="ho_street" title="ho_street" placeholder="Street" />
    <?php if($user_error[12] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[12].'</div>';
    } 
    ?>
    <input type="text" name="ho_city" title="ho_city" placeholder="City Name" />
    <?php if($user_error[13] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[13].'</div>';
    } 
    ?>
    <input type="text" name="ho_state" title="ho_state" placeholder="State" />
    <?php if($user_error[14] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[14].'</div>';
    } 
    ?> 
    <input type="number" name="ho_pin" title="ho_pin" placeholder="Pin Code" />
    <?php if($user_error[15] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[15].'</div>';
    } 
    ?>
    <input type="email" name="email" title="email" placeholder="Email" />
    <?php if($user_error[16] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[16].'</div>';
    } 
    ?>
    <input type="paragraph" name="descr" title="descr" placeholder="Description" />
    
    <p> Categories </p>
    <div class = "dropdown">
    <select class = "form-control" name='Cat1' required>
      <option value="">None</option>
      <option value="Healthcare">Healthcare</option>
      <option value="Child Support">Child Support</option>
      <option value="Army Support">Army Support</option>
      <option value="Cancer Treatment">Cancer Treatment</option>
      <option value="Refugees">Refugees</option>
      <option value="Disaster Relief">Disaster Relief</option>
    </select>
  </div>
    <br>
    <div class = "dropdown">
    <select class = "form-control" name='Cat2'>
      <option value="">None</option>
      <option value="Healthcare">Healthcare</option>
      <option value="Child Support">Child Support</option>
      <option value="Army Support">Army Support</option>
      <option value="Cancer Treatment">Cancer Treatment</option>
      <option value="Refugees">Refugees</option>
      <option value="Disaster Relief">Disaster Relief</option>
    </select>
  </div>
    <br>
    <p> Contact numbers (10 DIGIT ONLY) </p>
    <input required type="number" name="ph1" title="ph1" placeholder="Phone number" />
    <input type="number" name="ph2" title="ph2" placeholder="Alternate Phone number" />
    <button type="submit" class="btn" name="signup" value="Sign Up">Sign Up</button>
    
    <a class="forgot" href="index.php">Already have an account? Login.</a>
  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 

</body>

</html>