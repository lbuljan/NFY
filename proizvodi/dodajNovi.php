<?php 	include_once '../konfiguracija.php';  ?>
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

<div class="col-md-8 col-md-push-4" >
<h1 class="login">Dodaj proizvod</h1>
<div class="prijava">
<form action="user/registracija.php" method="POST">
	<p>Naziv proizvoda*</p>
	<input class="log" type="text" id="nazivproizvoda" name="nazivproizvoda" placeholder="Naziv proizvoda" />
	<p>Kratki opis*</p>
	<textarea class="log1" type="text" id="kratkiopis" name="kratkiopis" placeholder="Opis" rows="10"></textarea>
	<p>Cijena</p>
	<input class="log" type="text" id="cijena" name="cijena" placeholder="Cijena" />
	<p>Kategorija</p>
	<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Izaberi kategoriju
  <span class="caret"></span></button>
  <ul class="dropdown-menu dropdownkat">
    <li><a href="#">Mliječni proizvodi</a></li>
    <li><a href="#">Alkohol</a></li>
    <li><a href="#">Voće</a></li>
    <li><a href="#">Povrće</a></li>
    <li><a href="#">Pčelarski proizvodi</a></li>
    <li><a href="#">Bezalkoholni napitci</a></li>
    <li><a href="#">Ribarstvo</a></li>
    <li><a href="#">Gljive</a></li>
  </ul>
</div>
<label class="control-label">Dodaj sliku</label>
  <div style="position:relative;">
		<a class='btn btn-primary' href='javascript:;'>
			Choose File...
			<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
		</a>
		&nbsp;
		<span class='label label-info' id="upload-file-info"></span>
	</div>


	<br />
	
	<button class="btn1 btn-default" id="prijavi" type="submit" style="margin-top:10px;margin-bottom:20px"> Dodaj! </button>
</form>
</div>
</div>
</div>

<?php include "../js/skripte.php";?>

<script>
	$("#prijavi").click(function(){
		
		var email=$("#email").val();
		var accName=$("#accName").val();
		var lozinka=$("#lozinka").val();
		var potvrdilozinku=$("#potvrdilozinku").val();
		var ziro_racun = $("#ziro_racun").val();
		
		if(email == "" || accName=="" || lozinka=="" || potvrdilozinku==""){
			alert("Polja označena sa zvjezdicom moraju biti ispunjena");
			return false;
		}
		if(lozinka != potvrdilozinku){
			alert("Lozinka se ne podudara s ponovljenom lozinkom");
			return false;
		}		
	})
</script>

<?php 	
include_once '../footer.php'; 
?>


</body>
</html>