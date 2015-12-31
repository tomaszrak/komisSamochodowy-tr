<?php		
	$dbserver='mysql.cba.pl'; 
	$dbuser = 'komis127638'; 
	$dbpassword = '127638komis'; 
   
        $connection=mysql_connect($dbserver,$dbuser,$dbpassword);
	$connection=mysql_connect($dbserver,$dbuser,$dbpassword);
	if(!$connection) {
		echo('Nie można połączyć z bazą danych. Błąd: ' . mysql_error());
	}
               mysql_select_DB('komis_y0_pl');
    
	
?>