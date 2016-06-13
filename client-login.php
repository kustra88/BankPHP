<?php
	session_start();
	if(isset($_SESSION['zalogowany_c']) && ($_SESSION['zalogowany_c']==true))
	{
		header('Location: klient');
		exit(); // opuszczamy plik wykonuje sie tylko header
		}
	include 'include/setBodyId.php'; 
?>
<!DOCTYPE html>
<html lang="pl">

 	<head>
 		<?php include 'include/head.php'; ?>
  		<title>LOGOWANIE | Projekt programistyczny - bank PHP</title>
  	</head>

 	<body class="<?=$bodyId;?>">
 		<?php include 'include/mainNavigation.php'; ?>

 		<!-- content -->
	    <section id="logowanie">
	      <div class="container">
	        <div id="logowanie-inner">
	          <div class="row">
	            <div class="col-md-4 wow slideInLeft text-center" data-wow-duration="0.2s" data-wow-delay="0.4s">
	              <img src="assets/img/other/login.png" style="margin-top: 70px;" >
	            </div>
	            <div class="col-md-8 wow slideInRight" data-wow-duration="0.2s" data-wow-delay="0.4s">
	              <div class="login-form">
	                <h1>Panel klienta - logowanie</h1>
	                <?php
						if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
					?>
	                <form action="loginClient" method="post">
	                  <div class="form-group ">
	                    <input type="text" class="form-control" placeholder="Login " id="UserName" name="login">
	                    <i class="fa fa-user"></i>
	                  </div>
	                  <div class="form-group log-status">
	                    <input type="password" class="form-control" placeholder="Hasło" id="Passwod" name="haslo">
	                    <i class="fa fa-lock"></i>
	                  </div>
	                  <span class="alert">Nieprawidłowe dane!</span>
	                  <input class="log-btn" type="submit" value="ZALOGUJ SIĘ">
	                </form>
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