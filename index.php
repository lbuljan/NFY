<?php include_once 'konfiguracija.php';  ?>
<?php
	
	$products = $con->prepare("select * from proizvod inner join galerija on galerija.proizvod=proizvod.sifra order by RAND() limit 5;");
	$products->execute();
	$proizvodi = $products->fetchAll(PDO::FETCH_OBJ);
	
	$opg = $con->prepare("select * from opg order by RAND() limit 6; ");
	$opg->execute();
	$maker = $opg->fetchAll(PDO::FETCH_OBJ);

?>
<!doctype html>
<html>
	<head>
		<?php 	include_once 'head.php';  ?>
	</head>
	
	<body>
	<?php include_once 'navigacija.php'; ?>

<div class="row">
  <h1>Proizvodi</h1>
</div>

<div class="row slider">


	<div class="col-lg-7 col-lg-push-3 col-md-7 col-md-push-3 col-sm-9 col-sm-push-2 col-xs-12 col-xs-push-1">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">

		  <div class="carousel-inner" role="listbox">
		  <?php foreach($proizvodi as $prod):?>
			<div class="item <?php echo $prod->sifra;?><?php if($prod->sifra==1): echo " active"; endif;?>">
				<a href="<?php echo $put;?>proizvod/proizvod.php?p=<?php echo $prod->sifra;?>">
				  <img src="<?php echo $put;?>slike/proizvodi/<?php echo $prod->naslovna;?>" alt="<?php echo $prod->naziv;?> class="img-responsive"">
				</a>
					<p><?php echo $prod->naziv;?> </p>
				
			</div>
		<?php endforeach;?>
		  </div>


		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
		</div>
	</div>
</div>

<div class="row">
  <h1>Proizvođači</h1><br />
  <?php foreach($maker as $mk):?>
  <div class="col-lg-4 col-md-4 col-md-push-1 col-sm-4 col-xs-10 col-xs-push-4 proizvodi">
	<a href="user/profil.php?o=<?php echo $mk->sifra;?>">
	  <?php if($mk->profilna):?>
			<img class="opg_slika" src="slike/opg/<?php echo $mk->profilna;?>" />
		<?php else:?>
			<img class="opg_slika" src="slike/opg/placeholder.png" alt="Placeholder <?php echo $mk->naziv;?>"/>
	  <?php endif;?>
	</a>
    <h2><span><?php echo $mk->naziv;?></span></h2>
  </div>
  <?php endforeach;?>
</div>

<?php include_once 'footer.php'; ?>
	</body>
</html>