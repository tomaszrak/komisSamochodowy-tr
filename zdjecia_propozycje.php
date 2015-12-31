<?php
	session_start();
	$_SESSION['ilosc'];
	$_SESSION['zdjecie1'];
	$_SESSION['zdjecie2'];
	$katalog = "auta_propozycje/";
	$tmpnazwapliku = $_FILES['userfile']['name'];
	$sciezka = $katalog . basename($tmpnazwapliku);
	
	$info = pathinfo($tmpnazwapliku);
	$rozszerzenie=$info['extension'];
	
	$nowanazwa=date("Ymd_Gis").rand().".".$rozszerzenie;
	$nowasciezka=$katalog.$nowanazwa;
	
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $sciezka)) 
	{
		$_SESSION['ilosc']+=1;
		rename($sciezka,$nowasciezka);
		if($_SESSION['ilosc']==1)
			$_SESSION['zdjecie1']=$nowasciezka;
		if($_SESSION['ilosc']==2)
			$_SESSION['zdjecie2']=$nowasciezka;
		echo "success";
	} 
	else {
		echo "error";
	}

?>