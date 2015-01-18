<?php
	session_start();
	$full_name="";
	$idea="";
	$idea_extra="";
	$institute="";
	$contact="";
	$email="";
	//regular expression to match an email
	$regex1 = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

	$username = 'apply';
	$password = 'admin123';
	echo "1";
	#print_r($_POST);
	if(isset($_POST['full_name']) && isset($_POST['idea']) && isset($_POST['idea_extra']) && isset($_POST['institute'])
		&& isset($_POST['contact']) && isset($_POST['email'])) {
			echo "2";

		if($_POST['full_name']!='' && $_POST['idea']!='' && $_POST['idea_extra']!='' && $_POST['email']!=''
		&& $_POST['contact']!='' && $_POST['institute']!='') {
				echo "3";

			$full_name=$_POST['full_name'];
			$idea=$_POST['idea'];
			$idea_extra=$_POST['idea_extra'];
			$institute=$_POST['institute'];
			$contact=$_POST['contact'];
			$email=$_POST['email'];
			print_r($_POST);
			if (preg_match($regex1, $email)) {
				echo "email macthed";
				try {
					echo "make connection";
					$conn = new PDO('mysql:host=localhost;dbname=app-ly', $username, $password);
					
					$query = "SELECT user_id FROM users WHERE email= :email";
		            $stmt = $conn->prepare($query);
		            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
		            $stmt->execute();
		            $rows=$stmt->fetch();
		            echo "user not found";
		            if($rows > 0 ) {
		                //for now sending error as a plain string,can be sent as JSON object instead
		                echo 'username exists';
		            }
		        } catch(PDOException $e) {
					    echo 'ERROR: ' . $e->getMessage();
				}
	            else {
					try {
					    $query = "INSERT INTO users (full_name,email,contact,institue,idea,idea_extra) 
					    		  VALUES(:fn,:email,:contact,:insti,:idea,:idea_ex)";
			             
			            $stmt = $conn->prepare($query);
		                $stmt->bindParam(':fn', $full_name, PDO::PARAM_STR);
		                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
		                $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);
		                $stmt->bindParam(':insti', $institute, PDO::PARAM_STR);
		                $stmt->bindParam(':idea', $idea, PDO::PARAM_STR);
		                $stmt->bindParam(':idea_ex', $idea_extra, PDO::PARAM_STR);
						$stmt->execute();
						echo "DONE!<br>";
					} catch(PDOException $e) {
					    echo 'ERROR: ' . $e->getMessage();
					}

					$_SESSION['message'] = "You have successfully registered!";
					#header('Location: http://www.app-ly.in/thank-you/?message=Success');
				}

			}
			else {
				echo "Invalid email!";
			}
		}
		else {
			echo "Invalid details entered.Please check all input fields.";
		}
	}
	else {
		echo "Invalid details entered.Please check all input fields.";
	}
?>