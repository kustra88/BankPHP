
<?php
	include 'include/setBodyId.php'; 
	include 'include/db.php'; 
	session_start();
	if(!isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==false))
	{
		header('Location: administrator.php');
		exit(); // opuszczamy plik wykonuje sie tylko header
	}
?>
<!DOCTYPE html>
<html lang="pl">

 	<head>
 		<?php include 'include/head.php'; ?>
  		<title>Dodaj klienta | Projekt programistyczny - bank PHP</title>
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
	 								<a href="wyloguj" class="logoutBtn">
		 								<button type="button" class="btn btn-danger btn-block squareBtn tl">
			                				<span class="glyphicon glyphicon-log-out"></span> Wyloguj
			                			</button>
		                			</a>
	                			</div>
	              			</div>
	            		</div>

			            <div class="col-md-9 wow slideInRight" data-wow-duration="0.2s" data-wow-delay="0.4s">
                         <form action="/podsumowanie" method="post">
			              	<div class="padding10">
			                	<h1>Zarejestruj klienta</h1>
			                	<div class="input-group">
			                  		<span class="input-group-addon" id="sizing-addon2"></span>
			                  		<input type="text" class="form-control" name="reg-name1" placeholder="Imię" aria-describedby="sizing-addon2">
			                	</div><br>
			                	<div class="input-group">
			                  		<span class="input-group-addon" id="sizing-addon2"></span>
			                  		<input type="text" class="form-control" name="reg-name2" placeholder="Nazwisko" aria-describedby="sizing-addon2">
			                	</div><br>
			                	<div class="input-group">
			                  		<span class="input-group-addon" id="sizing-addon2"></span>
			                  		<input type="text" class="form-control" name="reg-pesel" placeholder="PESEL" aria-describedby="sizing-addon2">
			                	</div><br>
			                	<div class="input-group">
			                  		<span class="input-group-addon" id="sizing-addon2"></span>
			                  		<input type="text" class="form-control" name="reg-date" placeholder="Data urodzenia" aria-describedby="sizing-addon2">
			                	</div><br>
				                <input class="log-btn" type="submit" value="Dodaj klienta">
                                <br /><br /><br /><br />

				               
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