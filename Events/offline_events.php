<?php
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
              echo "<option value=\"".$off['Field']."\">".$off['Field']."</option>";
            }
          ?>
        </select>
      </form>
</div>

    <br>

	
	<?php
	function familyName($result) {
		while($res=mysqli_fetch_array($result)){
			echo "<div class=\"row row-striped\">
      				<div class=\"col-2 text-right\">
        				<h2 class=\"display-4\"><span class=\"badge badge-secondary\"> Target : ".$res['max_users']."</span></h2>
        				<h2> Amount Raised : ".$res['users_registered']."</h2>
      				</div>
      				<div class=\"col-10\">
        				<h3 class=\"text-uppercase\"><strong>".$res['name']."</strong></h3>
        				<ul class=\"list-inline\">
            			<li class=\"list-inline-item\"><i class=\"fa fa-calendar-o\" aria-hidden=\"true\"></i> Monday</li>
          				<li class=\"list-inline-item\"><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> 12:30 PM - 2:00 PM</li>
          				<li class=\"list-inline-item\"><i class=\"fa fa-location-arrow\" aria-hidden=\"true\"></i> Cafe</li>
        				</ul>
        				<p>".$res['description']."</p>
      				</div>
    			</div>";
		}
	    
	}

	familyName($result);
	?>
  </div>
  
</body>

</html>
  