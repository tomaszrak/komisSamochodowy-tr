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
		<script  src="../skrypty_js/formularz_administracja.js" type="text/javascript"></script>
		<script  src="../skrypty_js/validation.js" type="text/javascript"></script>
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
					<h1>Dodaj nową ofertę</h1>
					
					
					Aby dodać nową ofertę sprzedaży wypełnij poniższy formularz:
					<form id="form2" name="form2" method="post" action="#"> 
					<span style="float:right; font-size:12px; font-weight:bold; color: #bf0000;"> (*) - pozycja wymagana </span>	
						<div class="pozycjaformularza">
							<div class="opisformularza">Marka i model (*): </div>
							<div class="poleformularza"><input type="text" name="marka" class="required" title="Niewypełnione wymagane pole."/></div>
						</div>
						
						<div class="pozycjaformularza">
							<div class="opisformularza">Rodzaj silnika (*): </div>
							<div class="poleformularza">
								<input type="radio" name="rodzajsilnika" value="benzyna"/>benzyna
								<input type="radio" name="rodzajsilnika" value="diesel" class="validate-one-required" title="Wybierz jedną z dostępnych opcji."/>diesel
							</div>
						</div>
						
						<div class="pozycjaformularza">
							<div class="opisformularza">Przebieg [km] (*): </div>
							<div class="poleformularza"> <input type="text" name="przebieg"  class="required validate-number" title="Niewypełnione wymagane pole lub niepoprawnie wprowadzona wartość (dozwolone tylko cyfry)."/></div>
						</div>						
						
						<div class="pozycjaformularza">
							<div class="opisformularza">Rok produkcji (*): </div>
							<div class="poleformularza"> <input type="text" name="rokprodukcji" class="required validate-number" title="Niewypełnione wymagane pole lub niepoprawnie wprowadzona wartość (dozwolone tylko cyfry)."/></div>
						</div>						
						
						<div class="pozycjaformularza">
							<div class="opisformularza">Kolor : </div>
							<div class="poleformularza"> <input type="text" name="kolor" /></div></br>
						</div>
						
						<div class="pozycjaformularza">
							<div class="opisformularza">Cena [zł] : </div>
							<div class="poleformularza"> <input type="text" name="cena" class="validate-number" title="Niepoporawnie wprowadzona wartość (dozwolone tylko cyfry)."/></div>
						</div>
						
						<div class="pozycjaformularza">
							<div class="opisformularza">Informacje dodatkowe : </div>
							<div class="poleformularza"><input type="text" name="informacje" /></div>
						</div>						
						
						<div class="pozycjaformularza">
							<div class="opisformularza">Zdjęcie 1 : </div>
							<div class="poleformularza"><input type="button" id="zdjecie1" value="Załaduj" style="width: 148px;" /></div>
						</div>
						<div id="odp1"></div>
						
						<div class="pozycjaformularza">
							<div class="opisformularza" style="padding:0px"><input type="button" name="send" value="Wyślij" onclick="WyslijDane(value);"></div>
							<div class="poleformularza" style="width:20px"><input type="button" name='reset' value="Wyczyść" onclick="location.reload(true);"></div>
						</div>
							<div id="odp" style="text-align:left; padding-left:115px; font-size:12px; font-weight:bold;"></div>
					</form>
					<script type="text/javascript">
						var valid = new Validation('form2',{immediate : true,useTitles : true});
						new AjaxUpload('zdjecie1', {		
							action: '../zdjecia_oferty.php',
							onComplete : function(file){
								document.getElementById("odp1").innerHTML="Zdjęcie załadowane pomyślnie!";
								document.getElementById('zdjecie1').setAttribute('disabled', 'disabled');
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