<?php
session_start();

if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
{
	header('Location: gra.php');
	exit(); // opuszczamy plik wykonuje sie tylko header
	}
?>
<!DOCTYPE HTML> 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">  

<head>  
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" /> 
<title>Panel logowania</title>
</head>
<body> 

	<form action="zaloguj.php" method="post">
	Login: <br/><input type="text" name="login"/><br/>
	Hasło: <br/><input type="password" name="haslo"/><br/></br>
	<input type="submit" value="Zaloguj się"/>
	</form>
	
<?php
	if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>
</body>  

</html>