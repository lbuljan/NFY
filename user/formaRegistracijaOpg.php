<?php 	include_once '../konfiguracija.php';  ?>
<?php
if($_POST):
	$provjeri = $con->prepare("select * from opg where email=:email or naziv=:naziv;");
	$provjeri->bindParam(":email", $_POST["email"]);
	$provjeri->bindParam(":naziv", $_POST["naziv"]);
	$provjeri->execute();
	$check = $provjeri->fetchAll(PDO::FETCH_OBJ);
	if($check==NULL):
		$provjeri = $con->prepare("select * from korisnik where email=:email");
		$provjeri->bindParam(":email", $_POST["email"]);
		$provjeri->execute();
		$check2 = $provjeri->fetchAll(PDO::FETCH_OBJ);
		if($check2==NULL):
			$registriraj = $con->prepare("insert into opg(naziv, adresa, grad, post_broj, email, lozinka, ziro, paypal) values (:naziv, :adresa, :grad, :postanskibroj, :email, :lozinka, :ziro, :paypal);");
			$registriraj->bindParam(":email", $_POST["email"]);
			$registriraj->bindParam(":lozinka", md5($_POST["lozinka"]));
			$registriraj->bindParam(":naziv", $_POST["naziv"]);
			$registriraj->bindParam(":adresa", $_POST["adresa"]);
			$registriraj->bindParam(":grad", $_POST["grad"]);
			$registriraj->bindParam(":postanskibroj", $_POST["postanskibroj"]);
			$registriraj->bindParam(":ziro", $_POST["ziro_racun"]);
			$registriraj->bindParam(":paypal", $_POST["paypal"]);
			$registriraj->execute();

				header("location: formaPrijava.php");
		else:
			header("location: formaRegistracijaOpg.php?err=1");
		endif;
	else:
		header("location: formaRegistracijaOpg.php?err=1");
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


<h1 class="login">REGISTRIRAJ SE KAO OPG</h1>
<div class="prijava">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
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
<?php if($_GET["err"] && $_GET["err"]==1):?>
	<p> E-mail je već u upotrebi </p>
<?php endif;?>
</div>
<div class="registriraj">
Već ste registrirani? <br/>
<button class="btn1 btn-default" id="prijavi" type="submit" style="margin-top:15px;margin-bottom:20px;"><a href="<?php echo $put ?>user/formaPrijava.php" style="color:#d6d6d5;text-decoration:none;">Prijavi se!</a></button>
</div>

<?php include "../js/skripte.php";?>

<script>
	$("#prijavi").click(function(){
		
		var naziv = $("#naziv").val();
		var adresa =$("#adresa").val();
		var grad = $("#grad").val();
		var pbroj = $("#postanskibroj").val();
		var email=$("#email").val();
		var lozinka=$("#lozinka").val();
		var potvrdi=$("#ponovolozinka").val();
		
		if(!naziv || !adresa || !grad || !pbroj || !email || !lozinka || !potvrdi){
			alert("Polja označena sa zvjezdicom moraju biti ispunjena");
			return false;
		}
		if(lozinka != potvrdi){
			alert("Lozinka se ne podudara s ponovljenom lozinkom");
			return false;
		}
		if($.isNumeric(pbroj)){} 
			else {
				alert("Poštanski broj mora biti brojčana vrijednost");
				return false;
			}
	})
</script>

<?php 	
include_once '../footer.php'; 
?>


</body>
</html>