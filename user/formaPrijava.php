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

<h1 class="login">LOGIN</h1>
<div class="prijava">
<form action="<?php echo $put;?>user/prijava.php" method="POST">
	<input class="log" type="text" id="email" name="email" placeholder="Vaš e-mail" /><br />
	<input class="log" type="password" id="lozinka" name="lozinka" placeholder="Lozinka" /><br />
	<?php if(isset($_GET["err"]) && $_GET["err"]==1):?>
		<p> Neispravan e-mail ili lozinka </p>
	<?php endif; ?>
	<button class="btn1 btn-default" id="prijavi" type="submit" style="margin-top:10px;margin-bottom:20px"> Prijavi </button><br />
	<a href="" style="text-decoration:underline;color:black;">Zaboravili ste lozinku?</a>
	
</form>
</div>





</body>
</html>