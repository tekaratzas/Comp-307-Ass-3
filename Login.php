<?php 

	require 'vendor/autoload.php';    
	$app = new \Slim\Slim();

	$app->post('/', function() use ($app){
		$req = $app->request();
		echo json_encode($req->post());
	});

	//$servername = 'localhost:/Applications/MAMP/Library/bin';
	//$servername = 'localhost';
	$DBuser = 'root';
	$DBpass = 'root';

	/* localhost doesn't work for mac, 
	I am leaving it for the TA to update the port 
	to localhost when marking */
	$link = new mysqli( '127.0.0.1:8889', $DBuser, $DBpass );

	// Check connection
	if ($link->connect_error) {
	    die("Connection failed: " . $link->connect_error);
	} 
	else {
		//if works, then select the DB and tables
		echo "Connected successfully";
		$databaseName = 'Q2DB';
		mysqli_select_db($link,$databaseName);
		$sql = "SELECT * FROM members";
		$result = $link->query($sql);
	}

	if ( $result->num_rows > 0 ){
		while($row = $result->fetch_assoc() ){
			echo "member ID: " .$row["member_ID"]. "shared_key: " .$row["shared_key"]. "username: " .$row["username"]. "password: " .$row["password"];
		}

	} else{
		print("can not select data from the table");
		die(mysql_error());
	}



?>