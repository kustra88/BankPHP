<?php
	session_start();
	if(!isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==false))
	{
		header('Location: administrator-logowanie');
		exit(); // opuszczamy plik wykonuje sie tylko header
	}
	include 'include/setBodyId.php'; 
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
			                		<a href="administrator-pulpit" class="logoutBtn">
				                  		<button type="button" class="btn btn-info squareBtn tl">
				                    		<span class="glyphicon glyphicon-home"></span> Pulpit
				                  		</button>
			                  		</a>
			                  		<a href="administrator-oszczednosci" class="logoutBtn">
				                  		<button type="button" class="btn btn-info squareBtn tl">
				                    		<span class="glyphicon glyphicon-info-sign"></span> Oszczędności
				                  		</button>
			                  		</a>
			                  		<a href="administrator-kredyty" class="logoutBtn">
				                  		<button type="button" class="btn btn-info squareBtn tl">
				                    		<span class="glyphicon glyphicon-euro"></span> Kredyty
				                  		</button>
			                  		</a>
			                  		<a href="administrator-nowy-rachunek" class="logoutBtn">
				                  		<button type="button" class="btn btn-success squareBtn tl">
				                    		<span class="glyphicon glyphicon-credit-card"></span> Nowy rachunek
				                  		</button>
			                  		</a>
			                  		<a href="administrator-historia-operacji" class="logoutBtn">
				                  		<button type="button" class="btn btn-info squareBtn tl">
				                    		<span class="glyphicon glyphicon-transfer"></span> Historia
				                  		</button>
			                  		</a>
			                  		<a href="administrator-edycja-danych" class="logoutBtn">
				                  		<button type="button" class="btn btn-warning squareBtn tl">
				                    		<span class="glyphicon glyphicon-edit"></span> Edycja danych
				                  		</button>
			                  		</a>
			                	</div>

			                	<div class="input-group" style="margin-top: 80px;">
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