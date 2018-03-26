<?php
session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
    header('Location: index.php');
  }
  else
  {
    $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
    if(!$conn) {
          die("Connection failed: " . $conn->connect_error);
      }
    $event_id = $_SESSION['event_id']; 
    if(isset($_POST['donate']))
    {
      $user = $_SESSION['id'];
      $am = $_POST['amount'];
      $result = mysqli_query($conn, "SELECT * FROM User_online WHERE user_id = '$user' AND event_id = '$event_id'");
      if(mysqli_num_rows($result) == 0)
      {
        $time_stamp = date('Y-m-d G:i:s');
        $ins = mysqli_query($conn, "INSERT INTO User_online VALUES('$user','$event_id',$am,'$time_stamp')");
        $ins = mysqli_query($conn, "UPDATE Online_event SET amount_raised = amount_raised + $am  WHERE event_id = '$event_id'");
      }
      else 
      {
        $time_stamp = date('Y-m-d G:i:s');
        $upd = mysqli_query($conn, "UPDATE User_online SET amount_donated = amount_donated + $am, time_of_donation = '$time_stamp' WHERE user_id = '$user' AND event_id = '$event_id'"); 
        $upd = mysqli_query($conn, "UPDATE Online_event SET amount_raised = amount_raised + $am  WHERE event_id = '$event_id'");
      }
      unset($_SESSION['event_id']);
      header("Location: Pro/index.php");
    }
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
  <h2>Donate Money</h2>
  <form method="post" action="donate.php">
    <input requried type="number" name="amount" required="required" title="amount" placeholder="Amount" />
    <!-- <a class="forgot" href="signup.php">Don't have an account? Create one.</a> -->
    <button type="submit" class="btn" name="donate" value="Donate" style="display: inline-block; float: left;font-size:0.9em;">Donate</button>
    <br>
    <!-- <a href="index.html" class="btn" style="text-decoration: none">Return to Home</a>  -->
    
  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 

</body>

</html>