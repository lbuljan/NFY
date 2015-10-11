<?php 	include_once '../konfiguracija.php';  ?>
<?php 
	if(isset($_POST["kor"])):
			$dodaj = $con->prepare("insert into komentar(korisnik, na_opg, komentar, vrijeme) values (:u, :o, :k, now());");
			$dodaj->bindParam(":u", $_SESSION["operater"]->sifra);
			$dodaj->bindParam(":o", $_POST["o"]);
			$dodaj->bindParam(":k", $_POST["k"]);
			$dodaj->execute();
			echo "OK";
	endif;
	
	if(isset($_POST["opg"])):
			$dodaj = $con->prepare("insert into komentar(opg, proizvod, komentar, vrijeme) values (:u, :p, :k, now());");
			$dodaj->bindParam(":u", $_SESSION["operater"]->sifra);
			$dodaj->bindParam(":p", $_POST["p"]);
			$dodaj->bindParam(":k", $_POST["k"]);
			$dodaj->execute();
			echo "OK";
	endif;
	?>