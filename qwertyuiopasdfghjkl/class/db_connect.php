<?php

define("HOST", "localhost"); // The host you want to connect to.
define("USER", "wmaster"); // The database username.
define("PASSWORD", "igpwmaster"); // The database password. 
define("DATABASE", "sismos"); // The database name.
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

?>
