<?php
	include 'include/setBodyId.php'; 
	include 'include/db.php'; 
	session_start();
	if(!isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==false))
	{
		header('Location: administrator-logowanie');
		exit(); // opuszczamy plik wykonuje sie tylko header
	}
?>
<!DOCTYPE html>
<html lang="pl">

 	<head>
 		<?php include 'include/head.php'; ?>
  		<title>ADMINISTRATOR | Projekt programistyczny - bank PHP</title>
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
			                	<h1>Wyszukaj klienta</h1>
			                	<div class="input-group">
			                  		<span class="input-group-addon" id="sizing-addon2"></span>
			                  		<input type="text" class="form-control" placeholder="Imię" aria-describedby="sizing-addon2">
			                	</div><br>
			                	<div class="input-group">
			                  		<span class="input-group-addon" id="sizing-addon2"></span>
			                  		<input type="text" class="form-control" placeholder="Nazwisko" aria-describedby="sizing-addon2">
			                	</div><br>
			                	<div class="input-group">
			                  		<span class="input-group-addon" id="sizing-addon2"></span>
			                  		<input type="text" class="form-control" placeholder="PESEL" aria-describedby="sizing-addon2">
			                	</div><br>
			                	<div class="input-group">
			                  		<span class="input-group-addon" id="sizing-addon2"></span>
			                  		<input type="text" class="form-control" placeholder="Data urodzenia" aria-describedby="sizing-addon2">
			                	</div><br>
			                	<div class="input-group">
			                  		<span class="input-group-addon" id="sizing-addon2"></span>
			                  		<input type="text" class="form-control" placeholder="Numer konta" aria-describedby="sizing-addon2">
			                	</div><br>
				                <button type="button" class="btn btn-info squareBtn btn-lg">
				                  <span class="glyphicon glyphicon-search"></span> Wyszukaj klienta
				                </button><br /><br /><br /><br />

				                <h1>lista wszystkich klientów: </h1>
				                <table class="table">
				                  	<thead class="thead-inverse color-info">
				                    	<tr>
				                      		<th>#</th>
				                      		<th>Imię</th>
				                      		<th>Nazwisko</th>
				                      		<th>PESEL</th>
				                      		<th>Data urodzenia</th>
				                      		<th>Numer konta</th>
				                    	</tr>
				                  	</thead>
				                  	<tbody>
					                    <? 
					                    	if ($conn) { 
						                    	mysql_select_db('logowanie');
												mysql_query("SET NAMES utf8");
						                    	$result = mysql_query("SELECT * FROM klient");
						                    	$i = 1;
						                      	while($row = mysql_fetch_array($result)) {
						                      		$resultKonto = mysql_fetch_array(mysql_query("SELECT id_klienta, nr_konta FROM konto WHERE id_klienta = '".$row['id_klienta']."' "));
						                      		echo '<tr>';
					                      			echo '<th scope="row">'.$i.'</th>';
					                      			echo '<td>'.$row['imie'].'</td>';
					                      			echo '<td>'.$row['nazwisko'].'</td>';
					                      			echo '<td>'.$row['pesel'].'</td>';
					                      			echo '<td>'.$row['data_urodzenia'].'</td>';
					                      			echo '<td>'.$resultKonto['nr_konta'].'</td>';
					                    			echo '</tr>';
						                        	$i++;
						                      	}
					                  		}
					                    ?>
				                  	</tbody>
				                </table>
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