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


<h1 class="login">REGISTRIRAJ SE KAO OPG</h1>
<div class="prijava">
<form action="user/registracija.php" method="POST">
	<input class="log" type="text" id="naziv" name="naziv" placeholder="Naziv OPG-a*" />
	<input class="log" type="text" id="adresa" name="adresa" placeholder="Adresa*" />
	<input class="log" type="text" id="grad" name="grad" placeholder="Grad*" />
	<input class="log" type="text" id="postanskibroj" name="postanskibroj" placeholder="Poštanski broj*" />
	<input class="log" type="text" id="email" name="email" placeholder="E-Mail*" />
	<input class="log" type="password" id="lozinka" name="lozinka" placeholder="Lozinka*" />
	<input class="log" type="password" id="ponovolozinka" name="ponovolozinka" placeholder="Ponovi lozinku*" />
	<input class="log" type="text" id="ziro_racun" name="ziro_racun" placeholder="Žiro račun" />
	<input class="log" type="text" id="paypal" name="paypal" placeholder="PayPal račun" /><br />
	<button class="btn1 btn-default" id="prijavi" type="submit" style="margin-top:10px;margin-bottom:20px"> Registriraj se! </button>
</form>
</div>
<div class="registriraj">
Već ste registrirani? <br/>
<button class="btn1 btn-default" id="prijavi" type="submit" style="margin-top:15px;margin-bottom:20px;"><a href="<?php echo $put ?>user/formaPrijava.php" style="color:#d6d6d5;text-decoration:none;">Prijavi se!</a></button>
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