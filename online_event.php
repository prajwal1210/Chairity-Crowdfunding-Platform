<?php
	session_start();
	$user_error = array('','','','','','','');
	$flag = 0;
	$q1 = 0;
	$q2 = 0;
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
	{
	if(isset($_POST['create'])){
		$conn = mysqli_connect("localhost","root","demosql","chairity");
		if(!$conn)
		{
			die("Connection failed: ".$conn->connect_error);
		}
		$i = 0;
		foreach ($_POST as $param_name => $param_val)
		{
			if(empty($_POST[$param_name]))
			{
				$user_error[$i]='This is a required field';
				$flag = 1;
			}
			$i=$i+1;
		}
		if($flag == 0)
		{
			$event_id = 'ON0';
			$org_id = $_SESSION['id'];
			$name = $_POST['name'];
			$time_stamp = date('Y-m-d G:i:s');
			$description = $_POST['description'];
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$amount_to_raise = $_POST['amount_to_raise'];
			$amount_raised = 0;
			$bank_account = $_POST['bank_account'];
			$bank_IFSC = $_POST['bank_IFSC'];

			$result = mysqli_query($conn,"SELECT * FROM Online_event");
			if(empty($result)){
				$q1=1;
			}
			if(mysqli_num_rows($result)==0)
			{
				$res = mysqli_query($conn, "INSERT INTO Online_event values('$event_id','$org_id','$name','$time_stamp','$description','$start_date','$end_date',$amount_to_raise,$amount_raised,$bank_account,'$bank_IFSC')");
				if(empty($res))
				{
					$q2 = 1;
				}
				//header("Location: logout.php");

			}
			else if(mysqli_num_rows($result) != 0){
	        $temp = mysqli_num_rows($result);
	        $event_id = 'ON' + '$temp';
	        $res = mysqli_query($conn, "INSERT INTO Online_event values('$event_id','$org_id','$name','$time_stamp','$description','$start_date','$end_date','$amount_to_raise','$amount_raised','$bank_account','$bank_IFSC')");
	        //header("Location: logout.php"); 
	      	}		
      	} 
	  	
	}
	}

  else{
    $_SESSION['loggedin'] = false;
    header("Location: index.php");
  }	
?>

<!DOCTYPE html>
<html lang = 'en' >
	
	<head>
		  <meta charset="UTF-8">
		  <title>Online event creation</title>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascrip"></script>
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		  <link rel="stylesheet" href="css/style.css">			
	</head>

<body>

  <div class="log-form" style="overflow:scroll; height:600px; width: 500px; padding:2em;">
  <h2>Create an Online event</h2>
  <br>
  <form method="post" action="online_event.php">
    <br>
    <?php if($user_error[0] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[0].'</div>';
    } 
    ?>
    <input type="text" name="name" title="name" data-validate = "Event name is required" placeholder="Event Name" />
    
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
    <input type="date" name="end_date" title="end_date" placeholder="End Date" />
    
    <?php if($user_error[4] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[4].'</div>';
    } 
    ?>
    <input type="number" name="amount_to_raise" title="amount_to_raise" placeholder="Amount to be raised(In numbers)" />

    <?php if($user_error[5] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[5].'</div>';
    } 
    ?>
    <input type="number" name="bank_account" title="bank_account" placeholder="Bank account number" />
    	
    <?php if($user_error[6] != ''){
      echo '<div class="alert alert-danger"><strong>Warning!</strong> '.$user_error[6].'</div>';
    } 
    ?>
    <input type="text" name="bank_IFSC" title="bank_IFSC" placeholder="IFSC Code of bank" />
    



    <button type="submit" class="btn" name="create" value="Sign Up">Create</button>

  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 

</body>	
</html>