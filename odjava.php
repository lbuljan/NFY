<?php
session_start();
session_destroy();
session_unset();     
unset($_SESSION["operater"]);
//print_r($_SESSION); 
header("location: index.php");