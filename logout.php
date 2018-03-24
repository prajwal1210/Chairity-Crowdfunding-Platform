<!DOCTYPE html>

<?php
session_start();
	if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==false){
		header('Location: index.php');
	}
	if(isset($_POST['logout'])){
		$_SESSION['loggedin'] = false;
		session_destroy();
		header('Location: index.php');
	}
?>

<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action="logout.php">
<input type="submit" name="logout" value="Logout">
</body>
</html>