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
					Jesteś zalogowany jako: <?php echo $_SESSION['uzytkownik']; $message="Poprawnie wylogowano z systemu."?> 
					<a href="zaloguj.php">Wyloguj</a> 
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
					<p style="margin-top:220px; line-height:25px; font-weight: bold; font-size:16px;">Witaj w systemie administracji bazą danych!<br/> Wybierz jedną z opcji menu aby kontynuować.</p>
				</div>
			</div>
		</div>
	</body>
</html>