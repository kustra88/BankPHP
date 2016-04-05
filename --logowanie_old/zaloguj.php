<?php
	session_start();
	require_once "connect.php";

	$polaczenie=@new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{	
	$login= $_POST['login'];
	$haslo= $_POST['haslo'];
	
	$sql ="SELECT * FROM pracownik WHERE id_pracownika='$login' AND pin='$haslo'";
	
	if($rezultat =@$polaczenie->query($sql))
	{
		
		$ilu_userow = $rezultat->num_rows;
		if($ilu_userow>0)
		{
			$_SESSION['zalogowany']= true; // flaga ze jestesmy zalogowani
			
			$wiersz=$rezultat->fetch_assoc(); // tablica skojarzeniowa (asocjacyjna)- wszystkie wartosci z tego wiersza
			$_SESSION['id_pracownika'] = $wiersz['id_pracownika']; 
			$_SESSION['imie']=$wiersz['imie'];
			$_SESSION['nazwisko']=$wiersz['nazwisko'];
			
			unset($_SESSION['blad']); // jesli udalo sie zalogowac to wywal zmienną
			$rezultat->free(); //lub close() lub free_result(); zwalnianie 
			header('Location:administrator.html'); //nazwa strony glownej !!!
			
		}else{
			$_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło!</span>';
			header('Location: index.php');
			
			
		}
	}
	
	$polaczenie->close();
	}

?>