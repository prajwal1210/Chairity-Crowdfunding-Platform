<?php
session_start();

  $user_error = array('','','','','','','','','','','','','');
  $flag = 0;
    
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
    header('Location: index.html');
  }
  else if(isset($_POST['create'])){
    $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $i = 0;
    foreach ($_POST as $param_name => $param_val) {
      if(empty($_POST[$param_name])){
          $user_error[$i] = 'This is a required field';
          $flag = 1;
      }
      $i = $i + 1;
    }
    if($flag == 0)
    {
      $event_id = "OFF0";
      $org_id = $_SESSION['id'];
      $name = $_POST['name'];
      $time_stamp = date('Y-m-d G:i:s');
      $description = $_POST['description'];
      $start_date = $_POST['start_date'];
      $duration = $_POST['duration'];
      $house_no = $_POST['house_no'];
      $street = $_POST['street'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $pin = $_POST['pin'];
      $start_time = $_POST['start_time'];
      $max_users = $_POST['max_users'];
      $user_reg = 0;
      $end_date = $_POST['end_date'];
      $amount_spent = $_POST['amount_spent'];
      
      $result = mysqli_query($conn,"SELECT * FROM Offline_event");
      if (mysqli_num_rows($result) == 0){
        $res = mysqli_query($conn,"INSERT INTO Offline_event values('$event_id','$org_id','$name','$time_stamp','$description','$start_date','$end_date',$duration,$amount_spent,'$house_no','$street','$city','$state',$pin,'$start_time',$max_users,$user_reg)");
  //      header("Location: logout.php");
      } 
      else if(mysqli_num_rows($result) != 0){
        $temp = mysqli_num_rows($result);
        $event_id = 'OFF'.$temp;
        $res = mysqli_query($conn,"INSERT INTO Offline_event values('$event_id','$org_id','$name','$time_stamp','$description','$start_date','$end_date',$duration,$amount_spent,'$house_no','$street','$city','$state',$pin,'$start_time',$max_users,$user_reg)");
 //       header("Location: logout.php"); 
      }
    }
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
  <h2>Create an Offline Event</h2>

  <br>
  <form method="post" action="offline_event.php">
    <br>
    <?php if($user_error[0] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[0].'</div>';
    } 
    ?>
    <input type="text" name="name" title="name" data-validate = "Username is required" placeholder="Event Name" />
    
    <?php if($user_error[1] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[1].'</div>';
    } 
    ?>
    <input type="paragraph" name="description" title="description" placeholder="Description" />
    
    <?php if($user_error[2] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[2].'</div>';
    } 
    ?>
    <input type="date" name="start_date" title="start_date" placeholder="Start Date" />
    
    <?php if($user_error[3] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[3].'</div>';
    } 
    ?>
    <input type="number" name="duration" title="duration" placeholder="Duration of the Event in Hrs" />
    
    <p>Event Address: </p>
    <?php if($user_error[4] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[4].'</div>';
    } 
    ?>
    <input type="text" name="house_no" title="house_no" placeholder="House No." />
    
    <?php if($user_error[5] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[5].'</div>';
    } 
    ?>
    <input type="text" name="street" title="street" placeholder="Street Name" />
    
    <?php if($user_error[6] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[6].'</div>';
    } 
    ?>
    <input type="text" name="city" title="city" placeholder="City" />
    
    <?php if($user_error[7] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[7].'</div>';
    } 
    ?>
    <input type="text" name="state" title="state" placeholder="State" />
    
    <?php if($user_error[8] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[8].'</div>';
    } 
    ?>
    <input type="number" name="pin" title="pin" placeholder="Pin" />
    
    <?php if($user_error[9] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[9].'</div>';
    } 
    ?>
    <input type="date" name="start_time" title="start_time" placeholder="Start Time" />
    
    <?php if($user_error[10] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[10].'</div>';
    } 
    ?>
    <input type="number" name="max_users" title="max_users" placeholder="Maximum Users" />
    <?php if($user_error[11] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[11].'</div>';
    } 
    ?>
    <input type="date" name="end_date" title="end_date" placeholder="End date" />
    <?php if($user_error[12] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[12].'</div>';
    } 
    ?>
    <input type="number" name="amount_spent" title="amount_spent" placeholder="Budget of the event" />
    <button type="submit" class="btn" name="create" value="Sign Up">Create Event</button>
    <a class="forgot" href="index.php">Already have an account? Login.</a>
  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 

</body>

</html>