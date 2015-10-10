<?php
include '../konfiguracija.php';

$_POST['lozinka'] = md5 ($_POST['lozinka']);

$checkKor = $con->prepare("select * from korisnik where email=:email and lozinka=:lozinka;");
$checkKor -> execute($_POST);
$operater = $checkKor -> fetch(PDO::FETCH_OBJ);

if($operater==NULL):
	$checkOpg = $con->prepare("select * from opg where email=:email and lozinka=:lozinka;");
	$checkOpg->execute($_POST);
	$operater = $checkOpg->fetch(PDO::FETCH_OBJ);
	
	if($operater==NULL):
		header("location: formaPrijava.php?err=1");
	else:
		$_SESSION['operater'] = $operater;
		header("location: ../index.php");
	endif;
else:
	$_SESSION['operater'] = $operater;
	header("location: ../index.php");
endif;