<?php
session_start();

  $username = '';
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    }
    $username = $_SESSION['id'];
    $result = mysqli_query($conn,"SELECT * FROM User WHERE user_id = '$username'");
    while($row = mysqli_fetch_array($result)){
          $username = $row['name'];
        }
  }
  else
  {
    header('Location: ../index.php');
  }
  // else if(isset($_POST['login'])&&isset($_POST['username'])&&isset($_POST['password'])){
  //   $conn = mysqli_connect("localhost", "root", "demosql", "chairity");
  //   if (!$conn) {
  //       die("Connection failed: " . $conn->connect_error);
  //   } 
  //   $username = $_POST['username'];
  //   $result = mysqli_query($conn,"SELECT * FROM User WHERE user_id = '$username'");
  //   if (mysqli_num_rows($result) == 1){
  //     while($row = mysqli_fetch_array($result)){
  //       if($row['pass'] == $_POST['password']){        
  //         $_SESSION['loggedin']=true;
  //         header('Location: Profile/profile.php');
  //       }
  //     } 
  //   } 
  // }
  // else{
  //   $_SESSION['loggedin'] = false;
  // }
?>




<!DOCTYPE html>
<!--
Template Name: Geodarn
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html>
<head>
<title>Chairity</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}
</style>
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url('images/demo/backgrounds/background.jpg');"> 
  <!-- ################################################################################################ -->
  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <div id="logo" class="fl_left">
        <h1><a href="profile.php">Chairity</a></h1>
      </div>
      <div id="search" class="fl_right">
          <a href="../Events/offline_events.php"><button type="submit" class="btn" name="search_offline" title="search_offline">Search Offline</button></a>
          <a href="../Events/online_events.php"><button type="submit" class="btn" name="search_online" title="search_online">Search Online</button></a>
      </div>
      <!--</div>
      <nav id="mainav" class="fl_right">
        <ul class="clear">
          <li class="active"><a href="index.html">Home</a></li>
          <li><a class="drop" href="#">Pages</a>
            <ul>
              <li><a href="pages/gallery.html">Gallery</a></li>
              <li><a href="pages/full-width.html">Full Width</a></li>
              <li><a href="pages/sidebar-left.html">Sidebar Left</a></li>
              <li><a href="pages/sidebar-right.html">Sidebar Right</a></li>
              <li><a href="pages/basic-grid.html">Basic Grid</a></li>
            </ul>
          </li>
          <li><a class="drop" href="#">Dropdown</a>
            <ul>
              <li><a href="#">Level 2</a></li>
              <li><a class="drop" href="#">Level 2 + Drop</a>
                <ul>
                  <li><a href="#">Level 3</a></li>
                  <li><a href="#">Level 3</a></li>
                  <li><a href="#">Level 3</a></li>
                </ul>
              </li>
              <li><a href="#">Level 2</a></li>
            </ul>
          </li>
          <li><a href="#">Link Text</a></li>
          <li><a href="#">Link Text</a></li>
        </ul>
      </nav>-->
      <!-- ################################################################################################ -->
    </header>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div id="pageintro" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="flexslider basicslider">
      <ul class="slides">
        <li>
          <article>
            <p>Chairity</p>
            <h3 class="heading">Hi <?php echo $username; ?></h3>
            <p>Let's grow together!</p>
            <!--<footer><a class="btn" href="#">Venenatis curabitur</a></footer>-->
          </article>
        </li>
        <!--<li>
          <article>
            <p>Scelerisque</p>
            <h3 class="heading">Dolor rhoncus nullam</h3>
            <p>Augue non id quam sit amet urna lobortis</p>
            <footer><a class="btn inverse" href="#">Interdum lectus</a></footer>
          </article>
        </li>
        <li>
          <article>
            <p>Vestibulum</p>
            <h3 class="heading">Justo erat venenatis</h3>
            <p>Tempor sit amet ac nibh nullam mattis</p>
            <footer><a class="btn" href="#">Bibendum magna</a></footer>
          </article>
        </li>
      </ul>
    </div>-->
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="btmspace-80 center">
      <h3 class="nospace">Categories we tend to</h3>
      <p class="nospace">Browse through the events for each category and donate accordingly.</p>
    </div>
    <ul class="nospace group services">
      <li class="one_third first active">
        <article class="bgded overlay" style="background-image:url('images/demo/healthcare.jpg');">
          <div class="txtwrap">
            <h6 class="heading">Healthcare</h6>
            <p>Ambulance</p>
          </div>
          <footer><a href="#">See Events &raquo;</a></footer>
        </article>
      </li>
      <li class="one_third active">
        <article class="bgded overlay" style="background-image:url('images/demo/childcare.jpg');">
          <div class="txtwrap">
            <h6 class="heading">Child Care</h6>
            <p>Orphanage</p>
          </div>
          <footer><a href="#">See Events &raquo;</a></footer>
        </article>
      </li>
      <li class="one_third active">
        <article class="bgded overlay" style="background-image:url('images/demo/army.jgp');">
          <div class="txtwrap">
            <h6 class="heading">Army Support</h6>
            <p>He doesn't know you</p>
          </div>
          <footer><a href="#">See Events &raquo;</a></footer>
        </article>
      </li>
      <li class="one_third first active">
        <article class="bgded overlay" style="background-image:url('images/demo/cancer.jpg');">
          <div class="txtwrap">
            <h6 class="heading">Cancer Treatment</h6>
            <p>Don't lose hope. <br> When the sun goes down, the stars come out.</p>
          </div>
          <footer><a href="#">See Events &raquo;</a></footer>
        </article>
      </li>
      <li class="one_third active">
        <article class="bgded overlay" style="background-image:url('images/demo/swach.jpg');">
          <div class="txtwrap">
            <h6 class="heading">Disaster Relief</h6>
            <p>We can't stop natural disasters but we can arm ouselves with resources.</p>
          </div>
          <footer><a href="#">See Events &raquo;</a></footer>
        </article>
      </li>
      <li class="one_third active">
        <article class="bgded overlay" style="background-image:url('images/demo/refugee.jpg');">
          <div class="txtwrap">
            <h6 class="heading">Refugees</h6>
            <p>To save a life is to save all of humanity<br><br></p>
          </div>
          <footer><a href="#">See Events &raquo;</a></footer>
        </article>
      </li>
    </ul>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!--<div class="wrapper">
  <article id="shout" class="hoc container clear">
     ################################################################################################     
     <div class="three_quarter first">
      <h2 class="heading btmspace-10">Magna lacus mattis in ipsum tincidunt</h2>
      <p class="nospace">Porta erat cras vitae maximus purus suspendisse blandit nec justo mollis etiam vitae.</p>
    </div>
    <footer class="one_quarter"><a class="btn" href="#">Accumsan metus</a></footer>
    ################################################################################################ 
  </article>
