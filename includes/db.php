<?php

	$dbh = 'mysql:host=localhost;dbname=projecttwo';

	try {
		$pdo = new PDO($dbh, 'root', '');
	} catch (PDOException $e) {
		echo $e->getMessage();
	}

?>
