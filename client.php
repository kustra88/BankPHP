<?php
	include 'include/setBodyId.php'; 
	include 'include/db.php'; 
	session_start();
	if(!isset($_SESSION['zalogowany_c']) && ($_SESSION['zalogowany_c']==false))
	{
		header('Location: klient-logowanie');
		exit(); // opuszczamy plik wykonuje sie tylko header
	}
	mysql_select_db('logowanie');
	mysql_query("SET NAMES utf8");
?>
<!DOCTYPE html>
<html lang="pl">

 	<head>
 		<?php include 'include/head.php'; ?>
  		<title>KLIENT | Projekt programistyczny - bank PHP</title>
  	</head>

 	<body class="<?=$bodyId;?>">
 		<div class="container">
 			<div class="row">
 				<div class="col-md-12 text-right">
 					<?php echo"<h4 style='margin-top:10px;margin-bottom:-10px;'>Zalogowany jako: <b>".$_SESSION['imie']." ".$_SESSION['nazwisko']."</b>

					<a href='klient-wyloguj' style='color:red;'>Wyloguj</a>
 					</h4>"; ?>
 				</div>
 			</div>
 		</div>

 		<?php include 'include/mainNavigation.php'; ?>

 		<!-- content -->
	    <section id="logowanie">
	      	<div class="container">
	        	<div id="logowanie-inner">
	         		<div class="row">
	            		<div class="col-md-12 wow slideInLeft text-left" data-wow-duration="0.2s" data-wow-delay="0.4s">
	              			<div class="padding10">
	              			<?

				                	echo '<table class="table table-hover" style="margin-top: 30px;">';
				                  		echo '<tbody>';
					                    	if ($conn) { 
					                    		
						                    	$result = mysql_fetch_array(mysql_query("SELECT * FROM klient WHERE nazwisko = '".$_SESSION['nazwisko']."' "));
						                    	$resultKonto = mysql_fetch_array(mysql_query("SELECT id_klienta, nr_konta, saldo, nr_konta2 FROM konto WHERE id_klienta = '".$result['id_klienta']."' "));
					                  		}
				                    	echo '<tr>
				                      		<th scope="row">IMIĘ:</th>
				                     		<td>';
				                     				echo $result['imie'];
				                     		echo '</td>
				                    	</tr>
				                    	<tr>
				                     		<th scope="row">NAZWISKO:</th>
				                      		<td>';
				                     				echo $result['nazwisko'];
				                     		
				                      		echo '</td>
				                    	</tr>
				                    	<tr>
				                      		<th scope="row">PESEL:</th>
				                      		<td>';
				                     				echo $result['pesel'];			                      			
				                      		echo '</td>
				                    	</tr>
				                    	<tr>
				                      		<th scope="row">DATA URODZENIA:</th>
				                      		<td>';
				                     				echo $result['data_urodzenia'];			                      			
				                      		echo '</td>
				                    	</tr>
				                    	<tr>
				                      		<th scope="row">RACHUNEK:</th>
				                      		<td>';
				                     				echo $resultKonto['nr_konta'];	

				                     		if ( $resultKonto['nr_konta2'] != "" )       
				                     			echo '<br />'.$resultKonto['nr_konta2'];	               			
				                      		echo '</td>
				                    	</tr>
				                    	<tr>
				                      		<th scope="row">SALDO:</th>
				                      		<td>';
				                     				echo $resultKonto['saldo'];	                      			
				                      		echo '</td>
					                    	</tr>
					                  	</tbody>
					                </table>';
				            	
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
	</body>

</html>