<?php

/*
 * Funciones necesarias para un login seguro
 */

function secure_session_start() {
	$session_name = 'sec_session_id'; // Set a custom session name
	$secure = false; // Set to true if using https.
	$httponly = true; // This stops javascript being able to access the session id.

	ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
	$cookieParams = session_get_cookie_params(); // Gets current cookies params.
	session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
	session_name($session_name); // Sets the session name to the one set above.
	session_start(); // Start the php session
	session_regenerate_id(true); // regenerated the session, delete the old one.
}


function login($user, $password, $dbh) {
	// Using prepared Statements means that SQL injection is not possible.
	if ($stmt = $dbh->prepare("SELECT id, username, password, salt, email FROM members WHERE username = ? LIMIT 1")) {
		//$stmt->bind_param('s', $user); // Bind "$email" to parameter.
		$stmt->execute(array($user)); // Execute the prepared query.
		//$stmt->store_result();
		//$stmt->bind_result($user_id, $username, $db_password, $salt); // get variables from result.
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		$user_id=$result["id"];
		$username=$result["username"];
                $email=$result["email"];
		$db_password=$result["password"];
		$salt=$result["salt"];
		
		$password = hash('sha512', $password.$salt); // hash the password with the unique salt.

		if($stmt->rowCount() == 1) { // If the user exists
			// We check if the account is locked from too many login attempts
			if(checkbrute($user_id, $dbh) == true) {
				// Account is locked
				// Send an email to user saying their account is locked
				return false;
				
			} else {
				if($db_password == $password) { // Check if the password in the database matches the password the user submitted.
					// Password is correct!

					$ip_address = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user.
					$user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.

					$user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
					$_SESSION['user_id'] = $user_id;
					$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // XSS protection as we might print this value
					$_SESSION['username'] = $username;
                                        $_SESSION['email'] = $email;
					$_SESSION['login_string'] = hash('sha512', $password.$ip_address.$user_browser);
					// Login successful.
					return true;
				} else {
					// Password is not correct
					// We record this attempt in the database
					$now = time();
					$dbh->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
					return false;
				}
			}
		} else {
			// No user exists.
			return false;
		}
	}
}




function sendUserMail($user, $password, $dbh,$header,$title,$message) {
	// Using prepared Statements means that SQL injection is not possible.
	if ($stmt = $dbh->prepare("SELECT id, username, password,email,salt FROM members WHERE username = ? LIMIT 1")) {
		//$stmt->bind_param('s', $user); // Bind "$email" to parameter.
		$stmt->execute(array($user)); // Execute the prepared query.
		//$stmt->store_result();
		//$stmt->bind_result($user_id, $username, $db_password, $salt); // get variables from result.
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		$db_password=$result["password"];
                $db_email=$result["email"];
		$salt=$result["salt"];
		
		$password = hash('sha512', $password.$salt); // hash the password with the unique salt.

		if($stmt->rowCount() == 1) { // If the user exists
                        if($db_password == $password) { // Check if the password in the database matches the password the user submitted.
                            // Password is correct!
                            //$header = 'From: webmaster@app.igp.gob.pe' . "\r\n";
                            mail($db_email, $title, $message, $header);    
                            return true;
                                //return false;
                        }
			
		} else {
			// No user exists.
			return false;
		}
	}
}


function updateNewPassword($user, $password, $dbh) {
	// Using prepared Statements means that SQL injection is not possible.
	if ($stmt = $dbh->prepare("SELECT id, username, password,email,salt FROM members WHERE username = ? LIMIT 1")) {

		$stmt->execute(array($user)); // Execute the prepared query.
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		$salt=$result["salt"];
		
		$newpassword = hash('sha512', $password.$salt); // hash the password with the unique salt.

		if($stmt->rowCount() == 1) { // If the user exists
                    $stmt = $dbh->prepare("UPDATE members SET newpassword = ? WHERE username = ?");
                    $stmt->execute(array($newpassword,$user));
			
		} else {
			// No user exists.
			return false;
		}
	}
}


function updatePassword($iduser, $dbh) {
	// Using prepared Statements means that SQL injection is not possible.
	if ($stmt = $dbh->prepare("SELECT id, password,newpassword, salt FROM members WHERE id = ? LIMIT 1")) {

		$stmt->execute(array($iduser)); // Execute the prepared query.
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		$salt=$result["salt"];
                $pbd=$result["password"];
		$npbd=$result["newpassword"];
                

		if($stmt->rowCount() == 1) { // If the user exists

                    if($pbd!=$npbd){
                        $stmt = $dbh->prepare("UPDATE members SET password = newpassword WHERE id = ?");
                        $stmt->execute(array($iduser));
                        return true;
                    }
                    else{
                        return false;
                    }
			
		} else {
			// No user exists.
			return false;
		}
	}
}


function checkbrute($user_id, $dbh) {
	// Get timestamp of current time
	$now = time();
	// All login attempts are counted from the past 2 hours.
	$valid_attempts = $now - (2 * 60 * 60);

	if ($stmt = $dbh->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
		//$stmt->bind_param('i', $user_id);
		// Execute the prepared query.
		$stmt->execute(array($user_id));
		//$stmt->store_result();
		// If there has been more than 5 failed logins
		if($stmt->rowCount() > 10) {
			return true;
		} else {
			return false;
		}
	}
}



function login_check($dbh) {
	// Check if all session variables are set
	if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
		$user_id = $_SESSION['user_id'];
		$login_string = $_SESSION['login_string'];
		$username = $_SESSION['username'];
		$ip_address = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user.
		$user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.

		if ($stmt = $dbh->prepare("SELECT password FROM members WHERE id = ? LIMIT 1")) {
			$stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
			$stmt->execute(); // Execute the prepared query.
			$stmt->store_result();

			if($stmt->num_rows == 1) { // If the user exists
				$stmt->bind_result($password); // get variables from result.
				$stmt->fetch();
				$login_check = hash('sha512', $password.$ip_address.$user_browser);
				if($login_check == $login_string) {
					// Logged In!!!!
					return true;
				} else {
					// Not logged in
					return false;
				}
			} else {
				// Not logged in
				return false;
			}
		} else {
			// Not logged in
			return false;
		}
	} else {
		// Not logged in
		return false;
	}
}



    function igpcrypt($cadena, $frase = "igpCNDG"){
        $clave=md5($frase);
        $cifrado = MCRYPT_RIJNDAEL_256;
	$modo = MCRYPT_MODE_ECB;
	return mcrypt_encrypt($cifrado, $clave, $cadena, $modo,	mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND));
    }
	 
    function igpdecrypt($cadena, $frase = "igpCNDG"){
        $clave=md5($frase);
	$cifrado = MCRYPT_RIJNDAEL_256;
        $modo = MCRYPT_MODE_ECB;
        return mcrypt_decrypt($cifrado, $clave, $cadena, $modo, mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND));
    }


?>
