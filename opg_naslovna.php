<?php 	include_once 'konfiguracija.php';  ?>
<?php

$opg = $con->prepare("select * from opg limit 15");
$opg->execute();
$opgi = $opg->fetchAll(PDO::FETCH_OBJ);
?>
<!doctype html>
<html>
<head>
	<?php 	include_once 'head.php';  ?>
	</head>
<body>
	
	<?php 	
	include_once 'navigacija.php'; 
	 ?>



<div class="row" >
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h1 class="naslov"> Obiteljska poljoprivredna gospodarstva </h1>
		<hr style="border-color:black;width:80%;" />
	</div>
	<?php foreach($opgi as $op):?>
	
		<div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-10 col-xs-offset-2 pro">
		<a href="<?php echo $put;?>user/profil/opg.php?o=<?php echo $op->sifra;?>" class="proizvodi">
		  
			<?php if($op->profilna):?>
				<img class="proizvodi_slika" src="<?php echo $put ?>slike/opg/<?php echo $op->profilna;?>" />
			<?php else:?>
				<img class="proizvodi_slika" src="<?php echo $put ?>slike/opg/placeholder.png" />
			<?php endif;?>
		
		<h2><span><?php echo $op->naziv;?></span></h2></a>
	  </div>
  <?php endforeach;?>
</div>

<?php 	
include_once 'footer.php'; 
?>


</body>
</html>