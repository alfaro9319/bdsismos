<?php

  function mysqlConx($database){
    define("HOST", "localhost"); // The host you want to connect to.
    define("USER", "wmaster"); // The database username.
    define("PASSWORD", "igpwmaster"); // The database password. 
    define("DATABASE", $database); // The database name.
    return new mysqli(HOST, USER, PASSWORD, DATABASE);
    
  }
?>
