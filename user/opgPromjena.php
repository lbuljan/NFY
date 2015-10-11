<?php 	include_once '../konfiguracija.php';  ?>
<?php 

if(isset($_GET["o"])):
	$opg = $con->prepare("select * from opg where sifra=:o ");
	$opg->bindParam(":o", $_GET["o"]);
	$opg->execute();
	$podaci = $opg->fetch(PDO::FETCH_OBJ);
	
	$komentar = $con->prepare("select * from komentar where opg=:o and proizvod=0");
	$komentar->bindParam(":o", $_GET["o"]);
	$komentar->execute();
	$komentari = $komentar->fetchAll(PDO::FETCH_OBJ);
	
	$proizvod = $con->prepare("select * from proizvod where sifra in (select proizvod from opg_pr where opg=:o)");
	$proizvod->bindParam(":o", $_GET["o"]);
	$proizvod->execute();
	$proizvodi = $proizvod->fetchAll(PDO::FETCH_OBJ);
else:
	$opg = $con->prepare("select * from opg where sifra=:o ");
	$opg->bindParam(":o", $_SESSION["operater"]->sifra);
	$opg->execute();
	$podaci = $opg->fetch(PDO::FETCH_OBJ);
	
	$komentar = $con->prepare("select * from komentar where opg=:o and proizvod=0");
	$komentar->bindParam(":o", $_SESSION["operater"]->sifra);
	$komentar->execute();
	$komentari = $komentar->fetchAll(PDO::FETCH_OBJ);
	
	$proizvod = $con->prepare("select * from proizvod where sifra in (select proizvod from opg_pr where opg=:o;)");
	$proizvod->bindParam(":o", $_SESSION["operater"]->sifra);
	$proizvod->execute();
	$proizvodi = $proizvod->fetchAll(PDO::FETCH_OBJ);
	
endif;
	
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

	 
	 <?php if(isset($_GET["o"])):?>
		<input type="hidden" id="opg" value="<?php echo $_GET["o"];?>"/>
	 <?php endif;?>
	 <?php if(isset($_SESSION["operater"]->naziv)):?>
		<input type="hidden" id="opg" value="<?php echo $_SESSION["operater"]->sifra;?>"/>
	<?php endif;?>
	
	<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h1 class="naslov">Promjeni podatke</h1>
	</div>
</div>
<div class="row profil">

	<div class="col-lg-5 col-lg-push-1 col-md-5 col-md-push-1 col-sm-5 col-sm-push-1 col-xs-10 col-xs-push-1">
	<h1 class="naslov1">
		<input class="log" type="text" id="naziv" name="naziv" value="<?php echo $podaci->naziv?>" />
	</h1>
		<p class="adresa">
			<input class="log" type="text" id="adresa" name="adresa" value="<?php echo $podaci->adresa;?>" /> <br />
		</p>
		<input class="log" type="text" id="grad" name="grad" value="<?php echo $podaci->grad;?>" /><br />
		<input class="log" type="text" id="post_broj" name="post_broj" value="<?php echo $podaci->post_broj;?>" /> <br />
		
			<p class="adresa" style="margin-top:10px;">
				<input class="log" type="text" id="email" name="email" value="<?php echo $podaci->email;?>"/>
			</p>
		
	</div>

	<div class="col-sm-3 col-xs-10 col-xs-push-3">
	<?php if($podaci->profilna):?>
		<img class="prf" src="<?php echo $put;?>slike/korisnik/<?php echo $podaci->profilna;?>" />
	<?php else:?>
		<img class="prf" src="<?php echo $put;?>slike/korisnik/placeholder.png"/>
	<?php endif;?>
	
	<input class="log" type="file" id="photo" name="photo" class="btn btn-default"/>
	</div>
</div>


		



<?php 	
include_once '../footer.php'; 
?>


</body>
</html>