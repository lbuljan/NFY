<?php
session_start();
session_destroy();
session_unset();     
//unset($_SESSION);
//print_r($_SESSION); 
header("location: user/formaPrijava.php");