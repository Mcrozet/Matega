<?php

require 'models/autoloader.php';
Autoloader::register();

session_start();

require('controllers/index.php');
require('controllers/registration.php');
require('controllers/tournaments.php');
require('controllers/user.php');

try {
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        if(function_exists($action)){
            $action($_GET, $_POST);
        }
        else{
            error();
        }
    }
    else{       
        header('location:home');
    }
}
catch(Exception $e) {    
    var_dump(http_response_code());
    die;
	echo 'Erreur: ' . $e->getMessage();
}
