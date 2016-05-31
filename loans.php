<?php
	include 'include/setBodyId.php'; 
	include 'include/db.php'; 
	session_start();
	if(!isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==false))
	{
		header('Location: administrator-logowanie');
		exit(); // opuszczamy plik wykonuje sie tylko header
	}
	$idKlienta = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="pl">

 	<head>
 		<?php include 'include/head.php'; ?>
  		<title>KREDYTY | Projekt programistyczny - bank PHP</title>
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
		                			<a href="zarejestruj-klienta" class="logoutBtn">
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
			            <div class="col-md-9 wow slideInRight" data-wow-duration="0.2s" data-wow-delay="0.4s">
			             	<div class="padding10">
			                	<div class="floatRight">
			                		<?php echo '<a href="administrator-pulpit?id='.$idKlienta.'" class="logoutBtn">'; ?>
				                  		<button type="button" class="btn btn-info squareBtn tl">
				                    		<span class="glyphicon glyphicon-home"></span> Pulpit
				                  		</button>
			                  		</a>
			                  		<?php echo '<a href="administrator-oszczednosci?id='.$idKlienta.'" class="logoutBtn">'; ?>
				                  		<button type="button" class="btn btn-info squareBtn tl">
				                    		<span class="glyphicon glyphicon-info-sign"></span> Oszczędności
				                  		</button>
			                  		</a>
			                  		<?php echo '<a href="administrator-kredyty?id='.$idKlienta.'" class="logoutBtn">'; ?>
				                  		<button type="button" class="btn btn-success squareBtn tl">
				                    		<span class="glyphicon glyphicon-euro"></span> Kredyty
				                  		</button>
			                  		</a>
			                  		<?php echo '<a href="administrator-nowy-rachunek?id='.$idKlienta.'" class="logoutBtn">'; ?>
				                  		<button type="button" class="btn btn-info squareBtn tl">
				                    		<span class="glyphicon glyphicon-credit-card"></span> Nowy rachunek
				                  		</button>
			                  		</a>
			                  		<?php echo '<a href="administrator-historia-operacji?id='.$idKlienta.'" class="logoutBtn">'; ?>
				                  		<button type="button" class="btn btn-info squareBtn tl">
				                    		<span class="glyphicon glyphicon-transfer"></span> Historia
				                  		</button>
			                  		</a>
			                  		<?php echo '<a href="administrator-edycja-danych?id='.$idKlienta.'" class="logoutBtn">'; ?>
				                  		<button type="button" class="btn btn-warning squareBtn tl">
				                    		<span class="glyphicon glyphicon-edit"></span> Edycja danych
				                  		</button>
			                  		</a>
			                	</div>

			                	<?php

							        if ($conn) { 
								        mysql_select_db('logowanie');
										mysql_query("SET NAMES utf8");
						                $result = mysql_fetch_array(mysql_query("SELECT id_klienta, id_kredytu FROM konto WHERE id_klienta = '".$idKlienta."' "));
						                $kredyt = mysql_query("SELECT * FROM kredyt WHERE id_kredytu = '".$result['id_kredytu']."' ");
							        }

			                		if (mysql_num_rows($kredyt)==0) {
			                			echo '<h1 style="margin-top: 80px;">Brak kredytów!</h1>';
			                		} else {
										echo '<table class="table" style="margin-top: 80px;">';
							            echo '<thead class="thead-inverse color-info">
						                    	<tr>
						                      		<th>Nr</th>
						                      		<th>Pozostała kwota</th>
						                      		<th>Pozostałe raty</th>
						                      		<th>Oprocentowanie</th>
						                    	</tr>
						                  	</thead>
						                  	<tbody>';
							                  	
				                  		while($resultKredyt = mysql_fetch_array($kredyt)) {
					                    	echo '<tr>';
					                      	echo '	<th scope="row">'.$resultKredyt['id_kredytu'].'</th>';
					                      	echo '	<td>'.$resultKredyt['kwota'].'</td>';
					                      	echo '	<td>'.$resultKredyt['raty'].'</td>';
					                      	echo '	<td>'.$resultKredyt['oprocentowanie'].'</td>';
					                    	echo '</tr>';
				                    	}

						                echo '</tbody></table>';
			                		}
			                	?><br />

				                <h1>Nowy kredyt:</h1>
				                <table class="table table-hover">
				                  	<tbody>
				                   		<tr>
				                     		<th scope="row">KWOTA:</th>
				                      		<td></td>
				                    	</tr>
				                    	<tr>
				                      		<th scope="row">ILOŚĆ RAT:</th>
				                      		<td></td>
				                    	</tr>
				                    	<tr>
				                      		<th scope="row">OPROCENTOWANIE:</th>
				                      		<td></td>
				                    	</tr>
				                  	</tbody>
				                </table>
				                <button type="button" class="btn btn-success squareBtn tl">
				                  	<span class="glyphicon glyphicon-ok"></span> WYKONAJ
				                </button>
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