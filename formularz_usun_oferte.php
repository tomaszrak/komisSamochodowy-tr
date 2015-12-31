<?php
		$send=$_POST['send'];
		$czyskasowac=$_POST['czyskasowac'];
		$czy_blad=0;
                //print_r($czyskasowac);
		if(isset($_POST['send']))
		{
			include 'skrypty_sql/polacz.php';
			if(! $connection ) 
			{
				die('Nie można połączyć z bazą danych. Błąd: ' . mysql_error());
			}

			for($i=0;$i<count($czyskasowac);$i++)
			{
				if($czyskasowac[$i])
				{
					$sql="SELECT zdjecie1 FROM oferty WHERE id='$czyskasowac[$i]'";
					$result = mysql_query( $sql, $connection );
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
					{
						if($row[zdjecie1]!='')
						{
							$poprzednie_zdj=$row[zdjecie1];
							unlink($poprzednie_zdj);
							$cel=str_replace('auta_oferty','miniaturki',$poprzednie_zdj);
							unlink($cel);
						}
					}
					$sql = "DELETE FROM oferty WHERE id='$czyskasowac[$i]'" ;
					$result = mysql_query($sql, $connection);
					
					if(!$result)
					{
						die('Nie udało się usunąć danych: ' . mysql_error());
						$czy_blad+=1;
					}
				}
			}
			if($czy_blad==0)
				echo "Dane zostały skasowane";

		}
		mysql_close($connection);
?>	