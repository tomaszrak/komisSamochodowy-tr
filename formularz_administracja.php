<?php
		session_start();
		$zdjecie1=$_SESSION['zdjecie1'];
		$marka= $_POST['marka'];
		$rodzajsilnika=$_POST['rodzajsilnika'];
		$przebieg=$_POST['przebieg'];
		$rokprodukcji=$_POST['rokprodukcji'];
		$kolor=$_POST['kolor'];
		$cena=$_POST['cena'];
		$informacje=$_POST['informacje'];
		$send=$_POST['send'];
		
		if((isset($_POST['send']))&&($marka!='')&&($rodzajsilnika!='')&&($przebieg!='')&&($rokprodukcji!=''))
		{
			include 'skrypty_sql/polacz.php';
			if(! $connection ) {
				die('Nie można połączyć z bazą danych. Błąd: ' . mysql_error());
			}
			$sql="INSERT INTO oferty (marka,rodzajsilnika,przebieg,rokprodukcji,kolor,cena,informacje,zdjecie1)".
			"VALUES('$marka','$rodzajsilnika','$przebieg','$rokprodukcji','$kolor','$cena','$informacje','$zdjecie1')";
			
			$result = mysql_query( $sql, $connection );
			if(! $result ) 
			{
				exit('Nie wysłano formularza. Bład bazy danych: ' . mysql_error());
			}
			else
			{
				if($zdjecie1!='')
				{
					include 'skrypty_sql/stworz_miniaturke.php';
					$cel=str_replace('auta_oferty','miniaturki',$zdjecie1);
					stworz_miniaturke($zdjecie1,$cel,400,300);
				}
			}
			mysql_close($connection);
			echo "<span style='color: #20a423;'>Dane zostaly wyslane poprawnie!</span>";
		}
		else
		{
			echo "<span style='color: #e60000;'>Niekompletne dane. Uzupełnij wymagane pola!</span>";			
		}
		$_SESSION['zdjecie1']='';
?>