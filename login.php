<html>
<head>
	<title> Log In </title>
</head>

<body>
	<form method="post">
	<fieldset>
		<legend> Log In </legend>
		User Id: 
		<br/>
		<input type="text" name="idfield"/>
		<br/>
		
		Password:
		<br/>
		<input type="password" name="passfield"/>
		<br/>
			
		<input type="checkbox" name="remembercheck"/> Remember Me
		<br/>
		<hr/>	
		
		<input type="submit" name="login"/>
		<a href="./registration.php"> Register </a>
		
	</fieldset>
	</form>

</body>
</html>

<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
	
	session_start();
	
	$id = trim($_REQUEST['idfield']);
	$pass = trim($_REQUEST['passfield']);
	
	$file = fopen("record.txt", "r");
	
	while(!feof($file)){
		$line = fgets($file);
		$records = explode("\n", $line);		
		
		
		foreach($records as $item){
			$data = explode(":", $item);
			if($id == $data[0] && $pass == $data[1]){
				
				if($data[4] == "Admin"){
					$_SESSION['id'] = $data[0];
					header("location: adminhomepage.php");
				}
				else if ($data[4] == "User"){
					$_SESSION['id'] = $data[0];
					header("location: userhomepage.php");
				}
			}
		}
	}
	
	echo "Invalid Username/password.";

}