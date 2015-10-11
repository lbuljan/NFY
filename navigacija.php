

<?php   include_once 'head.php';  ?>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

  </div>
  <div class="navbar-collapse collapse">

    <!-- Left nav -->
    <ul class="nav navbar-nav">
     
      <li class="navbar-text"><a href="<?php echo $put ?>index.php"><button class="btn2 btn-default"><img src="<?php echo $put ?>slike/malilogo.png" style="max-height:20px;" />

      </button></a></li>

       <li class="navbar-text"><a href="<?php echo $put ?>proizvodi/index.php"><button class="btn2 btn-default">Proizvodi</button></a></li>
       <li class="navbar-text"><a href="<?php echo $put ?>opg_naslovna.php"><button class="btn2 btn-default">OPG</button></a></li>
   
    </ul>

    <!-- Right nav -->
    <ul class="nav navbar-nav navbar-right">
        <li class="navbar-text"><button type="button" class="btn2 btn-default" data-toggle="modal" data-target="#pretraga">
      <img src="<?php echo $put; ?>slike/search.png" style="max-width:20px;">
   </button></li>
	<?php if(!isset($_SESSION["operater"])):?>

     <li class="navbar-text"><a href="<?php echo $put ?>user/formaPrijava.php"><button class="btn2 btn-default"> Prijava</button></a></li>
      <li class="navbar-text"><a href="<?php echo $put ?>user/formaRegistracijaKorisnik.php"><button class="btn2 btn-default">Registracija kao korisnik</button></a></li>
     <li class="navbar-text"> <a href="<?php echo $put ?>user/formaRegistracijaOpg.php"><button class="btn2 btn-default">Registracija kao OPG</button></a></li>

  <?php else:?>
	<?php if(isset($_SESSION["operater"]->ime)):?>
		<li class="navbar-text"><a href="<?php echo $put ?>user/profil.php"> <button class="btn2 btn-default">Profil</button></a></li>
		<li class="navbar-text"><button type="button" class="btn2 btn-default" data-toggle="modal" data-target="#myModal">Košarica</button></li>
     <?php endif;?>
	 <?php if(isset($_SESSION["operater"]->naziv)):?>
		<li class="navbar-text"><a href="<?php echo $put ?>user/opg.php"> <button class="btn2 btn-default">Profil</button></a></li>
	 <?php endif;?>
	 <li class="navbar-text"><a href="<?php echo $put ?>odjava.php"><button class="btn2 btn-default">Odjava</button></a></li>
	<?php endif;?>
    
    </ul>

  </div><!--/.nav-collapse -->
</div>

<?php

		$kupljeno = $con->prepare("select * from proizvod inner join kor_pr on proizvod.sifra=kor_pr.proizvod where kor_pr.korisnik=:s");
		$kupljeno->bindParam(":s", $_SESSION["operater"]->sifra);
		$kupljeno->execute();
		$history = $kupljeno->fetchAll(PDO::FETCH_OBJ);
		
		print_r($history);
?>	

<!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Košarica</h4>
      </div>
      <div class="modal-body">
	  <?php foreach($history as $hs):
		$slike = $con->prepare("select naslovna from galerija where proizvod=:p");
		$slike->bindParam(":p", $hs->sifra);
		$slike->execute();
		$pic = $slike->fetch(PDO::FETCH_OBJ);
	  ?>
			<div class="col-xs-12">
				<div class="col-xs-3">
					<img style="height: 90%; width: 90%;" src="<?php echo $put;?>slike/proizvodi/<?php echo $hs->naslovna;?>" alt="Naslovna proizvoda <?php echo $hs->naziv;?>" />
				</div>
				<div class="col-xs-6">
					<strong> <?php echo $hs->naziv;?> </strong> <small> <?php echo $hs->kolicina;?> </small>
				</div>
				<div class="col-xs-3">
					<?php $cijena = $hs->cijena * $hs->kolicina;?>
					<p> <?php echo $cijena;?> </p>
				</div>
			</div>
		<?php endforeach;?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
      </div>
    </div>

  </div>
</div>


<div id="pretraga" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pretraga</h4>
      </div>
      <div class="modal-body">
        <input type="text" class="log2">
        <br />
        <button type="button" class="btn btn-default" style="margin-left:10px;">Pretraži</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
      </div>
    </div>

  </div>
</div>