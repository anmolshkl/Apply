<?php
	$name="";
	$email="";
	$query="";

	$username = 'apply';
	$password = 'admin123';
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['query'])) {

		if($_POST['name']!='' && $_POST['email']!='' && $_POST['query']!='') {

			$name=$_POST['name'];
			$email=$_POST['email'];
			$query=$_POST['query'];
			try {
				$conn = new PDO('mysql:host=localhost;dbname=app-ly', $username, $password);
				$dbQuery = "INSERT INTO contact_form (name,email,query) 
					    		  VALUES(:name,:email,:query)";
				$stmt = $conn->prepare($dbQuery);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':query', $query, PDO::PARAM_STR);
                $stmt->execute();
                echo "Thanks for contacting us!<br> We'll get back to you as soon as possible :)";
			}
			catch(PDOException $e) {
			 	echo 'ERROR: ' . $e->getMessage();
			}
		}
		else {
			echo "Please check the Input";
		}
	}
	else {
		echo "Please check the Input";
	}
?>