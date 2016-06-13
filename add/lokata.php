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

	$nazwa = $_POST['nazwa'];
	$oprocentowanie = $_POST['oprocentowanie'];
	$kwota_pocz = $_POST['kwota'];
	$idKlienta = $_POST['id_klienta'];
	$data = date('Y/m/d H:i:s');

	if ( is_numeric($kwota_pocz) && is_numeric($oprocentowanie)) {
		$kwota = $kwota_pocz + (( $kwota_pocz*$oprocentowanie ) / 100);

		if ( $conn ) {
			$sql_last_id = mysql_fetch_array(mysql_query("SELECT id_lokaty FROM lokaty WHERE id_lokaty IN (SELECT MAX(id_lokaty) FROM lokaty)"));
			$dane_klienta = mysql_fetch_array(mysql_query('SELECT imie, nazwisko FROM klient WHERE id_klienta = '.$idKlienta.' '));
			$last_id = $sql_last_id["id_lokaty"];
			$last_id++; 
		}
			

		$sql1 = 'UPDATE konto SET id_lokaty = '.$last_id.' WHERE id_klienta = '.$idKlienta.'';
	
		$retval = mysql_query( $sql1, $conn );
		if(! $retval ) {
		  die('Błąd: ' . mysql_error());
		} else {
			$sql2 = 'INSERT INTO lokaty '.' (id_lokaty, nazwa, oprocentowanie, kwota_pocz, kwota, data_pocz) '.' VALUES ("'.$last_id.'", "'.$nazwa.'", "'.$oprocentowanie.'", "'.$kwota_pocz.'", "'.$kwota.'", "'.$data.'")';
			$retval2 = mysql_query( $sql2, $conn );
			if(! $retval2 ) {
			  die('Lokata nie została dodana: ' . mysql_error());
			} else {
				echo "Lokata dodana.";
			}

			$history_data = date('Y/m/d H:i:s');
			$history = 'INSERT INTO historia'.'(id_pracownika, data, operacja) VALUES ("'.$_SESSION['id_pracownika'].'","'.$history_data.'", "Dodanie nowej lokaty dla klienta - '.$dane_klienta['imie'].' '.$dane_klienta['nazwisko'].'.")';
			$history_retval = mysql_query( $history, $conn );
			if(! $history_retval ) {
			  die('Błąd: ' . mysql_error());
			} 			
		}

	}

?>