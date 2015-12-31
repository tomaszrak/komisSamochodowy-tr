<?php
	session_start();
	$tab1 =array();
	$aktualne_zdj=$_POST['aktualne_zdj'];
	$przycisk=$_POST['przycisk'];
	
	include 'polacz.php';
	$sql= "SELECT id FROM oferty";
	$result = mysql_query( $sql, $connection );
	if(! $result ) 
	{
		die('Could not get data: ' . mysql_error());
	}
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
	{	
		$tab1[]="{$row['id']}";
	}
	$ilosc_pozycji=mysql_num_rows($result);
	$ostatni_element=$tab1[$ilosc_pozycji-1];
	if($przycisk==1)
	{
		$sql = "SELECT marka,rodzajsilnika,przebieg,rokprodukcji,kolor,cena,informacje,zdjecie1 FROM oferty WHERE id='$tab1[0]'";
		$aktualne_zdj=1;
	}
	

	if($przycisk==2)
	{
		$aktualne_zdj-=1;
		if($aktualne_zdj<=0)
			$aktualne_zdj=1;
		$tmp=$tab1[$aktualne_zdj-1];
		$sql = "SELECT marka,rodzajsilnika,przebieg,rokprodukcji,kolor,cena,informacje,zdjecie1 FROM oferty WHERE id='$tmp'";
	}
	
	if($przycisk==3)
	{
		$aktualne_zdj+=1;
		if($aktualne_zdj>$ilosc_pozycji)
			$aktualne_zdj=$ilosc_pozycji;
		$tmp=$tab1[$aktualne_zdj-1];
		$sql = "SELECT marka,rodzajsilnika,przebieg,rokprodukcji,kolor,cena,informacje,zdjecie1 FROM oferty WHERE id='$tmp'";
		
	}
	
	if($przycisk==4)
	{
		$sql = "SELECT marka,rodzajsilnika,przebieg,rokprodukcji,kolor,cena,informacje,zdjecie1 FROM oferty WHERE id='$ostatni_element'";
		$aktualne_zdj=$ilosc_pozycji;
	}
	
	$result = mysql_query( $sql, $connection );
	if(! $result ) 
	{
		die('Could not get data: ' . mysql_error());
	}
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
	{	
		$dane=$dane.ucfirst("{$row['marka']}")."##".
								ucfirst("{$row['rodzajsilnika']}")."##".
								("{$row['przebieg']}")."##".
								("{$row['rokprodukcji']}")."##";
		if($row[kolor]!='')
			$dane=$dane.ucfirst("{$row['kolor']}")."##";
		else
			$dane=$dane."Brak danych"."##";
			
		if($row[cena]!='')
			$dane=$dane."{$row['cena']}"."##";
		else
			$dane=$dane."Brak danych"."##";
			
		if($row[informacje]!='')
			$dane=$dane."{$row['informacje']}"."##";
		else
			$dane=$dane."Brak danych"."##";
		
		if($row[zdjecie1]!='')
			$dane=$dane."{$row['zdjecie1']}"."##";
		else
			$dane=$dane."Brak"."##";
		
		$dane=$dane.$aktualne_zdj."##";
		$dane=$dane.$ilosc_pozycji."##";
	}
	
	echo $dane;//."wart przycisku".$przycisk;
	//echo "ilosc_pozycji".$ilosc_pozycji;
	mysql_close($connection);
?>