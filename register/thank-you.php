<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en" >
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Contact Us!</title>
		<meta name="description" content="App-ly is an event organized by Consortium,VNIT.App-ly is looking for out-of-box app ideas that can redefine the way of living." />
		<meta name="keywords" content="vnit, consortium, app contest, apply, app-ly, ideas" />
		<meta name="author" content="VNITs" />
		
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="/home/bootstrap.min.css">
		<link href='http://fonts.googleapis.com/css?family=Comfortaa:400,700' rel='stylesheet' type='text/css'>
		<style>
		html {
			padding: 7px;
		}
		body {
			background: url('/home/img.jpg') no-repeat center center fixed;
		    -webkit-background-size: cover;
		    -moz-background-size: cover;
		    -o-background-size: cover;
		    background-size: cover;
		    font-family: 'Comfortaa', cursive !important;
		    font-size: 20px; 
		}
		.trans {
			padding: 20px;
			background: rgba(159,182,205, 0.2);
			border-radius: 5px;
			text-align: center;
			line-height: 0px;
		}
		
		</style>
    
	</head>
	<body>
		<div class="container-fluid">
			<div class="col-xs-8 col-xs-offset-2 trans">
				<?php if(isset($_SESSION['registered']) && $_SESSION['registered'] != false) { ?>
				  We'll keep you in loop.Stay Tuned!
				  <img class="img-responsive" src="/register/02.png" />
				<?php } else { ?>
				  <h1> Sorry, you have already registered! </h1>
				<?php } ?>
			</div>
		</div>
	
		<script type="text/javascript" src="/home/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="/home/bootstrap.min.js"></script>
	</body>
