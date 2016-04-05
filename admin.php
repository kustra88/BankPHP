<?php
	session_start();
	include 'include/setBodyId.php'; 
?>
<!DOCTYPE html>
<html lang="pl">

 	<head>
 		<?php include 'include/head.php'; ?>
  		<title>USŁUGI | Projekt programistyczny - bank PHP</title>
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
	                <button type="button" class="btn btn-success btn-block squareBtn tl">
	                  <span class="glyphicon glyphicon-search"></span> Wyszukaj klienta
	                </button>
	                <button type="button" class="btn btn-info btn-block squareBtn tl">
	                  <span class="glyphicon glyphicon-user"></span> Zarejestruj klienta
	                </button>
	                <button type="button" class="btn btn-info btn-block squareBtn tl">
	                  <span class="glyphicon glyphicon-time"></span> Historia operacji
	                </button>
	                <button type="button" class="btn btn-info btn-block squareBtn tl">
	                  <span class="glyphicon glyphicon-calendar"></span> Kalendarz
	                </button><br /><br />
	                <button type="button" class="btn btn-warning btn-block squareBtn tl" style="margin-bottom: 5px;">
	                  <span class="glyphicon glyphicon-cog"></span> Ustawienia konta
	                </button>
 					<a href="wyloguj" class="logoutBtn">
	 					<button type="button" class="btn btn-danger btn-block squareBtn tl">
		                	<span class="glyphicon glyphicon-log-out"></span> Wyloguj
		                </button>
	                </a>

	              </div>
	            </div>
	            <div class="col-md-9 wow slideInRight" data-wow-duration="0.2s" data-wow-delay="0.4s">
	              <div class="padding10">
	                <h1>Wyszukaj klienta</h1>
	                <div class="input-group">
	                  <span class="input-group-addon" id="sizing-addon2"></span>
	                  <input type="text" class="form-control" placeholder="Imię" aria-describedby="sizing-addon2">
	                </div>
	                <br>
	                <div class="input-group">
	                  <span class="input-group-addon" id="sizing-addon2"></span>
	                  <input type="text" class="form-control" placeholder="Nazwisko" aria-describedby="sizing-addon2">
	                </div>
	                <br>
	                <div class="input-group">
	                  <span class="input-group-addon" id="sizing-addon2"></span>
	                  <input type="text" class="form-control" placeholder="PESEL" aria-describedby="sizing-addon2">
	                </div>
	                <br>
	                <div class="input-group">
	                  <span class="input-group-addon" id="sizing-addon2"></span>
	                  <input type="text" class="form-control" placeholder="Data urodzenia" aria-describedby="sizing-addon2">
	                </div>
	                <br>
	                <div class="input-group">
	                  <span class="input-group-addon" id="sizing-addon2"></span>
	                  <input type="text" class="form-control" placeholder="Numer konta" aria-describedby="sizing-addon2">
	                </div>
	                <br>
	                <button type="button" class="btn btn-info squareBtn btn-lg">
	                  <span class="glyphicon glyphicon-search"></span> Wyszukaj klienta
	                </button><br /><br /><br /><br />
	                <h1>wyniki: </h1>
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
	                    <tr>
	                      <th scope="row">1</th>
	                      <td>test</td>
	                      <td>test</td>
	                      <td>test</td>
	                      <td>test</td>
	                      <td>test</td>
	                    </tr>
	                      <tr>
	                      <th scope="row">2</th>
	                      <td>test</td>
	                      <td>test</td>
	                      <td>test</td>
	                      <td>test</td>
	                      <td>test</td>
	                    </tr>
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