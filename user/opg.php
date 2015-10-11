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
	print_r($proizvodi);
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
	<div class="banner">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-2 col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-10 col-xs-push-1">
				<?php if($podaci->profilna):?>
					<img style="border-radius: 100%; -moz-border-radius: 100%; -webkit-border-radius: 100%;" src="<?php echo $put;?>slike/opg/<?php echo $podaci->profilna;?>" class="img-responsive" />
				<?php else:?>
					<img src="<?php echo $put;?>slike/opg/placeholder.png" class="img-responsive"/>
				<?php endif;?>
			</div>
			<div class="col-xs-12">
				<h1> <?php echo $podaci->naziv;?></h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-10 col-xs-push-1"  style="text-align: center">
			<h3> <?php echo $podaci->adresa . " - " . $podaci->post_broj . " " . $podaci->grad ;?><hr style="border-color:black;" /></h3>
		</div>	
	</div>
	<div class="row">
		<div class="col-xs-10 col-xs-push-1"  style="text-align: center">
			<h3> <a href="mailto:<?php echo $podaci->email;?>"> <img src="<?php echo $put;?>slike/email.png"/> <?php echo $podaci->email;?> </a><hr style="border-color:black;" /></h3>
		</div>	
	</div>
	
	<div class="row">
		<div class="col-xs-10 col-xs-push-1">
	<?php foreach($proizvodi as $prod):
		$slike = $con->prepare("select naslovna from galerija where galerija.proizvod=:p");
		$slike->bindParam(":p", $prod->sifra);
		$slike->execute();
		$pic = $slike->fetch(PDO::FETCH_OBJ);
	?>
		<div class="col-xs-10 col-xs-push-1 col-md-3 col-md-push-1" style="text-align: center">
			<div class="row">
			<a href="<?php echo $put;?>proizvodi/proizvod.php?p=<?php echo $prod->sifra;?>">
				<div class="col-xs-10 col-xs-push-1">
					<img class="proizvodi_slika" src="<?php echo $put;?>slike/proizvodi/<?php echo $pic->naslovna;?>"/>
				</div>
			</a>
			</div>
			<div class="row">
				<div class="col-xs-10 col-xs-push-1">
					<h3> <?php echo $prod->naziv;?> </h3>
				</div>
			</div>
		</div>
	
	<?php endforeach;?>
		</div>
	</div>


<?php 	
include_once '../footer.php'; 
?>


</body>
</html>