<?php
  session_start();  
  $map = array(
    "event_id" => "Event Id",
    "org_id" => "Organisation Id",
    "name" => "Event Name",
    "description" => "Description",
  );
  $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
  if (!$conn) {
      die("Connection failed: " . $conn->connect_error);
  }
 foreach($_POST as $key => $val){
    if (strpos($key, 'b_') === 0) {
    // $key starts with item_name....
      $all = mysqli_query($conn,"SELECT * FROM Online_event");
      if(mysqli_num_rows($all)!=0){
        $matches = false;
        while($row = mysqli_fetch_array($all)){
          $toMatch = 'b_'.$row['event_id'];
          if($toMatch===$key)  {
            $_SESSION['event_id'] = $row['event_id'];
            header('Location: ../donate.php');
          }
        }
      }
    }
  }
  $filter = "Select";
  $result = mysqli_query($conn,"SELECT * FROM Online_event"); 
  if(isset($_POST['submit'])){
    if(!empty($_POST['search'])){
      $temp = $_POST['search'];
      $filter = $_POST['filter'];
      $result = mysqli_query($conn,"SELECT * FROM Online_event WHERE $filter LIKE '%$temp%'"); 
    }
  }
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Simple Login Form Template</title>
  <!-- <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="main.css"> -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="main.css">
</head>

<body>
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">  
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
 
  <div class="container">
  <form action="online_events.php" method="POST"> 
    <div class="page-header"><h2> Online Events </h2></div>
  <div class="row">
    <div class="col-xs-6 col-md-4">
      <div class="input-group">
   <input type="text" class="form-control" name="search" placeholder="Search" id="txtSearch"/>
   <div class="input-group-btn">
        <button class="btn btn-primary" name="submit" type="submit">
        <span class="glyphicon glyphicon-search"></span>
        </button>
   </div>
   </div>
    </div> 
          <select value="" name="filter">
          <?php
            $offline = mysqli_query($conn,"DESC Online_event");
            while($off=mysqli_fetch_array($offline)){
              // echo "<option value=\"".$off['Field']."\">".$off['Field']."</option>";
             if($off['Field'] != "time_stamp" && $off['Field'] != "amount_to_raise" && $off['Field'] != "amount_raised" && $off['Field'] != "bank_account" && $off['Field'] != "bank_IFSC" && $off['Field'] != "start_date" && $off['Field'] != "end_date" )
              {
              echo "<option value=\"".$off['Field']."\">".$map[$off['Field']]."</option>";
              } 
            }
          ?>
        </select>
</form>
  </div>
  <br>
  <form action="online_events.php" method="POST">
	<?php
	function familyName($result) {
		while($res=mysqli_fetch_array($result)){
			echo "<div class=\"row row-striped\">
      				<div class=\"col-2 text-right\">
        				<h2 class=\"display-4\"><span class=\"badge badge-secondary\"> Target : ".$res['amount_to_raise']."</span></h2>
        				<h2> Amount Raised : ".$res['amount_raised']."</h2>
      				</div>
      				<div class=\"col-10\">
        				<h3 class=\"text-uppercase\"><strong>".$res['name']."</strong></h3>
                <button type=\"submit\" class=\"btn\" name=\"b_".$res['event_id']."\" value=\"Org-Login\" style=\"display: inline-block; float: right;font-size:0.9em;\">Donate Now</button>                  
        				<ul class=\"list-inline\">
            			<li class=\"list-inline-item\"><i class=\"fa fa-calendar-o\" aria-hidden=\"true\"></i> ".$res['start_date']." to</li>
          				<li class=\"list-inline-item\"><i class=\"fa fa-calendar-o\" aria-hidden=\"true\"></i> ".$res['end_date']."</li>
        				</ul>
        				<p>".$res['description']."</p>
      				</div>
    			</div>";
		}
	    
	}

	familyName($result);
	?>
</form>
  </div>
  
</body>

</html>
  