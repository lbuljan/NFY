<?php 	include_once '../konfiguracija.php';  ?>
<?php 

	$proizvod = $con->prepare("select * from proizvod inner join galerija on galerija.proizvod=proizvod.sifra where proizvod.sifra=:p ");
	$proizvod->bindParam(":p", $_GET["p"]);
	$proizvod->execute();
	$prod = $proizvod->fetch(PDO::FETCH_OBJ);
	
	$opg = $con->prepare("select * from opg inner join opg_pr on opg.sifra=opg_pr.opg where opg_pr.proizvod = :p");
	$opg->bindParam(":p", $_GET["p"]);
	$opg->execute();
	$tko = $opg->fetch(PDO::FETCH_OBJ);
	
	$komentar = $con->prepare("select * from komentar where proizvod=:p");
	$komentar->bindParam(":p", $_GET["p"]);
	$komentar->execute();
	$komentari = $komentar->fetchAll(PDO::FETCH_OBJ);
	
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

	 <input type="hidden" id="proizvod" value="<?php echo $_GET["p"];?>"/>

	<div class="row profil">
		<div class="col-lg-4 col-md-4 col-md-push-1 col-sm-4 col-sm-push-1 col-xs-10 col-xs-push-1">
			<h1> <?php echo $prod->naziv;?> <small style="font-size: 0.5em; margin-left: 5%;"><?php echo $prod->kategorija;?></small> <hr/> <h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-10 col-md-10 col-md-push-1 col-sm-10 col-sm-push-1 col-xs-10 col-xs-push-1">
			<div class="col-md-6 col-sm-7" style="text-align: center; line-height: 40px;">
				<div class="row">
						<div class="col-xs-12">
							<img  style="float: left; height: 20px; width: 15px;margin-right:5px" src="<?php echo $put;?>slike/cijena.png" alt="Cijena:" />
							<p style="font-size: 30px; float:left;margin-top:-10px;"> <?php echo $prod->cijena;?>kn  kom/kg</p>
						</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-6" style="text-align: left;">
						<img style="height: 20px; width: 20px;margin-top:-5px" src="<?php echo $put;?>slike/email.png" alt="E-mail:"/>
						<a href="mailto:<?php echo $tko->email;?>" style="font-size: 1.3em; color: black; text-decoration: none;"> <?php echo $tko->email;?> </a>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-6" style="text-align: center;">
						<img style="height: 20px; width: 20px;" src="<?php echo $put;?>slike/user.png" alt="OPG:" />
						<a href="<?php echo $put;?>user/opg.php?o=<?php echo $tko->sifra;?>" style="font-size: 1.3em; color: black; text-decoration: none;"> <?php echo $tko->naziv;?> </a>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<img  style="float:left;height: 25px;margin-top:10px;" src="<?php echo $put;?>slike/lokacija.png" alt="Lokacija:" />
						<p style="font-size: 1.5em;float:left;margin-left:10px;"> <?php echo $tko->adresa;?> <br /> <?php echo $tko->grad . ", " . $tko->post_broj;?>  </p>
					</div>
				</div>
			</div>
			
			<div class="col-md-5 col-sm-4 col-xs-10 col-xs-offset-1">

				<div id="myCarousel" class="carousel slide" data-ride="carousel">

				  <div class="carousel-inner" role="listbox">
				  
					<div class="item active">
						  <img src="<?php echo $put ?>slike/proizvodi/<?php echo $prod->naslovna;?>" alt="Naslovna <?php echo $prod->naziv;?>" class="img-responsive">					
					</div>
					<?php if($prod->slika0):?>
						<div class="item">
							  <img src="<?php echo $put ?>slike/proizvodi/<?php echo $prod->slika0;?>" alt="Slika 0 <?php echo $prod->naziv;?>" class="img-responsive">					
						</div>
					<?php endif;?>
					<?php if($prod->slika1):?>
						<div class="item">
							  <img src="<?php echo $put ?>slike/proizvodi/<?php echo $prod->slika1;?>" alt="Slika 1 <?php echo $prod->naziv;?>" class="img-responsive">					
						</div>
					<?php endif;?>
					<?php if($prod->slika2):?>
						<div class="item">
							  <img src="<?php echo $put ?>slike/proizvodi/<?php echo $prod->slika2;?>" alt="Slika 2 <?php echo $prod->naziv;?>" class="img-responsive">					
						</div>
					<?php endif;?>
					<?php if($prod->slika3):?>
						<div class="item">
							  <img src="<?php echo $put ?>slike/proizvodi/<?php echo $prod->slika3;?>" alt="Slika 3 <?php echo $prod->naziv;?>" class="img-responsive">					
						</div>
					<?php endif;?>
					<?php if($prod->slika4):?>
						<div class="item">
							  <img src="<?php echo $put ?>slike/proizvodi/<?php echo $prod->slika4;?>" alt="Slika 4 <?php echo $prod->naziv;?>" class="img-responsive">					
						</div>
					<?php endif;?>
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
	<div class="col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-10 col-sm-push-1 col-xs-10 col-xs-push-1">
	<h1>Kratki opis</h1>
	
	<div class="opis">
		<?php echo $prod->k_opis;?>
	</div>

	
	</div>
</div>



<div class="row">
		<div class="col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-10 col-sm-push-1 col-xs-10 col-xs-push-1">
	<h1>Komentari</h1>
	<hr style="border-color:black;" />
	</div>

</div>

