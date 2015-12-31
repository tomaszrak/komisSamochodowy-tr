<?php
		$send=$_POST['send'];
		$czyskasowac=$_POST['czyskasowac'];
		if(isset($_POST['send']))
		{
			include 'skrypty_sql/polacz.php';
			if(! $connection ) {
				die('Nie można połączyć z bazą danych. Błąd: ' . mysql_error());
			}
			
			for($i=0;$i<count($czyskasowac);$i++)
			{
				if($czyskasowac[$i])
				{
					$sql="SELECT zdjecie1 FROM propozycje WHERE id='$czyskasowac[$i]'";
					$result = mysql_query( $sql, $connection );
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
					{
						$poprzednie_zdj=$row[zdjecie1];
						unlink($poprzednie_zdj);
					}
					$sql = "DELETE FROM propozycje WHERE id='$czyskasowac[$i]'" ;
					
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