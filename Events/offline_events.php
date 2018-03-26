<?php
session_start();
  $map = array(
    "event_id" => "Event Id",
    "org_id" => "Organisation Id",
    "name" => "Event Name",
    "description" => "Description",
    "address_house_no" => "House No",
    "address_street_name" => "Street Name",
    "address_city" => "City",
    "address_state" => "State",
  );

  $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
  if (!$conn) {
      die("Connection failed: " . $conn->connect_error);
  }
  $filter = "Select";
  $result = mysqli_query($conn,"SELECT * FROM Offline_event"); 
  if(isset($_POST['submit'])){
    if(!empty($_POST['search'])){
      $temp = $_POST['search'];
      $filter = $_POST['filter'];
      $result = mysqli_query($conn,"SELECT * FROM Offline_event WHERE $filter LIKE '%$temp%'"); 
    }
  }
  foreach($_POST as $key => $val){
    if (strpos($key, 'b_') === 0) {
    // $key starts with item_name....
      $all = mysqli_query($conn,"SELECT * FROM Offline_event");
      if(mysqli_num_rows($all)!=0){
        $matches = false;
        while($row = mysqli_fetch_array($all)){
          $toMatch = 'b_'.$row['event_id'];
          if($toMatch===$key)  {
            $u = $_SESSION['id'];
            $e = $row['event_id'];
            $temp = $u;
            $time_stamp = date('Y-m-d G:i:s');
            $res = mysqli_query($conn,"INSERT into User_offline values('$u','$e','$time_stamp')");
            $res = mysqli_query($conn,"UPDATE Offline_event SET users_registered = users_registered + 1 WHERE event_id = '$e'");            
          }
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Simple Login Form Template</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="toggle.css">
</head>

<body>
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">  
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

 
  <div class="container">
  <form action="offline_events.php" method="POST"> 
        <div class="page-header"><h2> Offline Events </h2></div>
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
            $offline = mysqli_query($conn,"DESC Offline_event");
            while($off=mysqli_fetch_array($offline)){
            if($off['Field'] != "time_stamp" && $off['Field'] != "duration" && $off['Field'] != "amount_spent" && $off['Field'] != "address_pin" && $off['Field'] != "max_users" && $off['Field'] != "users_registered" && $off['Field'] != "start_date" && $off['Field'] != "end_date" && $off['Field'] != "start_time" )
              {
              echo "<option value=\"".$off['Field']."\">".$map[$off['Field']]."</option>";
              }
            }
          ?>
        </select>
      </form>
</div>

    <br>

  <form action="offline_events.php" method="POST">
  <?php
  $user = $_SESSION['id'];

  function familyName($result,$user,$conn) {
    while($res=mysqli_fetch_array($result)){
      $set = false;
      $useroff_temp = mysqli_query($conn,"SELECT * FROM User_offline WHERE user_id = '$user'");;
			if(mysqli_num_rows($useroff_temp)!=0){
        while ($userOff=mysqli_fetch_array($useroff_temp)) {
          if($userOff['event_id']==$res['event_id']){
            $set = true;
          }
        }
      }
      echo "<div class=\"row row-striped\">
      				<div class=\"col-2 text-right\">
        				<h2 class=\"display-4\"><span class=\"badge badge-secondary\"> Target : ".$res['max_users']."</span></h2>
        				<h2> Users Registered : ".$res['users_registered']."</h2>
      				</div>
      				<div class=\"col-10\">
        				<h3 class=\"text-uppercase\"><strong>".$res['name']."</strong></h3>
                  <div style=\"float:right;\">";
      if($set){
        echo "<h4>Already Registered</h4>";
      }    
      else{
          echo "<button type=\"submit\" class=\"btn\" name=\"b_".$res['event_id']."\" value=\"register\" style=\"display: inline-block; float: right;font-size:0.9em;\">Register</button>";
      }
      echo    "</div>
        				<ul class=\"list-inline\">
            			<li class=\"list-inline-item\"><i class=\"fa fa-calendar-o\" aria-hidden=\"true\"></i> ".$res['start_date']." to</li>
                  <li class=\"list-inline-item\"><i class=\"fa fa-calendar-o\" aria-hidden=\"true\"></i> ".$res['end_date']."</li>
                  <li class=\"list-inline-item\"><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> Starts at ".$res['start_time']."</li> 
          				<li class=\"list-inline-item\"><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> Duration - ".$res['duration']." hrs</li>
                  <br>
                  <li class=\"list-inline-item\"><i class=\"fa fa-location-arrow\" aria-hidden=\"true\"></i> ".$res['address_house_no']." ".$res['address_street_name']." ".$res['address_city']." ".$res['address_state']."</li>
        				</ul>
        				<p>".$res['description']."</p>
      				</div>
    			</div>";
		}
	    
	}

	familyName($result,$user,$conn);
	?>
</form>
  </div>
  
</body>

</html>
  .