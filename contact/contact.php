<?php
	require_once "pear/Mail.php";
	include "pear/Mail/mime.php" ;

	$from = '<anmolshkl@gmail.com>';
	$to = '<anmolshkl@gmail.com>';
	$subject = 'Hi!';
	$body = "Hi,\n\nHow are you?";

	$headers = array(
	    'From' => $from,
	    'To' => $to,
	    'Subject' => $subject
	);

	$smtp = Mail::factory('smtp', array(
	        'host' => 'ssl://smtp.gmail.com',
	        'port' => '465',
	        'auth' => true,
	        'username' => 'anmolshkl@gmail.com',
	        'password' => 'asaf-123'
	    ));

	$mail = $smtp->send($to, $headers, $body);

	if (PEAR::isError($mail)) {
	    echo('<p>' . $mail->getMessage() . '</p>');
	} else {
	    echo('<p>Message successfully sent!</p>');
	}
?>