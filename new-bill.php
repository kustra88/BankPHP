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
  		<title>NOWY RACHUNEK | Projekt programistyczny - bank PHP</title>
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
						                    	$resultKonto = mysql_fetch_array(mysql_query("SELECT * FROM konto WHERE pesel = '".$peselKlienta."' "));
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
					                  		echo '<button type="button" class="btn btn-success squareBtn tl">';
					                    	echo '	<span class="glyphicon glyphicon-credit-card"></span> Nowy rachunek';
					                  		echo '</button>';
				                  			echo '</a>';
				                  		
				                  			echo '<a href="administrator-edycja-danych?id='.$idKlienta.'" class="logoutBtn">';
					                  		echo '<button type="button" class="btn btn-warning squareBtn tl">';
					                    	echo '	<span class="glyphicon glyphicon-edit"></span> Edycja danych';
					                  		echo '</button>';
				                  			echo '</a>';
			                  			}
			                  		
			                  		?>

			                	</div>

			                	<?php

					                if ( $conn ) { 
						                mysql_select_db('logowanie');
										mysql_query("SET NAMES utf8");
						                $resultKonto = mysql_fetch_array(mysql_query("SELECT * FROM konto WHERE id_klienta = '".$idKlienta."' "));

					                  	}

			                		if ( $resultKonto['nr_konta2'] == "" ) {

				                		echo '
							                <a data-toggle="modal" data-target="#dodajRachunek" href="#dodajRachunek" type="button" class="btn btn-success squareBtn tl">
							                  	<span class="glyphicon glyphicon-ok"></span> DODAJ NOWY RACHUNEK
							                </a>
				                		';
			                		} else {
			                			echo "<h3 style='margin-top:80px;'>Brak możliwości utworzenia kolejnego rachunku!</h1>";
			                		}


				                ?>
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

	    <div class="modal fade" id="dodajRachunek" tabindex="-1" role="dialog" aria-labelledby="dodajRachunek" aria-hidden="true">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
	                    <h4 class="modal-title" id="myModalLabel">Dodaj rachunek</h4>
	                </div>
	                <div class="modal-body">
	                    <p>
	                      <form action="/dodaj/rachunek" method="post" id="addRachunek" name="addRachunek" class="addRachunek">

	                      	<center><h1>Potwierdź!</h1></center>
	                        <input type="hidden" id="id_klienta" name="id_klienta" value='<?php echo $idKlienta; ?>'>

	                        <input type="submit" value="Dodaj rachunek" name="submitRachunek" id="submitRachunek" class="btn btn-success addRachunekBtn"/>
	                        <b class="hidden_text">Wykonano!</b>
	                      </form>
	                    </p>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary" id="addRachunekClose" data-dismiss="modal">Zamknij</button>
	                </div>
	            </div>
	        </div>
	    </div>

	    <script>
	    $(".modal-body form.addRachunek").submit(function(e) {
	      var url = "/dodaj/rachunek"; 
	        $.ajax({
	          type: "POST",
	          url: url,
	          data: $(this).serialize(), 
	          success: function(data) {
	            $('.hidden_text').css('display', 'block');
	            $('.addRachunekBtn').css('display', 'none');
	            $('#addRachunekClose').click(function() {
	              window.location.reload();
	            });        
	          }
	        });
	        e.preventDefault(); 
	    });
	  </script>
	</body>

</html>