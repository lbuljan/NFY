<?php 	include_once '../konfiguracija.php';  ?>
<?php

$prod = $con->prepare("select * from proizvod inner join galerija on galerija.proizvod=proizvod.sifra limit 15");
$prod->execute();
$proizvod = $prod->fetchAll(PDO::FETCH_OBJ);

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
	<div class="col-xs-12">
		<div class="col-md-12">
			<h1> Proizvodi </h1>
			<hr style="border-color:black;" />
		</div>
		<div class="col-xs-12">
		<?php foreach($proizvod as $pr):?>
		
		<div class="col-lg-4 col-md-4 col-md-push-1 col-sm-4 col-xs-10 col-xs-push-4 proizvodi">
			<a href="<?php echo $put;?>proizvodi/proizvod.php?p=<?php echo $pr->sifra;?>">
			  
					<img class="proizvodi_slika" src="<?php echo $put ?>slike/proizvodi/<?php echo $pr->naslovna;?>" />
			
			</a>	
		<h2><span><?php echo $pr->naziv;?></span></h2>
	  </div>
	  <?php endforeach;?>
	  </div>
	</div>
</div>

<?php 	
include_once '../footer.php'; 
?>


</body>
</html>