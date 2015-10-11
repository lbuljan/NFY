<?php 	include_once '../konfiguracija.php';  ?>
<?php 
	if($_POST):
		$dodaj = $con->prepare("insert into kor_pr(korisnik, proizvod, kolicina, vrijeme, placanje) values (:u, :p, :k, now(), 'pouzece');");
		$dodaj->bindParam(":u", $_SESSION["operater"]->sifra);
		$dodaj->bindParam(":p", $_POST["p"]);
		$dodaj->bindParam(":k", $_POST["k"]);
		$dodaj->execute();
			echo "OK";
	endif;
