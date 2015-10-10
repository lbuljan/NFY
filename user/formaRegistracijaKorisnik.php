<?php 	include_once '../konfiguracija.php';  ?>

<?php

if($_POST):
	$registriraj = $con->prepare("insert into korisnik(ime, prezime, adresa, grad, post_broj, email, lozinka, ziro, paypal) values (:ime, :prezime, :adresa, :grad, :postanskibroj, :email, :lozinka, :ziro, :paypal);");
	$registriraj->bindParam(":email", $_POST["email"]);
	$registriraj->bindParam(":lozinka", md5($_POST["lozinka"]));
	$registriraj->bindParam(":ime", $_POST["ime"]);
	$registriraj->bindParam(":prezime", $_POST["prezime"]);
	$registriraj->bindParam(":adresa", $_POST["adresa"]);
	$registriraj->bindParam(":grad", $_POST["grad"]);
	$registriraj->bindParam(":post_broj", $_POST["post_broj"]);
	$registriraj->bindParam(":ziro", $_POST["ziro"]);
	$registriraj->bindParam(":paypal", $_POST["paypal"]);
	$registriraj->execute();
	
	$id=$con->lastInsertId();
	//preusmjeri na korisnikovu stranicu profila
		header("location: profil.php?u=$id");
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


<h1 class="login">REGISTRIRAJ SE KAO KORISNIK</h1>
<div class="prijava">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
	<input class="log" type="text" id="ime" name="ime" placeholder="Ime*" />
	<input class="log" type="text" id="prezime" name="prezime" placeholder="Prezime*" />
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
		
		var ime = $("#ime").val();
		var prezime = $("#prezime").val();
		var adresa =$("#adresa").val();
		var grad = $("#grad").val();
		var pbroj = $("#postanskibroj").val();
		var email=$("#email").val();
		var lozinka=$("#lozinka").val();
		var potvrdi=$("#ponovolozinka").val();
		
		if(!ime || !prezime || !adresa || !grad || !pbroj || !email || !lozinka || !potvrdi){
			alert("Polja označena sa zvjezdicom moraju biti ispunjena");
			return false;
		}
		if(lozinka != potvrdi){
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