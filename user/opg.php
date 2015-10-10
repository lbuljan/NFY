<?php 	include_once '../konfiguracija.php';  ?>
<?php
		$data = $con->prepare("select * from opg inner join opg_pr on opg_pr.opg=opg.sifra where opg.sifra=:o");
		$data->bindParam(":o", $_GET["o"]);
		$data->execute();
		$opg = $data->fetchAll(PDO::FETCH_OBJ);


		$data = $con->prepare("select * from korisnik inner join kor_pr on kor_pr.korisnik=korisnik.sifra where korisnik.sifra=:s");
		$data->bindParam(":s", $_SESSION["operater"]->sifra);
		$data->execute();
		$korisnik = $data->fetchAll(PDO::FETCH_OBJ);
?>

<!doctype html>
<html>
<head>
	<?php 	include_once '../head.php';  ?>
	</head>
<body>
	
	<?php 	
	include_once '../navigacija.php'; 
	 ?>


<div class="row profil">
	<div class="col-md-3 col-md-push-1">
	Naziv OPG-a
	</div>
	<div class="col-md-3">
	<img src="../slike/Untitled-5.jpg" />
	</div>
</div>

<div class="row">
	<div class="col-md-3 col-md-push-1">
	Adresa <br />
	Grad <br />
	Poštanski broj <br />
	E-Mail
	</div>
</div>

<?php 	
include_once '../footer.php'; 
?>


</body>
</html>