
<?php

	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Grocery Store</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/galleryScript.js"></script>

	<div class="header">
                <div class="header-middle">
		<h1><a href="index.php" style="color:white"</a>STORE.COM</h1>
                        <a href="https://www.google.com/maps" style="color:white"<p id="addr">Store address goes here...</p></a>
                        <select id="storeNumb">
                                <option value="Store1">Store 1</option>
                                <option value="Store2" selected >Store 2</option>
                        </select>

                </div>
                <div class="header-login">
                        <button onclick="location.href = 'managerLog.php';" type="button" id="loginbutton">Manager<br>Login</button>
                </div>
        </div>

        <div class="search">
                <form method = post >

                        <p style = 'color: white;'> <input type="text" name="search" id="searchbar-1" placeholder='search...'>

                                <input type ="submit">
                        </p>
                </form>

                <?php

                $search = $_POST['search'];
                //echo "$search";
                $query="SELECT * FROM Sells NATURAL JOIN Product NATURAL JOIN Store where pName = '$search'";
          ?>
        </div>
	
<?php	
		include 'functions.php';
       		 $connection = connect();
		if (!$connection) {
                //die prints message then ends script
                die("Connection failed: " . $connection->connect_error);
        }
	if($search == NULL){
                                $query="SELECT * FROM Sells NATURAL JOIN Product NATURAL JOIN Store";
                        }

       // $query="SELECT * FROM Sells NATURAL JOIN Product NATURAL JOIN Store";
        $t =mysqli_query($connection, $query);
        $food_array = array();
        while($row=mysqli_fetch_array($t)) {
                //a double array of each stores with relevant data
                array_push($food_array, array($row['name'],$row['phoneNum'],$row['addr'],$row['pName'],$row['description'],$row['sellPrice']) );
        }
        // turn php array into js array
        echo '<script> var food_array = ' . json_encode($food_array) . '; </script>' ;
        close($connection);
        


		

/*
		//	goal: get product name, price, total amount
		if($connection=@mysqli_connect('localhost','rkern3','rkern3','GroceryDB')) {
			if($search == NULL){
				$query="SELECT * FROM Sells NATURAL JOIN Product NATURAL JOIN Store";
			}
			$t =mysqli_query($connection, $query);
			$food_array = array();
			while($row=mysqli_fetch_array($t)) {
				//echo $row['pName'];
				array_push($food_array, 
					array($row['name'],$row['phoneNum'],$row['addr'],$row['pName'],$row['description'],$row['sellPrice']) );
			}
			//print_r($food_array);

			// send array to js
			echo '<script> var food_array = ' . json_encode($food_array) . '; </script>' ;
		}
		else{
			echo 'not connected to DB!';
		}
 */	 
 	?>	
</head>
<body>

	
	<div class="gallery-slider">
		<div class="gallery-container"></div>	
	
			<script>
			for(let i = 0; i <food_array.length; i++){
				if(food_array[i][0] == $("#storeNumb").val()){

					$("#addr").html(food_array[i][2]);
					$(".gallery-container" ).append(
						"<div class=\"item\"> <div class=\"foodinfo\" >" +
						food_array[i][3] + "<br>" +
						food_array[i][4] + "<br>$" +
						food_array[i][5] + "</div></div>");
				}
			}
			</script>
		
		<div class="gallery-controls">
			<ul>
				<li id="<"><</li>
				<li id=">">></li>
			</ul>
		</div>
	</div>
	
</body>
</html>
