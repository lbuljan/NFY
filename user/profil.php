<?php 	include_once '../konfiguracija.php';  ?>
<?php

		$data = $con->prepare("select * from korisnik where sifra=:s");
		$data->bindParam(":s", $_SESSION["operater"]->sifra);
		$data->execute();
		$korisnik = $data->fetch(PDO::FETCH_OBJ);

		$kupljeno = $con->prepare("select * from kor_pr inner join proizvod on proizvod.sifra=kor_pr.proizvod where korisnik=:s");
		$kupljeno->bindParam(":s", $_SESSION["operater"]->sifra);
		$kupljeno->execute();
		$history = $kupljeno->fetchAll(PDO::FETCH_OBJ);
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

	 <div class="banner">
		<div class="row">
			<div class="col-lg-8 col-lg-push-4 col-md-10 col-md-push-4 col-sm-10 col-sm-push-3 col-xs-10 col-xs-push-1">
				<?php if($korisnik->profilna):?>
					<img style="border-radius: 100%; -moz-border-radius: 100%; -webkit-border-radius: 100%;" src="<?php echo $put;?>slike/korisnik/<?php echo $korisnik->profilna;?>"  class="img-responsive"/>
				<?php else:?>
					<img style="border-radius: 100%; -moz-border-radius: 100%; -webkit-border-radius: 100%;" src="<?php echo $put;?>slike/korisnik/placeholder.png"  class="img-responsive"/>
				<?php endif;?>
			</div>
			<div class="col-xs-12">
				<h1> <?php echo $korisnik->ime . " " . $korisnik->prezime;?>
				<a href="<?php echo $put; ?>user/profilPromjena.php" style="font-size:13px;margin-left:10px;color:white;">
					Uredi
				</a>
			</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-10 col-xs-push-1"  style="text-align: center">
			<h3> <?php echo $korisnik->adresa . " - " . $korisnik->post_broj . " " . $korisnik->grad ;?><hr style="border-color:black;" /></h3>
		</div>	
	</div>

<div class="row">
		<div class="col-xs-10 col-xs-push-1"  style="text-align: center">
			<h3> <a href="mailto:<?php echo $podaci->email;?>"> <img src="<?php echo $put;?>slike/email.png"/> <?php echo $korisnik->email;?> </a><hr style="border-color:black;" /></h3>
		</div>	
	</div>



<div class="row">
	<div class="col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-10 col-sm-push-1 col-xs-10 col-xs-push-1">
	<h1>Kupljeni proizvodi</h1>
	<hr style="border-color:black;" />
	</div>
	<div class="col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-10 col-sm-push-1 col-xs-10 col-xs-push-1">
		<?php foreach($history as $hs):
		
		$slike = $con->prepare("select naslovna from galerija where proizvod=:p");
		$slike->bindParam(":p", $hs->sifra);
		$slike->execute();
		$pic = $slike->fetch(PDO::FETCH_OBJ);
		?>
		<div class="col-lg-4 col-md-4 col-md-push-1 col-sm-4 col-xs-10 col-xs-push-4 proizvodi">
			<a href="<?php echo $put;?>proizvodi/proizvod.php?p=<?php echo $hs->sifra;?>">
				<img class="opg_slika" src="slike/proizvodi/<?php echo $hs->naslovna;?>" />
			</a>
			<h2><span><?php echo $hs->naziv;?></span></h2>
		</div>
		<?php endforeach;?>
	</div>
</div>

<?php 	
include_once '../footer.php'; 
?>


</body>
</html>