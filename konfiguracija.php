<?php

$server="localhost";
$baza="nfy";
$user="root";
$pass="000000";
$put="/NFY/";

$con = new PDO("mysql:dbname=" . $baza . 
		";host=" . $server . 
		"", 
			$user, $pass);
$con->exec("SET CHARACTER SET utf8");
$con->exec("SET NAMES utf8");
error_reporting(0);
session_start();

