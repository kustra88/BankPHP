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

	$idKlienta = $_POST['id_klienta'];

  	$dlugoscCiagu = 25;
  	$znaki = array(1,2,3,4,5,6,7,8,9,0);
  	$losowyCiag = "";
  	$i = 1;
	do
	{
		$los = rand(0,9);
		$losowyCiag .= $znaki[$los];    
		$i++;
	}
	while( $i<=$dlugoscCiagu );
  
	if ( $conn ) {
		$dane_klienta = mysql_fetch_array(mysql_query('SELECT imie, nazwisko FROM klient WHERE id_klienta = '.$idKlienta.' '));
		$nowe_konto = mysql_fetch_array(mysql_query('SELECT * FROM konto WHERE id_klienta = '.$idKlienta.' '));
	}
 	
 	if ( $nowe_konto['nr_konta2'] != $losowyCiag ) {
		$sql = 'UPDATE konto SET nr_konta2 = '.$losowyCiag.' WHERE id_klienta = "'.$idKlienta.'"';


 		$retval = mysql_query( $sql, $conn);
 		if ( !$retval ) {
 			die('Błąd: ' . mysql_error());
 		}
 		else {
 			echo "Dodano!";
 		}

 		$history_data = date('Y/m/d H:i:s');
		$history = 'INSERT INTO historia'.'(id_pracownika, data, operacja) VALUES ("'.$_SESSION['id_pracownika'].'","'.$history_data.'", "Utworzenie nowego rachunku - '.$dane_klienta['imie'].' '.$dane_klienta['nazwisko'].'.")';
		$history_retval = mysql_query( $history, $conn );
		if(! $history_retval ) {
		  die('Błąd: ' . mysql_error());
		} 	
 	}

?>

