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
	<h1>Med "Stojanović"<hr /></h1>
	<div class="cijena"><img src="<?php echo $put ?>slike/cijena.png" style="width:15px;margin-right:10px;" />40 kn/kg</div>
	<p class="adresa" style="float:right;margin-right:300px;margin-top:-30px;">
	<img src="<?php echo $put ?>slike/user.png" style="max-width:20px;" /> OPG Stojanović
	</p>
	<p class="adresa" style="margin-top:10px;"><img src="<?php echo $put ?>slike/email.png" style="margin-right:5px;"/>E-Mail<br /></p>
		<p class="adresa" style="marign-top:10px;"><img src="<?php echo $put ?>slike/lokacija.png" style="max-height: 30px;" />Adresa <br /></p>
		<div class="lijevo">Grad <br />
		Poštanski broj </div>
		<p class="adresa" style="float:right;margin-right:300px;margin-top:-80px;">
		
		<img src="<?php echo $put ?>slike/etiketa.png" style="max-height:15px;margin-right:5px;" />kategorija</p>
	 <button class="btn btn-default" type="button" style="margin-top:15px;"><img src="<?php echo $put ?>slike/kolica.png" style="max-width:20px;margin-right:10px;margin-left:-20px;" />Dodaj u košaricu
  </button>
	</div>
	<div class="col-md-6 slikaproizvod">

		<div id="myCarousel" class="carousel slide" data-ride="carousel">

		  <div class="carousel-inner" role="listbox">
		  
			<div class="item active">
				<a href="">
				  <img src="<?php echo $put ?>slike/Untitled-5.jpg" alt="" class="img-responsive">
				</a>
					
				
			</div>
		
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
	<div class="col-md-10 col-md-push-1">
	<h1>Kratki opis</h1>
	
	<div class="opis">
dfsgsdfgsfdgsfdg
	</div>

	
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