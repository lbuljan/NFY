<?php 	include_once 'konfiguracija.php';  ?>


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
	<div class="col-md-10 col-md-push-1">
		<h1> Obiteljska poljoprivredna gospodarstva </h1>
		<hr style="border-color:black;" />
	</div>

	
		 <div class="col-lg-4 col-md-4 col-md-push-1 col-sm-4 col-xs-10 col-xs-push-4 proizvodi">
	<a href="">
	  
			<img class="proizvodi_slika" src="<?php echo $put ?>slike/opg/placeholder.png" />
	
	
	</a>
    <h2><span>Naziv</span></h2>
  </div>
</div>

<?php 	
include_once 'footer.php'; 
?>


</body>
</html>