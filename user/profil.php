<?php 	include_once '../konfiguracija.php';  ?>
<?php

		$data = $con->prepare("select * from korisnik where sifra=:s");
		$data->bindParam(":s", $_SESSION["operater"]->sifra);
		$data->execute();
		$korisnik = $data->fetch(PDO::FETCH_OBJ);
		
		print_r($korisnik);

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
		<?php echo $korisnik->ime . " " . $korisnik->prezime;?>
	</div>
	<div class="col-md-3">
	<?php if($korisnik->profilna):?>
		<img class="prf" src="<?php echo $put;?>slike/korisnik/<?php echo $korisnik->profilna;?>" />
	<?php else:?>
		<img class="prf" src="<?php echo $put;?>slike/korisnik/placeholder.png"/>
	<?php endif;?>
	</div>

</div>

<div class="row">
	<div class="col-md-3 col-md-push-1">
	<?php echo $korisnik->adresa;?> <br />
	<?php echo $korisnik->grad;?><br />
	<?php echo $korisnik->post_broj;?> <br />
	<?php echo $korisnik->email;?>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h1> Kupljeni proizvodi </h1>
	</div>
	<div class="col-xs-12 col-md-4">
		<!-- FOREACH ZA KOR_PR -->
	</div>
</div>

<?php 	
include_once '../footer.php'; 
?>


</body>
</html>