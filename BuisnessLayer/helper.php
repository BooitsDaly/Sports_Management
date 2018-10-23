<?php
/**
* Sanitize String
* Helper function to sanitize inputs
*
* @param $var
* @return string
*/


//sanitize input
function sanitizeString($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}

/**
 * error message return
 */
function errorMessage(){
    echo "<script> alert('Please Fill out the whole form');</script>";
}