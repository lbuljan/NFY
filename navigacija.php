

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
     
      <li><a href="<?php echo $put ?>index.php">Početna</a></li>
   
    </ul>

    <!-- Right nav -->
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo $put ?>user/formaPrijava.php">Prijava</a></li>
      <li><a href="<?php echo $put ?>user/formaRegistracijaKorisnik.php">Registracija kao korisnik</a></li>
      <li><a href="<?php echo $put ?>user/formaRegistracijaOpg.php">Registracija kao OPG</a></li>

    
    </ul>

  </div><!--/.nav-collapse -->
</div>