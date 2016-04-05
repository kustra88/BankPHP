<?php include 'include/setBodyId.php'; ?>
<!DOCTYPE html>
<html lang="pl">

 	<head>
 		<?php include 'include/head.php'; ?>
  		<title>STRONA GŁÓWNA | Projekt programistyczny - bank PHP</title>
  	</head>

 	<body class="<?=$bodyId;?>">
 		<?php include 'include/mainNavigation.php'; ?>

 		<!-- content -->
	    <section id="logowanie">
	    	<div class="container">
	        	<div id="logowanie-inner">
	        		<div class="row">
	    				<div class="col-md-6 text-center wow slideInLeft" data-wow-duration="0.3s" data-wow-delay="0.5s">
	         				<img src="assets/img/other/skarbonka.png" class="skarbonka" style="max-width: 57%; opacity: 0.5;" /> 
	         			</div>
	         			<div class="col-md-6 text-center wow slideInRight" data-wow-duration="0.3s" data-wow-delay="0.5s">
	         				<div class="padding10 text-left">
		         				<h1>autorzy projektu:</h1>
		         				<ul style="list-style: none;">
		         					<li><h4>Piotr Kustra,</h4></li>
		         					<li><h4>Vladyslav Dzenziur,</h4></li>
		         					<li><h4>Aron Zieliński,</h4></li>
		         					<li><h4>Michał Majewski,</h4></li>
		         					<li><h4>Dawid Majdański,</h4></li>
		         					<li><h4>Krzysztof Dębowski,</h4></li>
		         					<li><h4>Michał Furtak,</h4></li>
		         					<li><h4>Damian Skiba</h4></li>
		         				</ul>
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