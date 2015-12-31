<?php
	session_start();
	$_SESSION['zdjecie1'];
	$katalog = "auta_oferty/";
	$tmpnazwapliku = $_FILES['userfile']['name'];
	$sciezka = $katalog . basename($tmpnazwapliku);
	
	$info = pathinfo($tmpnazwapliku);
	$rozszerzenie=$info['extension'];
	
	$nowanazwa=date("Ymd_Gis").rand().".".$rozszerzenie;
	$nowasciezka=$katalog.$nowanazwa;
	
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $sciezka)) 
	{
		rename($sciezka,$nowasciezka);
		$_SESSION['zdjecie1']=$nowasciezka;
	} 
?>