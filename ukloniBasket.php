<?php 	include_once 'konfiguracija.php';  ?>
<?php 
	if($_POST):
		$delete = $con->prepare("delete from kor_pr where korisnik=:s and proizvod=:p and potvrdi=0");
		$delete->bindParam(":s", $_SESSION["operater"]->sifra);
		$delete->bindParam(":p", $_POST["p"]);
		$delete->execute();
			echo "OK";
	endif;
