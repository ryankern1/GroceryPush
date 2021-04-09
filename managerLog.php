<html>
<head>

	<title>Grocery Store</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/galleryScript.js"></script>
        <div class="header">
                <div class="header-middle">
                      	 <h1><a href="index.php" style="color:white">STORE.COM</a></h1>
                </div>
	</div>
	
</head>
<body>
	<p align = 'center' style = 'color: black;'>LOGIN</p>
 <form method = post >

       <p align = 'center' style = 'color: black;'> Username:<br> <input type="text" name="USERNAME" placeholder='search'>

        <br>Password:<br> <input type = "password" name = "PASSWORD" placeholder ='search'>
	<br>
	<input type ="submit">
	</p>
</form>

<?php
session_start();
	$_SESSION['loggedIn'] = NULL;
        $PASSWORD = $_POST['PASSWORD'];
	$USERNAME = $_POST['USERNAME'];




	$query="SELECT * FROM LoginInfo where username = '$USERNAME'";
	
                 
		include 'functions.php';
		$connection= connect();
		if(!$connection){
			die("Connection failed: " . $connection->connect_error);
		}
                $r=mysqli_query($connection, $query);

		
		$loginInfo = array();
		while($row=mysqli_fetch_array($r)){
			array_push($loginInfo, array($row['username'], $row['password']) );
		}
		$testUser = $loginInfo[0][0];
		$testPass = $loginInfo[0][1];
		//echo $testUser;
		//echo $testPass;

	//password_verify($password, $hashPassword) == true
	if($USERNAME == $testUser && password_verify($PASSWORD, $testPass) == true){
		$_SESSION['loggedIn'] = true;
		echo "<script> window.location.assign('logs.php'); </script>";
	}
	else if($USERNAME != NULL && $PASSWORD != NUll){

		echo "<p><center>Username/Password is incorrect.</center></p>";

			
	}

?>
	
</body>
</html>
