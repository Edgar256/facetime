<?php 

    /*server login credentials*/
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'facetime');

    /*Attempt to connect to the DB - Object oriented*/
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    /*Check the connectio{n*/
    if($mysqli === false){
        die("ERROR: Could not connect to the DB" .$mysqli->connect_error );
    }

?> 