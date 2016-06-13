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


	$kwota = $_POST['kwota'];
	$idKlienta = $_POST['id_klienta'];
	$data = date('Y/m/d H:i:s');

	if ( is_numeric($kwota) ) {

		if ( $kwota > 0 ) {
			if ( $conn ) {
				$dane_klienta = mysql_fetch_array(mysql_query('SELECT imie, nazwisko FROM klient WHERE id_klienta = '.$idKlienta.' '));
			}

			$sql1 = 'UPDATE konto SET saldo = saldo + '.$kwota.' WHERE id_klienta = '.$idKlienta.'';
		
			$retval = mysql_query( $sql1, $conn );
			if(! $retval ) {
			  die('Błąd: ' . mysql_error());
			} else {
				$history_data = date('Y/m/d H:i:s');
				$history = 'INSERT INTO historia'.'(id_pracownika, data, operacja) VALUES ("'.$_SESSION['id_pracownika'].'","'.$history_data.'", "Wpłata - '.$dane_klienta['imie'].' '.$dane_klienta['nazwisko'].'.")';
				$history_retval = mysql_query( $history, $conn );
				if(! $history_retval ) {
				  die('Błąd: ' . mysql_error());
				} 			
			}

		}

	}

?>