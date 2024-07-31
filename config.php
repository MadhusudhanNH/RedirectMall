<?php

    date_default_timezone_set('Asia/Calcutta');	// Sets the default time zone which hepls in Session management and validations

    //Validating a Session
    if(!isset($_SESSION)) 
    {
        ini_set('session.gc_maxlifetime', 86400); // Sets session max time
        session_set_cookie_params(86400);		
        session_start(); // Satrting a session
    }
    // By creating session we can avoid user to login multiple times.

    try
    {
        $RMPDO = new PDO('mysql:host=localhost:3306;dbname=redirectmall', 'redirectmall', 'RM@1234');
        $RMPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $RMMySQLi = new mysqli('localhost:3306', 'redirectmall', 'RM@1234', 'redirectmall');
    }
    catch(PDOException $e)
    {
        echo "DataBase connection exception : " . $e->getMessage()."<br>";
    }

?>
