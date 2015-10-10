<?php 	include_once '../konfiguracija.php';  ?>
<?php
if($_POST):
	$limit=count($_FILES["slika"]["name"]);
	$br=0;
	$dir="../slike/proizvodi/";
	foreach($_FILES["slika"] as $key=>$tmp_name):
		if($br<=$limit-1):
			//echo $_FILES["slika"]["name"][$br];
			$valid=true;
			$file_name=$_SESSION["operater"]->sifra . "_" . substr($_FILES["slika"]["name"][$br], -8);
			if($_FILES["slika"]["size"][$br] > (3096000)):
				$valid=false;
				header("location: izborneSlike.php?err=1");
			endif;
				if($valid):
					move_uploaded_file($_FILES["slika"]["tmp_name"][$br], $dir . $file_name);
				endif;
			$update = $con->prepare("update galerija set slika" . $br ."=" . $file_name ." where proizvod=:p;");
			$update->bindParam(":p", $_GET["p"]);
			$update->execute();
			$br++;
		endif;
	endforeach;
	
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
	<h1 class="login">DODAJ PROIZVOD</h1>
</div>
<div class="row">

<div class="col-md-9 col-md-push-2 korisnik" >

<div class="prijava">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
	<input class="log" type="file" id="slika" name="slika[]" multiple/>
	<input type="submit" id="dodaj_slike" name="submit" class="btn btn-default" value="Dodaj slike" />
	<button class="btn btn-primary"><a style="color: white;" href="proizvod.php?p=<?php echo $_GET["p"];?>"> Preskoči </a></button>
	<?php if($_GET["err"] && $_GET["err"]==1):?>
		<p> Slika mora biti ispod 2MB veličine </p>
	<?php endif;?>
</form>
</div>
</div>
</div>

<?php include "../js/skripte.php";?>

<script>
	$("#dodaj_slike").click(function(){
		var slika = $("#slika").val();
		
		if(!slika){
			alert("Nije odabrana nijedna slika");
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