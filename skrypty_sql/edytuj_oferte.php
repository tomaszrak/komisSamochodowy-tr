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
		<script src="../skrypty_js/scriptaculous/lib/prototype.js" type="text/javascript"></script>
		<script src="../skrypty_js/scriptaculous/src/effects.js" type="text/javascript"></script>
		<script  src="../skrypty_js/formularz_aktualizacja.js" type="text/javascript"></script>
		<script  src="../skrypty_js/ajaxupload.js" type="text/javascript"></script>		
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
					<h1>Edytuj ofertę</h1>
<?php
	include 'polacz.php';
	$sql = "SELECT id,marka,rodzajsilnika,przebieg,rokprodukcji,kolor,cena,informacje,zdjecie1 FROM oferty";
	$result = mysql_query( $sql, $connection );
	if(! $result ) {
	die('Could not get data: ' . mysql_error());
	}
	echo"<table border=\"1px\"><tr>
		<th>Id</th>
		<th>Marka</th>
		<th>Rodzaj silnika</th>
		<th>Przebieg [km]</th>
		<th>Rok produkcji</th>
		<th>Kolor</th>
		<th>Cena</th>
		<th>Informacje</th>
		<th>Zdjęcie<t/h></tr>";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo "<tr>".
			"<td>{$row['id']}</td>".
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
				echo "<td><input type='button' value='Zdjęcie' style='width:100%;' onClick=\"window.open('../{$row['zdjecie1']}','Zdjęcie','width=800,height=600,scrollbars=1')\"/></td>";
			else
				echo "<td>brak</td></tr>";
	}
	echo "</table>";
	mysql_close($connection);
?>
				<br/>Podaj numer id nowego rekordu oraz jego nowe dane:<br/><br/>
				
				<form id="form3" name="form3"  class="formularz_edytuj" action="#" method="post">
				<table class="tabela" style="width:905px; table-layout:fixed; padding:0px;" >
					<tr>
						<th style="width:19px;">Id</th>
						<th style="width:97px;">Marka</th>
						<th style="width:80px;">Rodzaj silnika</th>
						<th style="width:100px;">Przebieg [km]</th>
						<th style="width:100px;">Rok produkcji</th>
						<th style="width:70px;">Kolor</th>
						<th style="width:50px;">Cena</th>
						<th style="width:202px;">Informacje</th>
						<th style="width:92px;">Zdjęcie<t/h>
					</tr>
					<tr>
						<td><input type="text" name="id" style="width:100%;"/></td>
						<td><input type="text" name="marka" style="width:100%;"/></td>
						<td>
							<input type="radio" name="rodzajsilnika" value="benzyna"/>benzyna<br/>
							<input type="radio" name="rodzajsilnika" value="diesel"/>diesel
						</td>
						<td><input type="text" name="przebieg" style="width:100%;"/></td>
						<td><input type="text" name="rokprodukcji" style="width:100%;"/></td>
						<td><input type="text" name="kolor" style="width:100%;"/></td>
						<td><input type="text" name="cena" style="width:100%;"/></td>
						<td><input type="text" name="informacje" style="width:100%;"/></td>
						<td>
							<input type="button" id="zdjecie1" value="Zdjęcie" style="width:100%;"/>
							<div id="odp1" style="text-align:left; color: #20a423; font-size:12px; font-weight:bold; "></div>	
						</td>
					</tr>
					</table>
					<br/>
					<input type="button" name="send" value="Wyślij" onclick="WyslijDane(value);">
					<input type="button" name='reset' value="Wyczyść" onclick="location.reload(true);">
					<div id="odp"></div>
				</form>
				<script>
					new AjaxUpload('zdjecie1', {		
						action: '../zdjecia_oferty.php',
						onComplete : function(file){
							document.getElementById("odp1").innerHTML="Zmieniono zdjęcie";
						},
						onSubmit : function(file , ext)
						{
							if (! (ext && /^(jpg|png|jpeg|gif|JPG|JPEG|PNG|GIF)$/.test(ext)))
							{
								alert('Błąd! Próba załadowania pliku o niepoprawnym rozszerzeniu! Preferowane rozszerzenia plików to: *.jpg, *.png, *.gif. Proszę spróbować ponownie.');
								return false;
							}
						}
					});
				</script>
				</div>
			</div>
		</div>
	</body>
</html>


