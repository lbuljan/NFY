<?php 


include_once 'konfiguracija.php';  ?>
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
	<img src="<?php echo $put ?>slike/header.png" style="max-width:100%" />

<div class="row">
  <h1 style="text-align:center;">Proizvodi</h1>
</div>

<div class="row slider">


	<div class="col-lg-7 col-lg-offset-3 col-md-7 col-md-offset-3 col-sm-9 col-sm-offset-2 col-xs-10 col-xs-offset-2">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">

		  <div class="carousel-inner" role="listbox">
		  <?php foreach($proizvodi as $prod):?>
			<div class="item <?php echo $prod->sifra;?><?php if($prod->sifra==1): echo " active"; endif;?>">
				<a href="<?php echo $put;?>proizvodi/proizvod.php?p=<?php echo $prod->sifra;?>">
				  <img src="<?php echo $put;?>slike/proizvodi/<?php echo $prod->naslovna;?>" alt="<?php echo $prod->naziv;?>" class="img-responsive">
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
  <h1 style="text-align:center;">Proizvođači</h1><br />
  <?php foreach($maker as $mk):?>
 <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-10 col-xs-offset-2 pro">
	<a href="user/opg.php?o=<?php echo $mk->sifra;?>" class="proizvodi">
	  <?php if($mk->profilna):?>
			<img class="opg_slika" src="slike/opg/<?php echo $mk->profilna;?>" />
		<?php else:?>
			<img class="opg_slika" src="slike/opg/placeholder.png" alt="Placeholder <?php echo $mk->naziv;?>"/>
	  <?php endif;?>
	
    <h2><span><?php echo $mk->naziv;?></span></h2></a>
  </div>
  <?php endforeach;?>
</div>

<?php include_once 'footer.php'; ?>
	</body>
</html>