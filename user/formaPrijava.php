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
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h1 class="naslov">PRIJAVA</h1>
	</div>
</div>
<div class="row">


<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
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
</div>
</div>






</body>
</html>