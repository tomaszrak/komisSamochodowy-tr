<?php
                error_reporting(0);

		session_start();
		$marka= $_POST['marka'];
		$rodzajsilnika=$_POST['rodzajsilnika'];
		$przebieg=$_POST['przebieg'];
		$rokprodukcji=$_POST['rokprodukcji'];
		if(!empty($_POST['kolor']))
                $kolor=$_POST['kolor'];
                $cena=$_POST['cena'];
                if(!empty($_POST['informacje']))
                $informacje=$_POST['informacje'];
		$imienazw=$_POST['imienazw'];
		$telefon=$_POST['telefon'];
		$email=$_POST['email'];
		$send=$_POST['send'];
		
		$ilosc=$_SESSION['ilosc'];
                if(!empty($_POST['zdjecie1']))
		$zdjecie1=$_SESSION['zdjecie1'];
                if(!empty($_POST['zdjecie2']))
		$zdjecie2=$_SESSION['zdjecie2'];

		if((isset($_POST['send']))&&($marka!='')&&($rodzajsilnika!='')&&($przebieg!='')&&($rokprodukcji!='')&&($imienazw!='')&&($telefon!='')&&($email!=''))
		{
			include 'skrypty_sql/polacz.php';
			$sql="INSERT INTO propozycje (marka,rodzajsilnika,przebieg,rokprodukcji,kolor,cena,informacje,imienazw,telefon,email,zdjecie1,zdjecie2)".
			"VALUES('$marka','$rodzajsilnika','$przebieg','$rokprodukcji','$kolor','$cena','$informacje','$imienazw','$telefon','$email','$zdjecie1','$zdjecie2')";
			$result = mysql_query( $sql, $connection );
			if(! $result ) {
				exit('Nie wysłano formularza. Bład bazy danych: ' . mysql_error());
			}
			mysql_close($connection);
			echo "<span style='color: #20a423;'>Dane zostaly wyslane poprawnie!</span>";
		}
		else
		{
			echo "<span style='color: #e60000;'>Niekompletne dane. Uzupełnij wymagane pola!</span>";
			
		}
		$_SESSION['ilosc']=0;
		$_SESSION['zdjecie1']='';
		$_SESSION['zdjecie2']='';

?>