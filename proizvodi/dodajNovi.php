<?php 	include_once '../konfiguracija.php';  ?>
<?php
if($_POST):
//UPLOAD SLIKE
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
					move_uploaded_file($_FILES["photo"]["tmp_name"], "../slike/proizvodi/". $file_name);
				endif;

		else:
			echo "Problem: " . $_FILES["photo"]["error"];
		endif;
	endif;

	$podaci = $con->prepare("insert into proizvod (naziv, k_opis, cijena, kategorija) values (:nazivproizvoda, :kratkiopis, :cijena, :kategorija);");
	$podaci->bindParam(":nazivproizvoda", $_POST["nazivproizvoda"]);
	$podaci->bindParam(":kratkiopis", $_POST["kratkiopis"]);
	$podaci->bindParam(":cijena", $_POST["cijena"]);
	$podaci->bindParam(":kategorija", $_POST["kategorija"]);
	$podaci->execute();
	$id=$con->lastInsertId();
	
	$naslovna = $con->prepare("insert into galerija (proizvod, naslovna) values (:p, :photo)");
	$naslovna->bindParam(":p", $id);
	$naslovna->bindParam(":photo", $file_name);
	$naslovna->execute();
		header("location: izborneSlike.php?p=$id");
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
	<h1 class="naslov">DODAJ PROIZVOD</h1>
	</div>
</div>
<div class="row">
<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">

<div class="prijava">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
	<p>Naziv proizvoda</p>
	<input class="log" type="text" id="nazivproizvoda" name="nazivproizvoda" placeholder="Naziv proizvoda" />
	<p>Kratki opis</p>
	<textarea class="log1" type="text" id="kratkiopis" name="kratkiopis" placeholder="Opis" rows="10"></textarea>
	<p>Cijena</p>
	<input class="log" type="text" id="cijena" name="cijena" placeholder="Cijena" />
	<p>Kategorija</p>
	<select class="log" id="kategorija" name="kategorija">
		<option value="Mliječni proizvodi"> Mliječni proizvodi </option>
		<option value="Alkoholna pića"> Alkoholna pića </option>
		<option value="Bezalkoholni napitci"> Bezalkoholni napitci </option>
		<option value="Voće"> Voće </option>
		<option value="Povrće"> Povrće </option>
		<option value="Pčelarski proizvodi"> Pčelarski proizvodi </option>
		<option value="Gljive"> Gljive </option>
		<option value="Ribarstvo"> Ribarstvo </option>
		<option value="Prirodna kozmetika"> Prirodna kozmetika </option>
	</select>
	<p> Naslovna slika proizvoda </p>
	<input class="log" type="file" id="photo" name="photo" class="btn btn-default"/>
	<?php if($_GET["err"] && $_GET["err"]==1):?>
		<p> Slika mora biti ispod 2MB veličine </p>
	<?php endif;?>
	<input type="submit" id="dodaj_proizvod" name="submit" class="btn btn-default" value="Dodaj proizvod" />
</form>
</div>
</div>
</div>

<?php include "../js/skripte.php";?>

<script>
	$("#dodaj_proizvod").click(function(){
		var naziv = $("#nazivproizvoda").val();
		var opis = $("#kratkiopis").val();
		var cijena = $("#cijena").val();
		var kat = $("#kategorija").val();
		var slika = $("#photo").val();
		
		if(!naziv || !opis || !cijena || !kat || !slika){
			alert("Sva polja moraju biti ispunjena");
			return false;
		};
		if (!slika.match(/(?:gif|jpg|png|bmp)$/)) {
			alert("Dodana datoteka nije slika!");
			return false;
		};
	})
</script>

<?php 	
include_once '../footer.php'; 
?>


</body>
</html>