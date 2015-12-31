<?php
	session_start();
  if(!isset($_SESSION['uzytkownik'])){
		header("location:zaloguj.php");
	}
?>

<html>
	<head>
		<title>Panel administracyjny - zarządzanie baza danych</title>
		<link rel="stylesheet" href="../style_administracja.css" type="text/css">
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<script type="text/javascript" src="../skrypty_js/skrypt_administracja.js"></script>
	</head>
	
	<body>
		<div class="pojemnik_administracja">
			<div class="naglowek_administracja"></div>
			<div class="tresc_administracja">
				<div class="stan">
					Jesteś zalogowany jako: <?php echo $_SESSION['uzytkownik']; $message="Poprawnie wylogowano z systemu."?> [
					<a href="zaloguj.php">Wyloguj</a> ]
				</div>
				<div class="menu_administracja">
					<ul id="menu_lista" class="menu_lista">
						<li><a href="pokaz_oferty.php">Pokaż stan tabeli Oferty</a></li>
						<li><a href="pokaz_propozycje.php">Pokaż stan tabeli Propozycje</a></li>
						<li><a href="#">Zarządzaj tabelą Oferty</a>
					    <ul id="menu_pod1">
								<li><a href="dodaj_oferte.php" title="Dodaj nową ofertę">Dodaj pozycję</a></li>
								<li><a href="edytuj_oferte.php" title="Edytuj istniejącą ofertę">Edytuj pozycję</a></li>
								<li><a href="usun_oferte.php" title="Usuń istniejącą ofertę">Usuń pozycję</a></li>
							</ul>						
						</li>
						<li><a href="#">Zarządzaj tabelą Propozycje</a>
							<ul id="menu_pod2">
								<li><a href="usun_propozycje.php" title="Usuń istniejącą propozycję">Usuń pozycję</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="dane">
					<h1>Tabela Propozycje</h1>
<?php
	include 'polacz.php';
	$sql = "SELECT marka, rodzajsilnika, przebieg, rokprodukcji, kolor, cena, informacje, imienazw, telefon, email, zdjecie1, zdjecie2 FROM propozycje";
	$result = mysql_query( $sql, $connection );
	if(! $result ) {
	die('Could not get data: ' . mysql_error());
	}
	echo "<table border=\"1px\"><tr>
		<th>Imię i nazwisko</th>
		<th>Telefon</th>
		<th>E - mail</th>
		<th>Marka</th>
		<th>Rodzaj silnika</th>
		<th>Przebieg [km]</th>
		<th>Rok produkcji</th>
		<th>Kolor</th>
		<th>Cena</th>
		<th>Inf. dodatkowe</th>
		<th>Zdjęcie 1<t/h>
		<th>Zdjęcie 2</th></tr>";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo "<tr>".
			"<td>{$row['imienazw']}</td>".
			"<td>{$row['telefon']}</td>".
			"<td>{$row['email']}</td>".
			"<td>{$row['marka']}</td>".
			"<td>{$row['rodzajsilnika']}</td>".
			"<td>{$row['przebieg']}</td>".
			"<td>{$row['rokprodukcji']}</td>";

			if($row[kolor]!='')
				echo "<td>{$row['kolor']}</td>";
			else
				echo "<td>brak</td>";
				
			if($row[cena]!='')
				echo "<td>{$row['cena']}</td>";
			else
				echo "<td>brak</td>";
				
			if($row[informacje]!='')
				echo "<td>{$row['informacje']}</td>";
			else
				echo "<td>brak</td>";
			
			if($row[zdjecie1]!='')
				echo "<td><input type='button' value='Zdjecie1' style='width:100%;' onClick=\"window.open('../{$row['zdjecie1']}','Zdjęcie','width=800,height=600,scrollbars=1')\"/></td>";
			else
				echo "<td>brak</td></tr>";
			
			if($row[zdjecie2]!='')
			{
				echo "<td><input type='button' value='Zdjecie2' style='width:100%;' onClick=\"window.open('../{$row['zdjecie2']}','Zdjęcie','width=800,height=600,scrollbars=1')\"/></td></tr>";
			}
			else
				echo "<td>brak</td></tr>";
	}
	echo "</table>";
	mysql_close($connection);
?>
				</div>
			</div>
		</div>
	</body>
</html>