<div class="row">
	<?php 
	foreach($komentari as $kom):
		if($kom->opg!=0):?>
			
			<?php 
			$opg = $con->prepare("select * from opg inner join komentar on komentar.opg=opg.sifra where proizvod=:p and komentar.opg=:o");
			$opg->bindParam(":p", $_GET["p"]);
			$opg->bindParam(":o", $kom->opg);
			$opg->execute();
			$kojiopg = $opg->fetch(PDO::FETCH_OBJ);?>
			
			<div class="col-md-10 col-md-push-1">
				<?php if($kojiopg->profilna):?>
					<img src="<?php echo $put ?>slike/opg/<?php echo $kojiopg->profilna;?>" style="max-height:50px;margin-left: 20px;margin-right:20px;margin-top:10px;" /> 
						<p> <?php echo $kojiopg->naziv;?> </p>
				<?php else:?>
					<img src="<?php echo $put ?>slike/opg/placeholder.png" style="max-height:50px;margin-left: 20px;margin-right:20px;margin-top:10px;" /> <?php echo $kojiopg->naziv;?>
				<?php endif;?>
					<div class="komentar">
						<?php echo $kojiopg->komentar;?> 
						<p class="datum"><?php echo $kojiopg->vrijeme;?></p>
					</div>
				</div>
		<?php endif;?>
		
		<?php
		if($kom->korisnik!=0):?>
		
			<?php 
				$kor = $con->prepare("select * from korisnik inner join komentar on komentar.korisnik=korisnik.sifra where proizvod=:p and komentar.korisnik=:o");
				$kor->bindParam(":p", $_GET["p"]);
				$kor->bindParam(":o", $kom->korisnik);
				$kor->execute();
				$kojikor = $kor->fetch(PDO::FETCH_OBJ);?>
				
			<div class="col-md-10 col-md-push-1">
				<?php if($kojikor->profilna):?>
					<img src="<?php echo $put ?>slike/korisnik/<?php echo $kojikor->profilna;?>" style="max-height:50px;margin-left: 20px;margin-right:20px;margin-top:10px;" /> 
						<p> <?php echo $kojikor->naziv;?> </p>
				<?php else:?>
					<img src="<?php echo $put ?>slike/korisnik/placeholder.png" style="max-height:50px;margin-left: 20px;margin-right:20px;margin-top:10px;" /> <?php echo $kojikor->nickname;?>
				<?php endif;?>
					<div class="komentar">
						<?php echo $kojikor->komentar;?> 
						<p class="datum"><?php echo $kojikor->vrijeme;?></p>
					</div>
				</div>
		<?php endif;
	endforeach;?>

</div>

<?php if($_SESSION["operater"]->naziv):?>
<div class="row">
	<div class="col-md-10 col-md-push-1">
		<div class="komentari">
			<h1  style="margin-top:20px;">Komentiraj</h1>
			<hr style="border-color:black;" />
			<textarea class="dodajkomentar" type="text" id="komentar" placeholder="Komentar" rows="10"></textarea>
	<br />
			<button class="btn1 btn-default" id="dodaj_komentar_opg" type="submit" style="margin-bottom:20px;margin-left:20px;"> Komentiraj</button>
	<hr/>
		</div>
	</div>
</div>
<?php endif;?>
<?php if($_SESSION["operater"]->ime):?>
<div class="row">
		<div class="col-lg-10 col-lg-push-1 col-md-10 col-md-push-1 col-sm-10 col-sm-push-1 col-xs-10 col-xs-push-1">
		<div class="komentari">
			<h1  style="margin-top:20px;">Komentiraj</h1>
			<hr style="border-color:black;" />
			<textarea class="dodajkomentar" type="text" id="komentar" placeholder="Komentar" rows="10"></textarea>
	<br />
			<button class="btn1 btn-default" id="dodaj_komentar_kor" type="submit" style="margin-bottom:20px;margin-left:20px;"> Komentiraj</button>
	<hr/>
		</div>
	</div>
</div>
<?php endif;?>

<script>
	$("#add_basket").click(function(){
		var projekt = $("#projekt").val();
		var operater = $("#operater").val();
		var komentar = $("#komentar").val();
		$.ajax({
      			type: 'POST',
      			url: "dodajBasket.php",
      			data: "k=" + komentar + "&p=" + projekt + "&u=" + operater,
      			dataType: 'text'
    			}).done(function(rezultat) {
    				
        			if(rezultat=="OK"){
        				
        				alert("Komentar dodan!");
   						location.reload();
   					}else{
   						alert(rezultat);
   					}
    			});   
		return false;
	});
	$("#dodaj_komentar_kor").click(function(){
		var proizvod = $("#proizvod").val();
		var komentar = $("#komentar").val();
		$.ajax({
      			type: 'POST',
      			url: "dodajKomentar.php",
      			data: "p=" + proizvod + "&k=" + komentar + "&kor=1",
      			dataType: 'text'
    			}).done(function(rezultat) {
    				
        			if(rezultat=="OK"){
        				
        				alert("Komentar dodan!");
   						location.reload();
   					}else{
   						alert(rezultat);
   					}
    			});   
		return false;
	});
	$("#dodaj_komentar_opg").click(function(){
		var proizvod = $("#proizvod").val();
		var komentar = $("#komentar").val();
		$.ajax({
      			type: 'POST',
      			url: "dodajKomentar.php",
      			data: "p=" + proizvod + "&k=" + komentar + "&opg=1",
      			dataType: 'text'
    			}).done(function(rezultat) {
    				
        			if(rezultat=="OK"){
        				
        				alert("Komentar dodan!");
   						location.reload();
   					}else{
   						alert(rezultat);
   					}
    			});   
		return false;
	})
</script>
<?php 	
include_once '../footer.php'; 
?>


</body>
</html>