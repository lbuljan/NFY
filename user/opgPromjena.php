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
if($_POST):
	$valid=true;
	if($_FILES["photo"]["name"]):
		if(!$_FILES["photo"]["error"]):
		$stripped = substr($_FILES["photo"]["name"], -10);
			$file_name=$_SESSION["operater"]->sifra . "_" . $stripped;
			if($_FILES["photo"]["size"] > (3096000)):
				$valid=false;
				header("location: dodajNovi.php?err=1");
			endif;
				if($valid):
					move_uploaded_file($_FILES["photo"]["tmp_name"], "../slike/opg/". $file_name);
				endif;

		else:
			echo "Problem: " . $_FILES["photo"]["error"];
		endif;
		$update = $con->prepare("update opg set naziv=:naziv, adresa=:adresa, grad=:grad, post_broj=:post_broj, email=:email, profilna=:photo where sifra=:sifra");
		$update->bindParam(":naziv", $_POST["naziv"]);
		$update->bindParam(":adresa", $_POST["adresa"]);
		$update->bindParam(":grad", $_POST["grad"]);
		$update->bindParam(":post_broj", $_POST["post_broj"]);
		$update->bindParam(":email", $_POST["email"]);
		$update->bindParam(":photo", $file_name);
		$update->bindParam(":sifra", $_POST["sifra"]);
		$update->execute();
		header("location: opgPromjena.php?o=" . $_POST["sifra"]);
	endif;
	
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

	 
	 
	
	<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h1 class="naslov">Promjeni podatke</h1>
	</div>
</div>
<div class="row profil">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
	<div class="col-sm-5 col-sm-push-1 col-xs-10 col-xs-push-1">
	<h1 class="naslov1">
		<input type="hidden" id="sifra" name="sifra" value="<?php echo $_GET["o"];?>"/>
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
		<img class="prf" src="<?php echo $put;?>slike/opg/<?php echo $podaci->profilna;?>" />
	<?php else:?>
		<img class="prf" src="<?php echo $put;?>slike/opg/placeholder.png"/>
	<?php endif;?>
	
	<input class="log" type="file" id="photo" name="photo" class="btn btn-default" value="<?php echo $podaci->profilna;?>"/>
	<div class="row">
		<div class="col-xs-10 col-xs-push-1">
			<input type="submit" class="btn btn-default" value="Promjeni podatke"/>
		</div>
	</div>
	</form>
	</div>
</div>


		



<?php 	
include_once '../footer.php'; 
?>
<script>
	$("#obrisi").click(function(){
		var sifra = $("#sifra").val();
		$.ajax({
      			type: 'POST',
      			url: "<?php echo $put;?>obrisiOPG.php",
      			data: "sifra=" + sifra,
      			dataType: 'text'
    			}).done(function(rezultat) {
    				
        			if(rezultat=="OK"){
        				
        				alert("OPG obrisan!");
   						window.location="<?php echo $put;?>odjava.php";
   					}else{
   						alert(rezultat);
   					}
    			});   
		return false;
	});
	})
</script>

</body>
</html>