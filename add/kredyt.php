<?php

	session_start();
	if(!isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==false))
	{
		header('Location: administrator-logowanie');
		exit(); // opuszczamy plik wykonuje sie tylko header
	}

	include '../include/db.php';
	mysql_select_db('logowanie');
	mysql_query("SET NAMES utf8");

	$raty = $_POST['raty'];
	$oprocentowanie = $_POST['oprocentowanie'];
	$kwota = $_POST['kwota'];
	$idKlienta = $_POST['id_klienta'];
	$data = date('Y/m/d H:i:s');

	if ( is_numeric($kwota) && is_numeric($oprocentowanie) && is_numeric($raty)) {
		$kwota_raty = ($kwota / $raty) + (($kwota * $oprocentowanie)/100);

		if ( $conn ) {
			$sql_last_id = mysql_fetch_array(mysql_query("SELECT id_kredytu FROM kredyt WHERE id_kredytu IN (SELECT MAX(id_kredytu) FROM kredyt)"));
			$dane_klienta = mysql_fetch_array(mysql_query('SELECT imie, nazwisko FROM klient WHERE id_klienta = '.$idKlienta.' '));
			$last_id = $sql_last_id["id_kredytu"];
			$last_id++; 
		}
			

		$sql1 = 'UPDATE konto SET id_kredytu = '.$last_id.' WHERE id_klienta = '.$idKlienta.' ';
	
		$retval = mysql_query( $sql1, $conn );
		if(! $retval ) {
		  die('Błąd: ' . mysql_error());
		} else {
			$sql2 = 'INSERT INTO kredyt (id_kredytu, kwota, oprocentowanie, raty, kwota_raty) VALUES ("'.$last_id.'", "'.$kwota.'", "'.$oprocentowanie.'", "'.$raty.'", "'.$kwota_raty.'")';
			$retval2 = mysql_query( $sql2, $conn );
			if(! $retval2 ) {
			  die('Kredyt nie został dodany: ' . mysql_error());
			} else {
				echo "Kredyt dodany.";
			}

			$history_data = date('Y/m/d H:i:s');
			$history = 'INSERT INTO historia'.'(id_pracownika, data, operacja) VALUES ("'.$_SESSION['id_pracownika'].'","'.$history_data.'", "Dodanie nowego kredytu dla klienta - '.$dane_klienta['imie'].' '.$dane_klienta['nazwisko'].'.")';
			$history_retval = mysql_query( $history, $conn );
			if(! $history_retval ) {
			  die('Błąd: ' . mysql_error());
			} 
				
		}

	}

?>