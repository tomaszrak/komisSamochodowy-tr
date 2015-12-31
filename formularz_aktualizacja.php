<?php
		session_start();
		$zdjecie1=$_SESSION['zdjecie1'];
		$id=$_POST['id'];
		$marka= $_POST['marka'];
		$rodzajsilnika=$_POST['rodzajsilnika'];
		$przebieg=$_POST['przebieg'];
		$rokprodukcji=$_POST['rokprodukcji'];
		$kolor=$_POST['kolor'];
		$cena=$_POST['cena'];
		$informacje=$_POST['informacje'];
		$send=$_POST['send'];
		$str1='';
		$str2='';
		$str3='';
		$str4='';
		$str5='';
		$str6='';
		$str7='';
		$str8='';
		$str9='';
		$tab = array();
		$i=0;
		
		if($marka!='')
		{
			$str1="marka='$marka'";
			$tab[$i]=$str1;
			$i++;
		}
		//if(($rodzajsilnika!='undefine')||($rodzajsilnika!='undefine')||($rodzajsilnika!=''))
		if(($rodzajsilnika=='diesel')||($rodzajsilnika=='benzyna'))
		{
			$str2=" rodzajsilnika='$rodzajsilnika'";
			$tab[$i]=$str2;
			$i++;
		}
		
		if($przebieg!='')
		{
			$str3="przebieg='$przebieg'";
			$tab[$i]=$str3;
			$i++;
		}	
		if($rokprodukcji!='')	
		{
			$str4="rokprodukcji='$rokprodukcji'";
			$tab[$i]=$str4;
			$i++;
		}
		if($kolor!='')
		{
			$str5="kolor='$kolor'";		
			$tab[$i]=$str5;
			$i++;
		}
			
		if($cena!='')
		{
			$str6="cena='$cena'";
			$tab[$i]=$str6;
			$i++;
		}
			
		if($informacje!='')
		{
			$str7="informacje='$informacje'";
			$tab[$i]=$str7;
			$i++;
		}
		if($zdjecie1!='')
		{
			$str8="zdjecie1='$zdjecie1'";
			$tab[$i]=$str8;
			$i++;
		}
		if($id!='')
			$str9="id='$id'";
		
		for($j=0;$j<$i;$j++)
		{	
			if(!($j==($i-1)))
				$str_tmp=$str_tmp.$tab[$j].", ";
			else
				$str_tmp=$str_tmp.$tab[$j];
		}
		if(isset($_POST['send']))
		{
			include 'skrypty_sql/polacz.php';
			if($zdjecie1) //Usuwanie poprzedniego zdjecia (o ile wybrano aktualizację zdjęcia)
			{
				$sql="SELECT zdjecie1 FROM oferty WHERE $str9";
				mysql_select_db('komis1');
				$result = mysql_query( $sql, $connection );
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$poprzednie_zdj=$row[zdjecie1];
					unlink($poprzednie_zdj);
					$cel=str_replace('auta_oferty','miniaturki',$poprzednie_zdj);
					unlink($cel);
				}
			}
			$sql="UPDATE oferty SET $str_tmp WHERE $str9 ";
	
			$result = mysql_query( $sql, $connection );
			if(! $result ) {
				exit('Nie wysłano formularza. Bład bazy danych: ' . mysql_error());
			}
			mysql_close($connection);
			echo "<span style='color: #20a423;'>Dane zostały zaktualizowane!</span>";
		}
		else
		{
			echo "<span style='color: #e60000;'>Niekompletne dane. Uzupełnij wymagane pola!</span>";
			
		}
		$_SESSION['zdjecie1']='';
?>