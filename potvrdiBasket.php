<?php 	include_once 'konfiguracija.php';  ?>
<?php 
	if($_POST):
		$insert = $con->prepare("update kor_pr set potvrdi=1 where korisnik=:s and proizvod=:p");
		$insert->bindParam(":s", $_SESSION["operater"]->sifra);
		$insert->bindParam(":p", $_POST["p"]);
		$insert->execute();
			echo "OK";
	endif;
