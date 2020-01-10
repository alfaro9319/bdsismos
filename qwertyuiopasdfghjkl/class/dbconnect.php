<?php

	function conx($bd,$user,$pass){

		try {
			$dbh = new PDO('mysql:host=localhost; dbname='.$bd, $user, $pass);

		}
		catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

		return $dbh;
	}


	function conn($bd,$user,$pass){

		try {
			$dbh = new PDO('mysql:host=localhost; dbname='.$bd, $user, $pass);

		}
		catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

		return $dbh;
	}



?>
