<?php include_once "konfiguracija.php";?>
<?php

//ZA OPG_NASLOVNA
	
	$trazi=$con->prepare("select * from opg where :mod like '%:u%';");
	$trazi->bindParam(":mod", $_POST["mod"]);
	$trazi->bindParam(":u", $_POST["u"]);
	$trazi->execute();
	$rezultati = $trazi->fetchAll(PDO::FETCH_OBJ);