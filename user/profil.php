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


<div class="row profil">

	<div class="col-lg-6 col-lg-push-1 col-md-7 col-md-push-1 col-sm-7 col-sm-push-1 col-xs-10 col-xs-push-1">
	<h1 class="naslov1">
		<?php echo $korisnik->ime . " " . $korisnik->prezime;?><hr /></h1>
		<p class="adresa">
			<img src="<?php echo $put; ?>slike/lokacija.png"><?php echo $korisnik->adresa;?> <br />
		</p>
		<div class="lijevo"><?php echo $korisnik->grad;?><br />
		<?php echo $korisnik->post_broj;?> <br />
		</div>
			<p class="adresa" style="margin-top:10px;">
				<img src="<?php echo $put; ?>slike/email.png"><?php echo $korisnik->email;?>
			</p>
		
	</div>
	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-10 col-xs-push-1">
	<?php if($korisnik->profilna):?>
		<img class="prf" src="<?php echo $put;?>slike/korisnik/<?php echo $korisnik->profilna;?>" />
	<?php else:?>
		<img class="prf" src="<?php echo $put;?>slike/korisnik/placeholder.png"/>
	<?php endif;?>
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