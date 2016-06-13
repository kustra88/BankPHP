<!-- MUSISZ PRZEKAZAĆ ID_KLIENTA który MA BYĆ EDYTOWANY np. $id_klienta -->

<?php
	include 'include/setBodyId.php'; 
	include 'include/db.php'; 
	session_start();
	if(!isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==false))
	{
		header('Location: administrator.php');
		exit(); // opuszczamy plik wykonuje sie tylko header
	}
	
 // wczytywanie danych z BD
 	// tutaj dodaj wczytywanie zmiennej $id_klienta
	$id_klienta = 1; // test
	$sql = "SELECT imie, nazwisko, pesel, data_urodzenia FROM Klient WHERE id_klienta = $id_klienta";  
	$result = mysqli_query($conn, $sql);
	$array = mysqli_fetch_array($result);
	
	if (!$array)
	{
	 	$message = "Nie można wczytać danych tego klienta. ".mysqli_error($conn);
	}
	else
	{	
		$name1 = $array["imie"];
		$name2 = $array["nazwisko"];
		$pesel = $array["pesel"];
		$bdate = $array["data_urodzenia"];
	}
	
?>
<!DOCTYPE html>
<html lang="pl">

 	<head>
 		<?php include 'include/head.php'; ?>
  		<title>Edytuj dane | Projekt programistyczny - bank PHP</title>
  	</head>

 	<body class="<?=$bodyId;?>">
 		<div class="container">
 			<div class="row">
 				<div class="col-md-12 text-right">
 					<?php echo"<h4 style='margin-top:10px;margin-bottom:-10px;'>Zalogowany jako: <b>".$_SESSION['imie']." ".$_SESSION['nazwisko']."</b></h4>"; ?>
 				</div>
 			</div>
 		</div>

 		<?php include 'include/mainNavigation.php'; ?>

 		<!-- content -->
	    <section id="logowanie">
	      	<div class="container">
	        	<div id="logowanie-inner">
	         		<div class="row">
	            		<div class="col-md-3 wow slideInLeft text-left" data-wow-duration="0.2s" data-wow-delay="0.4s">
	              			<div class="padding10">
	              				<div class="marginTop5">
		              				<a href="administrator" class="logoutBtn">
			                			<button type="button" class="btn btn-info btn-block squareBtn tl">
			                  				<span class="glyphicon glyphicon-search"></span> Wyszukaj klienta
			                			</button>
		                			</a>
	                			</div>
	                			<div class="marginTop5">
		                			<a href="register-client.php" class="logoutBtn">
			                			<button type="button" class="btn btn-success btn-block squareBtn tl">
			                  				<span class="glyphicon glyphicon-user"></span> Zarejestruj klienta
			                			</button>
		                			</a>
	                			</div>
	                			<div class="marginTop5">
		                			<a href="historia-operacji" class="logoutBtn">
			                			<button type="button" class="btn btn-info btn-block squareBtn tl">
			                  				<span class="glyphicon glyphicon-time"></span> Historia operacji
			                			</button>
		                			</a>
	                			</div>
	                			<div class="marginTop5">
		                			<a href="kalendarz" class="logoutBtn">
			                			<button type="button" class="btn btn-info btn-block squareBtn tl">
			                  				<span class="glyphicon glyphicon-calendar"></span> Kalendarz
			                			</button>
		                			</a>
	                			</div><br /><br />
	                			<a href="ustawienia" class="logoutBtn">
		                			<button type="button" class="btn btn-warning btn-block squareBtn tl">
		                  				<span class="glyphicon glyphicon-cog"></span> Ustawienia konta
		                			</button>
	                			</a>
	                			<div class="marginTop5">
	 								<a href="wyloguj" class="logoutBtn">
		 								<button type="button" class="btn btn-danger btn-block squareBtn tl">
			                				<span class="glyphicon glyphicon-log-out"></span> Wyloguj
			                			</button>
		                			</a>
	                			</div>
	              			</div>
	            		</div>
						<?php
						if (!$array)
						{
							echo "<p>".$message."</p>";
						}
						else
						{
			            echo "<div class='col-md-9 wow slideInRight' data-wow-duration='0.2s' data-wow-delay='0.4s'>\n
                         <form action='edit-client-result.php' method='post'>\n
			              	<div class='padding10'>\n
			                	<h1>Edytuj dane klienta</h1>\n
								<input type='hidden' name='reg-id' value='".$id_klienta."'>\n
			                	<div class='input-group'>\n
			                  		<span class='input-group-addon' id='sizing-addon2'></span>\n
			                  		<input type='text' class='form-control' name='reg-name1' placeholder='Imię' aria-describedby='sizing-addon2' value='".$name1."'>\n
			                	</div><br>\n
			                	<div class='input-group'>\n
			                  		<span class='input-group-addon' id='sizing-addon2'></span>\n
			                  		<input type='text' class='form-control' name='reg-name2' placeholder='Nazwisko' aria-describedby='sizing-addon2' value='".$name2."'>\n
			                	</div><br>\n
			                	<div class='input-group'>\n
			                  		<span class='input-group-addon' id='sizing-addon2'></span>\n
			                  		<input type='text' class='form-control' name='reg-pesel' placeholder='PESEL' aria-describedby='sizing-addon2' value='".$pesel."'>\n
			                	</div><br>\n
			                	<div class='input-group'>\n
			                  		<span class='input-group-addon' id='sizing-addon2'></span>\n
			                  		<input type='text' class='form-control' name='reg-date' placeholder='Data urodzenia' aria-describedby='sizing-addon2' value='".$bdate."'>\n
			                	</div><br>\n
				                <input class='log-btn' type='submit' value='Zatwierdź zmiany'>\n
                                <br /><br /><br /><br />\n\n\n


				               
				            </div>\n
				        </div>\n
	          		</div>\n
	        	</div>";
			} 
			?>
	      	</div>
	    </section>
 		<!-- /content -->

 		<?php 
 			include 'include/footer.php'; 
 			include 'include/scripts.php'; 
 		?>
	</body>

</html>