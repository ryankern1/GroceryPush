
	<?php
		
		$password = "Password1";

		$hashPassword = password_hash($password, PASSWORD_BCRYPT);
		//$hashPassword = '$2y$10$MtCWoSIqAEzSrmW6GIJdjuUHXZEcN3AUb3B7kR3xCi4WkvZrrRsKK';
		echo $hashPassword;
		if(password_verify($password, $hashPassword) == true){
			echo "its good.";
		}
		else{
			echo "its not good.";
		}



		//incase I forget Password.
		//Username: AwesomeGuy1
		//password: Password1
?>

