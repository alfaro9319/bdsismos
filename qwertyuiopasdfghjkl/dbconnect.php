<?php
/***Conexión para Login, Administrador, Personal, Graficos de Personal***/
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
			$dbh = new PDO('mysql:host=10.10.30.6; dbname='.$bd, $user, $pass);

		}
		catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

		return $dbh;
	}

		
	function conx33($bd,$user,$pass){

		try {
			$dbh = new PDO('mysql:host=10.10.0.33; dbname='.$bd, $user, $pass);

		}
		catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

		return $dbh;
	}	

?>
