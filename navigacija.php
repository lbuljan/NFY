

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
     
      <li class="navbar-text"><a href="<?php echo $put ?>index.php"><button class="btn2 btn-default"><img src="<?php echo $put ?>slike/malilogo.png" style="max-height:20px;" /></button></a></li>
   
    </ul>

    <!-- Right nav -->
    <ul class="nav navbar-nav navbar-right">
	<?php if(!isset($_SESSION["operater"])):?>
     <li class="navbar-text"><a href="<?php echo $put ?>user/formaPrijava.php"><button class="btn2 btn-default"> Prijava</button></a></li>
      <li class="navbar-text"><a href="<?php echo $put ?>user/formaRegistracijaKorisnik.php"><button class="btn2 btn-default">Registracija kao korisnik</button></a></li>
     <li class="navbar-text"> <a href="<?php echo $put ?>user/formaRegistracijaOpg.php"><button class="btn2 btn-default">Registracija kao OPG</button></a></li>
	<?php else:?>
	 <li class="navbar-text"><a href="<?php echo $put ?>user/profil.php"> <button class="btn2 btn-default">Profil</button></a></li>
      <li class="navbar-text"><a href="<?php echo $put ?>odjava.php"><button class="btn2 btn-default">Odjava</button></a></li>
	<?php endif;?>
    
    </ul>

  </div><!--/.nav-collapse -->
</div>