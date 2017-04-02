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
				$name = $data[2];
				$email = $data[3];
				$usertype = $data[4];
				
				if($usertype == "Admin"){
					$homepage = "./adminhomepage.php";
				}
				else if($usertype == "User"){
					$homepage = "./userhomepage.php";
				}
			}
		}
		
	}
}
else
	header("location: logout.php");



?>

<html>
<head>
	<title> User Profile </title>
</head>

<body>
	<table border="1" cellspacing="0">
		<tr> <td  colspan="2">  <center> Profile </center> </td> </tr>
		<tr> <td> <p> ID </p> </td> <td> <p> <?php echo $id;?> </p> </td> </tr>
		<tr> <td> <p> Name </p> </td> <td> <p> <?php echo $name;?> </p> </td> </tr>
		<tr> <td> <p> Email </p> </td> <td> <p> <?php echo $email;?> </p> </td> </tr>
		<tr> <td> <p> User Type </p> </td> <td> <p> <?php echo $usertype;?> </p> </td> </tr>
		<tr> <td  colspan="2"> <a href="<?php echo $homepage;?>"> Go Home </a> </td> </tr>
	
	</table>
</body>	
</html>