<?php 	include_once 'konfiguracija.php';  ?>
<?php 
	if($_POST):
		$delete = $con->prepare("delete from opg_pr where opg=:sifra");
		$delete->bindParam(":sifra", $_POST["sifra"]);
		$delete->execute();
		
		$delete = $con->prepare("delete from komentar where opg=:sifra");
		$delete->bindParam(":sifra", $_POST["sifra"]);
		$delete->execute();
		
		$delete = $con->prepare("delete from opg where sifra=:sifra");
		$delete->bindParam(":sifra", $_POST["sifra"]);
		$delete->execute();
	endif;
