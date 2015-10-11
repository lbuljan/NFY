
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
        <li class="navbar-text"><button type="button" class="btn2 btn-default" data-toggle="modal" data-target="#pretraga" style="margin-top:6px;">
      <img src="<?php echo $put; ?>slike/search.png" style="max-width:20px;">
   </button></li>
	<?php if(!isset($_SESSION["operater"])):?>

     <li class="navbar-text"><a href="<?php echo $put ?>user/formaPrijava.php"><button class="btn2 btn-default"> Prijava</button></a></li>
      <li class="navbar-text"><a href="<?php echo $put ?>user/formaRegistracijaKorisnik.php"><button class="btn2 btn-default">Registracija kao korisnik</button></a></li>
     <li class="navbar-text"> <a href="<?php echo $put ?>user/formaRegistracijaOpg.php"><button class="btn2 btn-default">Registracija kao OPG</button></a></li>

  <?php else:?>
	<?php if(isset($_SESSION["operater"]->ime)):?>
		<li class="navbar-text"><button type="button" class="btn2 btn-default" data-toggle="modal" data-target="#myModal" style="margin-top:6px;"><img src="<?php echo $put; ?>slike/kolica.png"</button></li>
        <li class="navbar-text"><a href="<?php echo $put ?>user/profil.php"> <button class="btn2 btn-default">Profil</button></a></li>
     <?php endif;?>
	 <?php if(isset($_SESSION["operater"]->naziv)):?>
		<li class="navbar-text"><a href="<?php echo $put ?>user/opg.php"> <button class="btn2 btn-default">Profil</button></a></li>
	 <?php endif;?>
	 <li class="navbar-text"><a href="<?php echo $put ?>odjava.php"><button class="btn2 btn-default">Odjava</button></a></li>
	<?php endif;?>
    
    </ul>

  </div><!--/.nav-collapse -->
</div>
	

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
	  <?php 
		$history = $con->prepare("select * from kor_pr inner join proizvod on kor_pr.proizvod=proizvod.sifra where korisnik=:k and potvrdi=0");
		$history->bindParam(":k", $_SESSION["operater"]->sifra);
		$history->execute();
		$kupljeno = $history->fetchAll(PDO::FETCH_OBJ);
		
	  ?>
	  <?php foreach($kupljeno as $hs):
		$slike = $con->prepare("select naslovna from galerija where proizvod=:p");
		$slike->bindParam(":p", $hs->sifra);
		$slike->execute();
		$pic = $slike->fetch(PDO::FETCH_OBJ);
	  ?>
			<div class="remove_<?php echo $hs->sifra;?>">
			<div class="col-xs-12">
				<div class="col-xs-3">
					<img style="height: 90%; width: 90%;" src="<?php echo $put;?>slike/proizvodi/<?php echo $pic->naslovna;?>" alt="Naslovna proizvoda <?php echo $hs->naziv;?>" />
				</div>
				<div class="col-xs-9">
					<div class="row">
						<div class="col-xs-12" style="font-size:15px;">
							<strong> <?php echo $hs->naziv;?> </strong> 
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12" style="font-size:15px;">
								<?php $cijena = $hs->cijena * $hs->kolicina;?>
								<div style="float:left;" style="font-size:15px;">
									<p> Cijena:  </p><h1><?php echo $cijena;?>kn</h1>
									<p> Količina: <?php echo $hs->kolicina;?> </p>
								</div>
								<div style="float:right;" style="font-size:15px;">
									<button type="submit" class="btn-default potvrdi" id="kupnja_<?php echo $hs->sifra;?>"> Potvrdi </button>
									<button type="submit" class="btn-default obrisi" id="brisi_<?php echo $hs->sifra;?>"> Ukloni </button>
								</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		<?php endforeach;?>
      </div>
      <div class="row">
      <div class="col-xs-12">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        </div>
        </div>
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

<script>
	$(".potvrdi").click(function(){
		var potvrdi = $(this);
		var proizvod = $(".potvrdi").attr("id").split("_")[1];
		$.ajax({
      			type: 'POST',
      			url: "<?php echo $put;?>potvrdiBasket.php",
      			data: "p=" + proizvod,
      			dataType: 'text'
    			}).done(function(rezultat) {
    				
        			if(rezultat=="OK"){
        				
        				alert("Proizvod kupljen!");
   						potvrdi.parent().parent().parent().parent().parent().remove();
   					}else{
   						alert(rezultat);
   					}
    			}); 
	});
	$(".obrisi").click(function(){
		var potvrdi = $(this);
		var proizvod = $(".potvrdi").attr("id").split("_")[1];
		$.ajax({
      			type: 'POST',
      			url: "<?php echo $put;?>ukloniBasket.php",
      			data: "p=" + proizvod,
      			dataType: 'text'
    			}).done(function(rezultat) {
    				
        			if(rezultat=="OK"){
        				
        				alert("Proizvod uklonjen.");
   						potvrdi.parent().parent().parent().parent().parent().remove();
   					}else{
   						alert(rezultat);
   					}
    			}); 
	});
</script>