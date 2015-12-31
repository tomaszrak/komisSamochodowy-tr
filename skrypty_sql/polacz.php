<?php		
	$dbserver='mysql6.mydevil.net'; 
	$dbuser = 'm1404_komis'; 
	$dbpassword = 'Komiskomis1'; 
	$connection=mysql_connect($dbserver,$dbuser,$dbpassword);
	if(! $connection ) {
		die('Nie można połączyć z bazą danych: ' . mysql_error());
	}
	mysql_select_db('m1404_komis');
?>