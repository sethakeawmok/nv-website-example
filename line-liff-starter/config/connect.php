<?php
	$host='localhost';
	$db_name='jingjaidee_analytics';
	$db_username='jingjaidee';
	$db_password='j3a0zDqv';

	try{
		$pdo = new PDO('mysql:host='.$host.';dbname='.$db_name,$db_username,$db_password);
		$pdo->query('SET NAMES utf8');
	}
	catch (PDOException $e){
		print "Error!:".$e->getMessage()."<br/>";
	}

?>