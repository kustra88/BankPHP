<?php
	include 'include/setBodyId.php'; 
	include 'include/db.php'; 
	session_start();
	if(!isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==false))
	{
		header('Location: administrator.php');
		exit(); // opuszczamy plik wykonuje sie tylko header
	}
	
	if (!isset($_POST["reg-id"]) || !isset($_POST["reg-name1"]) || !isset($_POST["reg-name2"]) || !isset($_POST["reg-pesel"]) || !isset($_POST["reg-date"]) || $_POST["reg-id"] == "" || $_POST["reg-name1"] == "" || $_POST["reg-name2"] == "" || $_POST["reg-pesel"] == "" || $_POST["reg-date"] == "")
	{
		$message = "Wprowadzono błędne dane!";
		$add_result = false;
	}
	else
	{	
		$add_result = false; 
		
		$id    = $_POST["reg-id"];
		$name1 = $_POST["reg-name1"];
		$name2 = $_POST["reg-name2"];
		$pesel = $_POST["reg-pesel"];
		$date  = $_POST["reg-date"];
		
		$db_id = addslashes($id);
		$db_name1 = addslashes($name1);
		$db_name2 = addslashes($name2);
		$db_pesel = addslashes($pesel);
		$db_date = addslashes($date);
						
		mysql_select_db('logowanie');
		mysql_query("SET NAMES utf8");
		$sql = "UPDATE klient SET id_klienta='$db_id', imie='$name1', nazwisko='$name2', pesel='$pesel', data_urodzenia='$db_date' WHERE id_klienta=$db_id";
		$result = mysql_query($sql, $conn);			
		
			if (!$result)
			    $message = "Błąd bazy danych: ".mysql_error($conn);
			else
			{
				$add_result = true;
		 		$message = "Dane zmienione poprawnie!";
			}
	}
?>
<!DOCTYPE html>
<html lang="pl">

 	<head>
 		<?php include 'include/head.php'; ?>
  		<title>Edytuj dane - Podsumowanie | Projekt programistyczny - bank PHP</title>
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
			                	<h1>Podsumowanie</h1>
			                	<?php
								 if (!$add_result)
								 	echo "<p>".$message."</p>";
								 else
								 { 
								 	echo "<p>".$message."</p>";
									 // popraw tutaj tą tabelkę 
									echo "<table class='table'>";
				                    echo "<tr>";
								    echo "<th>Imię: ".$name1."</td>";
				                    echo "<th>Nazwisko: ".$name2."</th>";
				                    echo "<th>PESEL: ".$pesel."</th>";
				                    echo "<th>Data urodzenia: ".$date."</th>";
				                    echo "</tr>";
									echo "</table";
								 }
								
								?>
				            
                            <!-- Miejsce na guzik powrotu --> 
				            </div>
				        </div>
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
