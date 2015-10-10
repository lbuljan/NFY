<?php include_once 'konfiguracija.php';  ?>
<?php
	
	$products = $con->prepare("select * from proizvod inner join galerija on galerija.proizvod=proizvod.sifra order by RAND() limit 5;");
	$products->execute();
	$proizvodi = $products->fetchAll(PDO::FETCH_OBJ);

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
  

<div class="col-md-9 col-md-push-3">
<div id="myCarousel" class="carousel slide" data-ride="carousel">

  <div class="carousel-inner" role="listbox">
  <?php foreach($proizvodi as $pr):?>
    <div class="item">
      <img src="<?php echo $put;?>slike/proizvodi/<?php echo $pr->naslovna;?>" alt="<?php echo $pr->naziv;?>">
      
        <p><?php echo $pr->naziv;?></p>
		<p><?php echo $pr->cijena;?></p>
		<p><?php echo $pr->kolicina;?></p>
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

  




</div>
<div class="row">
  <h1>Proizvođači</h1>
  <div class="col-md-4 ">
    <img src="slike/Untitled-6.jpg" />
    <h2><span>Domaće maline</span></h2>
  </div>

  <div class="col-md-4">
    <img src="slike/Untitled-7.jpg" />
    <h2><span>Med "Stojanović"</span></h2>
  </div>

  <div class="col-md-4">
    <img src="slike/Untitled-8.jpg" />
    <h2><span>Crno grožđe "Jurić"</span></h2>
  </div>




</div>

<div class="row">

  <div class="col-md-4">
    <img src="slike/Untitled-6.jpg" />
    <h2><span>Domaće maline</span></h2>
  </div>

  <div class="col-md-4">
    <img src="slike/Untitled-7.jpg" />
    <h2><span>Med "Stojanović"</span></h2>
  </div>

  <div class="col-md-4">
    <img src="slike/Untitled-8.jpg" />
    <h2><span>Crno grožđe "Jurić"</span></h2>
  </div>
</div>



<div class="col-md-3"></div>


	</body>
</html>