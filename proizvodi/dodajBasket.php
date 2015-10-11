<?php 	include_once '../konfiguracija.php';  ?>
<?php 
	if($_POST):
		$insert = $con->prepare("insert into kor_pr(korisnik, proizvod, kolicina, datum, placanje, potvrdi) values (:s, :p, :k, now(), 'Pouzećem', 0)");
		$insert->bindParam(":s", $_SESSION["operater"]->sifra);
		$insert->bindParam(":p", $_POST["p"]);
		$insert->bindParam(":k", $_POST["k"]);
		$insert->execute();
			echo "OK";
	endif;
