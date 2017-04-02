<?php 

session_start();

if($_SESSION['id'] != "")
	$id = $_SESSION['id'];
else
	header("location: logout.php");

if($file = fopen("record.txt", "r")){
	while(!feof($file)){
		$line = fgets($file);
		$records = explode("\n", $line);		
		
		
		foreach($records as $item){
			$data = explode(":", $item);
			if($data[0] == $id){
				if($data[4] == "User")
					$name = $data[2];
				else if ($data[4] == "Admin")
					header("location: adminhomepage.php");
			}
		}
	}
}
else {
	echo "Error: Failed to read login record file.";
	header("location: login.php");
}

?>


<html>
	<head>
		<title> User's Homepage </title>
	</head>
	
	<body>
		<fieldset>
			<center> <h1> <b> Welcome, <?php echo $name;?>! </b> </h1> </center>
			<br/>
			<center> <a href="./profile.php"> Profile </a> </center>
			<center> <a href="./passchange.php"> Change Password </a> </center>
			<center> <a href="./logout.php"> Logout </a> </center>
		</fieldset>
	</body>
</html>