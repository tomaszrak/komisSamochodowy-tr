<?php
        session_start();
        unset($_SESSION['uzytkownik']);
        
		$message="";
		 
	$login=$_POST['login'];
	if($login) {
	
		$uzytkownik=$_POST['uzytkownik'];
		
		$haslo=md5($_POST['haslo']);
		
		include 'polacz.php';
		mysql_select_db('komis_y0_pl');
		$sql="SELECT * FROM uzytkownicy WHERE login='$uzytkownik' AND haslo='$haslo'";
		$rezultat=mysql_query($sql,$connection);
		if(@mysql_num_rows($rezultat)){
		  $_SESSION['uzytkownik']= "Adminnistrator"; // Zapamiętuje zmienną sesji
			header('location:main.php'); // Przekierowanie do strony main.php
		exit;
		}else {
			$message="<span style='color:#e60000; font-weight: bold;'>Nieprawidłowa nazwa użytkownika lub hasło </span>";
		}
	} // Koniec sprawdzania autoryzacji.
?>

<html>
	<head>
		
		<title>Logowanie administratora</title>
		<link rel="stylesheet" href="../style_administracja.css" type="text/css">
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	</head>
	
	<body>
	
	<div class="pojemnik_logowanie">
		<div class="naglowek_logowanie"></div>
		<div class="tresc_logowanie">
			Próbujesz zalogować się jako administrator. <br/>Jeśli trafiłeś tutaj przypadkowo <a href="../index.html"> Wróć do serwisu</a> .
			<br/><br/>
			<form  class="form_logowanie" method="post" action="<?php echo $PHP_SELF; ?>">
				<table>
					<tr>
						<td>Użytkownik: </td>
						<td><input name="uzytkownik" type="text" style="width:145px;" /></td>
					</tr>
					<tr>
						<td>Hasło: </td>
						<td><input name="haslo" type="password" style="width:145px;" /></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="login"  value="Zaloguj" />
						</td>
					</tr>
				</table>
				
			</form>
			<?php echo $message; ?>
		</div>
	</div>
	</body>
</html>		