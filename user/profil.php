<?php 	include_once '../konfiguracija.php';  ?>

<!doctype html>
<html>
<head>
	<?php 	include_once '../head.php';  ?>
	</head>
<body>
	
	<?php 	
	include_once '../navigacija.php'; 
	 ?>


<div class="row profil">
	<div class="col-md-6 col-md-push-1">
	<h1>OPG Stojanović<hr /></h1>
		<p class="adresa"><img src="<?php echo $put ?>slike/lokacija.png" style="max-height: 30px;" />Adresa <br /></p>
		<div class="lijevo">Grad <br />
		Poštanski broj <br /></div>
		<p class="adresa">
		<img src="<?php echo $put ?>slike/email.png" style="margin-right:5px;"/>E-Mail<br />
		<img src="<?php echo $put ?>slike/etiketa.png" style="max-height:15px;margin-right:5px;" />kategorija</p>
	
	</div>
	<div class="col-md-6 slikaprofil">
		<img src="<?php echo $put ?>slike/Untitled-5.jpg" class="img-responsive" style="border:10px solid #efefef;"/>
	
	</div>
</div>

<div class="row">
	<div class="col-md-10 col-md-push-1">
	<h1>Proizvodi</h1>
	<hr style="border-color:black;" />
	</div>
</div>
<div class="row">
	 <div class="col-lg-4 col-md-4 col-md-push-1 col-sm-4 col-xs-10 col-xs-push-4 proizvodi">
	<a href="">
	  
			<img class="proizvodi_slika" src="<?php echo $put ?>slike/Untitled-6.jpg" />
	
	
	</a>
    <h2><span>Naziv</span></h2>
  </div>
</div>


<div class="row">
	<div class="col-md-10 col-md-push-1">
	<h1>Komentari</h1>
	<hr style="border-color:black;" />
	</div>

</div>

<div class="row">
	<div class="col-md-10 col-md-push-1">
		<img src="<?php echo $put ?>slike/opg/placeholder.png" style="max-height:50px;margin-left: 20px;margin-right:20px;margin-top:10px;" />ime_korisnika
		<div class="komentar">komentar <p class="datum">10-07-2015 17:23</p></div>
	</div>

	<div class="col-md-10 col-md-push-1">
		<img src="<?php echo $put ?>slike/opg/placeholder.png" style="max-height:50px;margin-left: 20px;margin-right:20px;margin-top:10px;" />ime_korisnika
		<div class="komentar">komentar <p class="datum">10-07-2015 17:23</p></div>
	</div>
</div>


<div class="row">
	<div class="col-md-10 col-md-push-1">
		<div class="komentari">
			<h1  style="margin-top:20px;">Komentiraj</h1>
			<hr style="border-color:black;" />
			<textarea class="dodajkomentar" type="text" id="komentar" placeholder="Komentar" rows="10"></textarea>
	<br />
	<button class="btn1 btn-default" id="dodaj_komentar" type="submit" style="margin-bottom:20px;margin-left:20px;"> Komentiraj</button>
			<hr/>
			<?php foreach($komentar as $kom):?>
				<h5><?php echo $kom->accName;?></h5>

				<p><?php echo $kom->komentar;?></p>
			<?php endforeach;?>

			
		</div>
	</div>
</div>

<script>
	$("#dodaj_komentar").click(function(){
		var projekt = $("#projekt").val();
		var operater = $("#operater").val();
		var komentar = $("#komentar").val();
		$.ajax({
      			type: 'POST',
      			url: "dodajKomentar.php",
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
	})
</script>
<?php 	
include_once '../footer.php'; 
?>


</body>
</html>