</div>-->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!--<div class="wrapper row3">
  <section class="hoc container clear"> 
     ################################################################################################ 
    <div class="btmspace-80 center">
      <h3 class="nospace">Gravida nulla aliquam</h3>
      <p class="nospace">Erat volutpat integer vestibulum purus et sagittis rhoncus.</p>
    </div>
    <div class="group">
      <div class="one_third first">
        <h6 class="nospace font-x1">Elit vel porttitor</h6>
        <p>Ex suspendisse vestibulum turpis luctus pretium posuere vestibulum feugiat non metus quis vitae&hellip;</p>
        <footer><a class="btn" href="#">Read More</a></footer>
      </div>
      <article class="one_third"><a href="#"><img class="btmspace-30" src="images/demo/320x210.png" alt=""></a>
        <h6 class="nospace font-x1">Sapien porttitor ut</h6>
        <p>Dignissim praesent consectetur nec tellus ut rutrum nam laoreet finibus mattis integer ullamcorper arcu&hellip;</p>
      </article>
      <article class="one_third"><a href="#"><img class="btmspace-30" src="images/demo/320x210.png" alt=""></a>
        <h6 class="nospace font-x1">Praesent sed blandit</h6>
        <p>Pellentesque vehicula dictum ligula tellus convallis nisl vel scelerisque quam ligula a mauris quisque&hellip;</p>
      </article>
    </div>
     ################################################################################################ 
  </section>
</div>-->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!--<div class="wrapper row4 bgded overlay" style="background-image:url('images/demo/backgrounds/02.png');">
  <footer id="footer" class="hoc clear"> 
     ################################################################################################ 
    <div class="one_third first">
      <h3 class="heading">Geodarn</h3>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
      </ul>
    </div>
    <div class="one_third">
      <ul class="nospace meta">
        <li class="btmspace-15"><i class="fa fa-phone"></i> +00 (123) 456 7890</li>
        <li><i class="fa fa-envelope-o"></i> info@domain.com</li>
      </ul>
    </div>
    <div class="one_third">
      <form method="post" action="#">
        <fieldset>
          <legend>Newsletter:</legend>
          <div class="clear">
            <input type="text" value="" placeholder="Type Email Here&hellip;">
            <button class="fa fa-share" type="submit" title="Submit"><em>Submit</em></button>
          </div>
        </fieldset>
      </form>
    </div>
     ################################################################################################ 
  </footer>
</div>-->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!--<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> -->
    <!-- ################################################################################################ -->
    <!--<p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
     ################################################################################################ -->
  <!--</div>
</div>-->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!--<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>-->
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/jquery.flexslider-min.js"></script>
</body>
</html>
