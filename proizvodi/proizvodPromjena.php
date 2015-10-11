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
	 <div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h1 class="naslov">Promjeni podatke proizvoda</h1>
	</div>
</div>
<div class="row profil">

<div class="col-xs-7 col-xs-push-3">
	
		<input class="log" type="text" id="naziv" name="naziv" value="<?php echo $prod->naziv?>" />
	
	<select class="log" id="kategorija" name="kategorija" placeholder="<?php echo $prod->kategorija?>">
		<option value="Mliječni proizvodi"> Mliječni proizvodi </option>
		<option value="Alkoholna pića"> Alkoholna pića </option>
		<option value="Bezalkoholni napitci"> Bezalkoholni napitci </option>
		<option value="Voće"> Voće </option>
		<option value="Povrće"> Povrće </option>
		<option value="Pčelarski proizvodi"> Pčelarski proizvodi </option>
		<option value="Gljive"> Gljive </option>
		<option value="Ribarstvo"> Ribarstvo </option>
		<option value="Prirodna kozmetika"> Prirodna kozmetika </option>
	</select>
	<textarea class="log1" type="text" id="kratkiopis" name="kratkiopis" placeholder="" rows="10"><?php echo $prod->k_opis;?></textarea><br />
	
		</p>
		<input class="log" type="text" id="cijena" name="cijena" value="<?php echo $prod->cijena;?>" />kn  kom/kg<br />
		
</div>
</div>
<script>
	$("#add_basket").click(function(){
		var proizvod = $("#proizvod").val();
		var kolicina = $("#kolicina").val();
		
		if(!kolicina){
			var kolicina=1;
		}else{
			if($.isNumeric(kolicina)){
			}else{
				alert("Količina mora biti brojčana vrijednost");
				return false;
			};
		};
		$.ajax({
      			type: 'POST',
      			url: "dodajBasket.php",
      			data: "k=" + kolicina + "&p=" + proizvod,
      			dataType: 'text'
    			}).done(function(rezultat) {
    				
        			if(rezultat=="OK"){
        				
        				alert("Dodano u košaricu!");
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