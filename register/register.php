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
	if(isset($_POST['full_name']) && isset($_POST['idea']) && isset($_POST['idea_extra']) && isset($_POST['institute'])
		&& isset($_POST['contact']) && isset($_POST['email'])) {

		if($_POST['full_name']!='' && $_POST['idea']!='' && $_POST['idea_extra']!='' && $_POST['email']!=''
		&& $_POST['contact']!='' && $_POST['institute']!='') {

			$full_name=$_POST['full_name'];
			$idea=$_POST['idea'];
			$idea_extra=$_POST['idea_extra'];
			$institute=$_POST['institute'];
			$contact=$_POST['contact'];
			$email=$_POST['email'];
			if (preg_match($regex1, $email)) {
				try {
					$conn = new PDO('mysql:host=localhost;dbname=app-ly', $username, $password);
					
					$query = "SELECT user_id FROM users WHERE email= :email";
		            $stmt = $conn->prepare($query);
		            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
		            $stmt->execute();
		            $rows=$stmt->fetch();
		            
		        } 
		        catch(PDOException $e) {
					    echo 'ERROR: ' . $e->getMessage();
				}
				if($rows > 0 ) {
		                //for now sending error as a plain string,can be sent as JSON object instead
		                $_SESSION['registered'] = false;
		        }
	            else {
					try {
					    $query = "INSERT INTO users (full_name,email,contact,institute,idea,idea_extra,selected) 
					    		  VALUES(:fn,:email,:contact,:insti,:idea,:idea_ex,:selected)";
			             
			            $stmt = $conn->prepare($query);
		                $stmt->bindParam(':fn', $full_name, PDO::PARAM_STR);
		                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
		                $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);
		                $stmt->bindParam(':insti', $institute, PDO::PARAM_STR);
		                $stmt->bindParam(':idea', $idea, PDO::PARAM_STR);
		                $stmt->bindParam(':idea_ex', $idea_extra, PDO::PARAM_STR);
						$stmt->bindParam(':selected', false, PDO::PARAM_BOOL);
						$stmt->execute();
					} catch(PDOException $e) {
					    echo 'ERROR: ' . $e->getMessage();
					}
					$_SESSION['registered'] = true;
					header('Location: http://www.app-ly.in/register/thank-you.php/');
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