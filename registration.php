<html>
<head>
	<title>
		User Registration page
	</title>
</head>

<body>
	<form method="post">
	<fieldset>
		<legend>Registration</legend>
		Id: 
		<br/>
		<input type="text" name="idfield"/>
		<br/>
	
		Password: 
		<br/>
		<input type="password" name="passfield"/>
		<br/>
		
		Confirm Password: 
		<br/>
		<input type="password" name="confpassfield"/>
		<br/>
		
		Name:
		<br/>
		<input type="text" name="namefield"/>
		<br/>
		
		Email:
		<br/>
		<input type="text" name="emailfield"/>
		<br/>
		
		User Type [User/Admin]
		<br/>
		<select name="usertype">
			<option>User</option>
			<option>Admin</option>
		</select>
		
		<hr/>
		
		<input type="submit" value="Register"/>
		<a href="./login.php"> Login </a>
	
	</fieldset>
	</form>
	


</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
	
	$id = trim($_REQUEST['idfield']);
	$password = trim($_REQUEST['passfield']);
	$confirmpass = trim($_REQUEST['confpassfield']);
	$name = trim($_REQUEST['namefield']);
	$email = trim($_REQUEST['emailfield']);
	$usertype = $_REQUEST['usertype'];
	
	//set flags
	
	$idcorrect = false;
	$passcorrect = false;
	$namecorrect = false;
	$emailcorrect = false;
	$usertypecorrect = false;
	
	//Check Duplicate User
	if($file = fopen("record.txt", "r")){
		while(!feof($file)){
			$line = fgets($file);
			$records = explode("\n", $line);		
		
		
			foreach($records as $item){
				$data = explode(":", $item);
				if($id == $data[0]){
					echo "Error: User already exists.";
				}
				
				//If no duplicate user, proceed registration as usual
				else {				
					fclose($file);
					if($file = fopen("./record.txt","a")){
	
						// writeID
						$parts = explode("-", $id);
						$digits = str_split($id);
						$iflag = true;
						
						foreach ($digits as $item){
							if(!(($item >= '0' && $item <= '9') || $item == '-')){
								$iflag = false;
								break;
							}
						}
							
						if($id==""){
							echo "ID cannot be empty";
						}
						
						else if (count($parts) != 3){
							echo "ID format error";
						}
						
						else if ($iflag == false){
							echo "Characters other than 0-9 and - are not allowed";
						}
						
						else{
							$idcorrect = true;
						}
						
						//writeID end
						
						//writePass
						
						if($password == $confirmpass){
							$passcorrect = true;
						}
						
						else{
							echo "Passwords doesn't match\n";
						}
						
						
						//writePass end
						
						
						// writeName
						$words = explode(" ", $name);
						$chars = str_split($name);
						$flag1 = true;
						$flag2 = true;
						
						
						foreach ($chars as $item){
							if(!(($item >= 'a' && $item <= 'z') || ($item >= 'A' && $item <= 'Z') || $item == '.' || $item == '-' || $item == ' ')) {
								$flag1 = false;
								break;
							}
						}
						
						if(!(($chars[0] >= 'a' && $chars[0] <= 'z') || ($chars[0] >= 'A' && $chars[0] <= 'Z'))){
							$flag2 = false;
						}
						
						
						if($name==""){
							echo "Name can not be empty";
						}
						
						else if($flag1 == false){
							echo "Name should contain only a-z, A-Z, dot, dash.";
						}
						
						else if($flag2 == false){
							echo "Name should start with a letter.";
						}
						
						else{
							$namecorrect = true;
						}
						//showName ends here.
						
						echo "<br/>";
						
						//showEmail starts here
						$partemail = explode("@", $email);
						$partdomain = explode(".", $partemail[1]);
					
						if ($email == ""){
							echo "Email Address cannot be empty";
						}
						else if (count($partemail) != 2 || $partemail[0] == ""){
							echo "Invalid Email.";
						}
						else if (count($partdomain) != 2 || $partdomain[0] == ""){
							echo "Invalid Host.";
						}
						else if ($partdomain[1] == ""){
							echo "Invalid Domain.";
						}
						else {
							$emailcorrect = true;
						}
					
						//showEmail ends here
						
						echo "<br/>";
						
						//writeUserType
						
						if(!$usertype == ""){
							$usertypecorrect = true;
						}
						
						//writeUserType end
						
						//writeValuestoFile
						
						if($idcorrect == true && $passcorrect == true && $namecorrect == true && $emailcorrect == true && $usertypecorrect == true){
							if(fwrite($file, $id . ":" . $password . ":" . $name . ":" . $email . ":" . $usertype . "\n"))
								echo "Registration Completed Successfully. Go to Log In page to log in";
							else
								echo "Registration failed. Please try again.";
						}
					}
					else
						echo "Error opening the record file.";
				}
			}
		}
	}
	else
		echo "Error: Record file doesn't Exist";
}	
?>

