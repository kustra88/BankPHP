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
					                  		echo '<button type="button" class="btn btn-success squareBtn tl">';
					                    	echo '	<span class="glyphicon glyphicon-euro"></span> Kredyty';
					                  		echo '</button>';
				                  			echo '</a>';
				                  			
				                  			echo '<a href="administrator-nowy-rachunek?id='.$idKlienta.'" class="logoutBtn">';
					                  		echo '<button type="button" class="btn btn-info squareBtn tl">';
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
			                		$licznik = 0;
							        if ($conn) { 
								        mysql_select_db('logowanie');
										mysql_query("SET NAMES utf8");
						                $result = mysql_fetch_array(mysql_query("SELECT id_klienta, id_kredytu FROM konto WHERE id_klienta = '".$idKlienta."' "));
						                $kredyt = mysql_query("SELECT * FROM kredyt WHERE id_kredytu = '".$result['id_kredytu']."' ");
							        }

			                		if (mysql_num_rows($kredyt)==0) {
			                			echo '<h1>Brak kredytów!</h1>';
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
				                  			$licznik++;
					                    	echo '<tr>';
					                      	echo '	<th scope="row">'.$licznik.'</th>';
					                      	echo '	<td>'.$resultKredyt['kwota'].'</td>';
					                      	echo '	<td>'.$resultKredyt['raty'].'</td>';
					                      	echo '	<td>'.$resultKredyt['oprocentowanie'].'</td>';
					                    	echo '</tr>';
				                    	}

						                echo '</tbody></table>';
			                		}
			                	?><br />

				                <?php 
				                	if ( $licznik ==0 ) {
				                		echo '
							                <a data-toggle="modal" data-target="#dodajKredyt" href="#dodajKredyt"  type="button" class="btn btn-success squareBtn tl">
							                  	<span class="glyphicon glyphicon-ok"></span> DODAJ NOWY KREDYT
							                </a>
				                		';
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

	    <!-- modals -->
	    <div class="modal fade" id="dodajKredyt" tabindex="-1" role="dialog" aria-labelledby="dodajKredyt" aria-hidden="true">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
	                    <h4 class="modal-title" id="myModalLabel">Dodaj kredyt</h4>
	                </div>
	                <div class="modal-body">
	                    <p>
	                      <form action="/dodaj/dodaj-kredyt" method="post" id="addKredyt" name="addKredyt" class="addKredyt">

	                        <div class="form-group">
	                          <label for="inputNazwa">Kwota:</label>
	                          <input type="kwota" class="form-control" id="kwota" name="kwota" required data-fv-notempty-message="Pole nie może być puste!">
	                        </div>
	                        <div class="form-group">
	                          <label for="inputOprocentowanie">Oprocentowanie:</label>
	                          <input type="oprocentowanie" class="form-control" id="oprocentowanie" name="oprocentowanie" required data-fv-notempty-message="Pole nie może być puste!">
	                        </div>
	                        <div class="form-group">
	                          <label for="inputOpis">Raty:</label>
	                          <input type="raty" class="form-control" id="raty" name="raty" required data-fv-notempty-message="Pole nie może być puste!">
	                        </div>
	                        <input type="hidden" id="id_klienta" name="id_klienta" value='<?php echo $idKlienta; ?>'>


	                        <input type="submit" value="Dodaj kredyt" name="submitKredyt" id="submitKredyt" class="btn btn-success addKredytBtn"/>
	                        <b class="hidden_text">Kredyt dodany!</b>
	                      </form>
	                    </p>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary" id="addKredytClose" data-dismiss="modal">Zamknij</button>
	                </div>
	            </div>
	        </div>
	    </div>

	    <script>
	    $(".modal-body form.addKredyt").submit(function(e) {
	      var url = "/dodaj/dodaj-kredyt"; 
	        $.ajax({
	          type: "POST",
	          url: url,
	          data: $(this).serialize(), 
	          success: function(data) {
	            $('.hidden_text').css('display', 'block');
	            $('.addKredytBtn').css('display', 'none');
	            $('#addKredytClose').click(function() {
	              window.location.reload();
	            });        
	          }
	        });
	        e.preventDefault(); 
	    });
	  </script>

	</body>

</html>