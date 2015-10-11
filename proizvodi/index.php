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

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1 class="naslov"> Proizvodi </h1>
			<hr style="border-color:black;width:80%;" />
	</div>
		<?php foreach($proizvod as $pr):?>
		
		 <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-10 col-xs-offset-2 pro">
			<a href="<?php echo $put;?>proizvodi/proizvod.php?p=<?php echo $pr->sifra;?>" class="proizvodi">
			  
					<img class="proizvodi_slika" src="<?php echo $put ?>slike/proizvodi/<?php echo $pr->naslovna;?>" />
			
			
		<h2><span><?php echo $pr->naziv;?></span></h2></a>	
	  </div>
	  <?php endforeach;?>
	
	
</div>

<?php 	
include_once '../footer.php'; 
?>


</body>
</html>