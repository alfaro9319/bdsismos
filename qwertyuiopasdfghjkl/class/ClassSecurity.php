<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of security
 *
 * @author eddy
 */
class Security {
    //put your code here
    
        /*Función para evitar injección de código SQL*/
        function Security($_Cadena) {  
            $_Cadena = htmlspecialchars(trim(addslashes(stripslashes(strip_tags($_Cadena)))));  
            $_Cadena = str_replace(chr(160),'',$_Cadena);  
        return mysql_real_escape_string($_Cadena);  
        } 
    
}
