<?php

session_start();

if($_SESSION['id'] != ""){
	unset($_SESSION['id']);
	echo "<h1> You have been logged out</h1>";
	echo '<a href="./login.php"> Click here to login again</a>';
}
else{
	echo "<h1> You are not logged in</h1>";
	echo '<a href="./login.php"> Click here to login</a>';
}

?>