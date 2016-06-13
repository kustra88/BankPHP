<?php
	include 'include/setBodyId.php'; 
	include 'include/db.php'; 
	session_start();
	if(!isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==false))
	{
		header('Location: administrator.php');
		exit(); // opuszczamy plik wykonuje sie tylko header
	}
	
	$idKlienta = $_GET['id']; // test

	if ( $conn ) {
		mysql_select_db('logowanie');
		mysql_query("SET NAMES utf8");
		$sql = mysql_query("SELECT imie, nazwisko, pesel, data_urodzenia FROM klient WHERE id_klienta = $idKlienta");  
		$array = mysql_fetch_array($sql);
	}
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
			                			<button type="button" class="btn btn-success btn-block squareBtn tl">
			                  				<span class="glyphicon glyphicon-search"></span> Wyszukaj klienta
			                			</button>
		                			</a>
	                			</div>
	                			<div class="marginTop5">
		                			<a href="register-client.php" class="logoutBtn">
			                			<button type="button" class="btn btn-info btn-block squareBtn tl">
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
	 								<a href="wyloguj" class="logoutBtn">
		 								<button type="button" class="btn btn-danger btn-block squareBtn tl">
			                				<span class="glyphicon glyphicon-log-out"></span> Wyloguj
			                			</button>
		                			</a>
	                			</div>
	              			</div>
	            		</div>

			            <div class="col-md-9 wow slideInRight" data-wow-duration="0.2s" data-wow-delay="0.4s">
			             	<div class="padding10">
			                	<div class="floatRight">


			                		<?php 

					                    if ($conn && $peselKlienta) { 
						                    	mysql_select_db('logowanie');
												mysql_query("SET NAMES utf8");
						                    	$result = mysql_fetch_array(mysql_query("SELECT * FROM klient WHERE pesel = '".$peselKlienta."' "));
						                    	$idKlienta = $result['id_klienta'];
					                  	}

			                			if ( $idKlienta ) {
				                			echo '<a href="administrator-pulpit?id='.$idKlienta.'" class="logoutBtn">'; 
					                  		echo '<button type="button" class="btn btn-info squareBtn tl">';
					                    	echo '	<span class="glyphicon glyphicon-home"></span> Pulpit';
					                  		echo '</button>';
				                  			echo '</a>';
				                  			
				                  			echo '<a href="administrator-oszczednosci?id='.$idKlienta.'" class="logoutBtn">';
					                  		echo '<button type="button" class="btn btn-info squareBtn tl">';
					                    	echo '	<span class="glyphicon glyphicon-info-sign"></span> Oszczędności';
					                  		echo '</button>';
				                  			echo '</a>';
				                  			
				                  			echo '<a href="administrator-kredyty?id='.$idKlienta.'" class="logoutBtn">';
					                  		echo '<button type="button" class="btn btn-info squareBtn tl">';
					                    	echo '	<span class="glyphicon glyphicon-euro"></span> Kredyty';
					                  		echo '</button>';
				                  			echo '</a>';
				                  			
				                  			echo '<a href="administrator-nowy-rachunek?id='.$idKlienta.'" class="logoutBtn">';
					                  		echo '<button type="button" class="btn btn-info squareBtn tl">';
					                    	echo '	<span class="glyphicon glyphicon-credit-card"></span> Nowy rachunek';
					                  		echo '</button>';
				                  			echo '</a>';
				                  		
				                  			echo '<a href="administrator-edycja-danych?id='.$idKlienta.'" class="logoutBtn">';
					                  		echo '<button type="button" class="btn btn-success squareBtn tl">';
					                    	echo '	<span class="glyphicon glyphicon-edit"></span> Edycja danych';
					                  		echo '</button>';
				                  			echo '</a>';
			                  			}
			                  		
			                  		?>


			                	</div>

								<?php
								if (!$array)
								{
									echo "<p>".$message."</p>";
								}
								else
								{
						            echo "
			                         <form action='/edycja-podsumowanie' method='post'>\n
						              	<div class='padding10'>\n
						                	<h1>Edytuj dane klienta</h1>\n
											<input type='hidden' name='reg-id' value='".$idKlienta."'>\n
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
				        				</div>";
									} 
								?>


		              		</div>
	            		</div>
	      		</div>
	    </section>
 		<!-- /content -->

 		<?php 
 			include 'include/footer.php'; 
 			include 'include/scripts.php'; 
 		?>
	</body>

</html>
