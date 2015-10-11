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
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h1 class="naslov">Promjeni podatke</h1>
	</div>
</div>
<div class="row profil">

<div class="col-lg-5 col-lg-push-1 col-md-5 col-md-push-1 col-sm-5 col-sm-push-1 col-xs-10 col-xs-push-1">
	<h1 class="naslov1">
		<input class="log" type="text" id="ime" name="ime" value="<?php echo $korisnik->ime?>" />
		<input class="log" type="text" id="prezime" name="prezime" value="<?php echo $korisnik->prezime?>" /></h1>
		<p class="adresa">
			<input class="log" type="text" id="adresa" name="adresa" value="<?php echo $korisnik->adresa;?>" /> <br />
		</p>
		<input class="log" type="text" id="grad" name="grad" value="<?php echo $korisnik->grad;?>" /><br />
		<input class="log" type="text" id="post_broj" name="post_broj" value="<?php echo $korisnik->post_broj;?>" /> <br />
		
			<p class="adresa" style="margin-top:10px;">
				<input class="log" type="text" id="email" name="email" value="<?php echo $korisnik->email;?>"/>
			</p>
		
	</div>
	<div class="col-sm-3 col-xs-10 col-xs-push-3">
	<?php if($korisnik->profilna):?>
		<img class="prf" src="<?php echo $put;?>slike/korisnik/<?php echo $korisnik->profilna;?>" />
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