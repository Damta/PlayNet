<?php
	session_start();

	// configuration
	$dbhost 	= "localhost";
	$dbname		= "pn";
	$dbuser		= "root";
	$dbpass		= "";

	// database connection
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);


		$errMsg = '';
		//username and password sent from Form
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		if($username == ''){
      $errMsg .= 'You must enter your Password<br>';
      echo "Please enter a Password";
    }

		if($password == ''){
      $errMsg .= 'You must enter your Password<br> \r\n';

      echo "Please enter a Password";

    }


		$result = $conn->prepare("SELECT * FROM users WHERE username= :hjhjhjh AND password= :asas");

		$result->bindParam(':hjhjhjh', $username);
		$result->bindParam(':asas', $password);
		$result->execute();

		$rows = $result->fetch(PDO::FETCH_NUM);

		if($rows > 0) {
			$_SESSION['username'] = $username;
    	$_SESSION['password'] = $password;
			header("location: home.php");

		}
		else{

			echo "Wrong username or password";
		}


?>
