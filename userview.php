<?php

session_start();

if($_SESSION['id'] != "")
	$id = $_SESSION['id'];
else
	header("location: logout.php");

$file = fopen("record.txt", "r");

?>




<html>
<head>
	<title> User List </title>
</head>

<body>
	<table border="1" cellspacing="0">
		<tr> <td  colspan="4">  <center> Users </center> </td> </tr>
		<tr> <td> <p> ID </p> </td> <td> <p> Name </p> </td> <td> <p> Email </p> </td> <td> <p> User Type </p> </td> </tr>
		
<?php	

		while(!feof($file)){
			$line = fgets($file);
			$records = explode("\n", $line);
		
			foreach($records as $item){
				$data = explode(":", $item);
				if($data[0] != ""){
					echo "<tr> <td> <p> $data[0] </p> </td> <td> <p> $data[2] </p> </td> <td> <p> $data[3] </p> </td> <td> <p> $data[4] </p> </td> </tr>";
				}
			}	
		}
?>
		<tr> <td  colspan="4"> <a href="./adminhomepage.php"> Go Home </a> </td> </tr>
	
	</table>