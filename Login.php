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
	$username = '';
	$password = '';

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

	/*same function as Caesar in the client side,
	I just translated it to PHP. */
	function Decrypt($string, $amount){
		if($amount < 0)
			return Decrypt($string, $amount + 26);
		$decrypted = ''; 
		for( $i=0; $i < strlen($string); $i++){
			$code = ord($string[$i]);
			if ( $code >= 65 && $code <= 90 )
				$tmp = (( ($code - 65 + $amount) % 26) + 65);
			else if( $code >= 97 && $code <= 122 )
				$tmp = (( ($code - 97 + $amount) % 26) + 97);
		}
		return $decrypted;
	}



	if ( $result->num_rows > 0 ){
		while($row = $result->fetch_assoc() ){
			echo "member ID: " .$row["member_ID"]. "shared_key: " .$row["shared_key"]. "username: " .$row["username"]. "password: " .$row["password"];
			if ( .$row["member_ID"] == $username && .$row["password"] == $password ){
				echo "login successfully";
			} else {
				echo "login failed";
			}
		}

	} else{
		print("can not select data from the table");
		die(mysql_error());
	}

?>