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
	$imieKlienta = $_POST['imie'];
	$nazwiskoKlienta = $_POST['nazwisko'];
	$peselKlienta = $_POST['pesel'];
?>
<!DOCTYPE html>
<html lang="pl">

 	<head>
 		<?php include 'include/head.php'; ?>
  		<title>PULPIT | Projekt programistyczny - bank PHP</title>
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
					                  		echo '<button type="button" class="btn btn-success squareBtn tl">';
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

								<?

								if ($idKlienta || $peselKlienta) {
				                	echo '<table class="table table-hover" style="margin-top: 80px;">';
				                  		echo '<tbody>';
					                    	if ($conn && $idKlienta) { 
						                    	mysql_select_db('logowanie');
												mysql_query("SET NAMES utf8");
						                    	$result = mysql_fetch_array(mysql_query("SELECT * FROM klient WHERE id_klienta = '".$idKlienta."' "));
						                    	$resultKonto = mysql_fetch_array(mysql_query("SELECT id_klienta, nr_konta, saldo, nr_konta2 FROM konto WHERE id_klienta = '".$idKlienta."' "));
					                  		}
					                    	if ($conn && $peselKlienta) { 
						                    	mysql_select_db('logowanie');
												mysql_query("SET NAMES utf8");
						                    	$result = mysql_fetch_array(mysql_query("SELECT * FROM klient WHERE pesel = '".$peselKlienta."' "));
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
				            	} 


				            	else if ( $imieKlienta && $nazwiskoKlienta ) {
				            		$flag = FALSE;
						            if ($conn) { 
							           	mysql_select_db('logowanie');
										mysql_query("SET NAMES utf8");
						            }
									$result = mysql_query("SELECT * FROM klient WHERE imie = '".$imieKlienta."' AND nazwisko = '".$nazwiskoKlienta."' ORDER BY imie ASC");
				            		if (mysql_num_rows($result) > 0) {
				            			$flag = TRUE;
					                	echo '<table class="table table-hover table-pointer" style="margin-top: 20px;">';
					                		echo '
							                  	<thead class="thead-inverse color-info">
							                    	<tr style="color:#fff; cursor: default; ">
							                      		<th>#</th>
							                      		<th>Imię</th>
							                      		<th>Nazwisko</th>
							                      		<th>PESEL</th>
							                      		<th>Data urodzenia</th>
							                      		<th>Numer konta</th>
							                    	</tr>
							                  	</thead>';
					                  		echo '<tbody>';
							                $i = 1;
							                while($row = mysql_fetch_array($result)) {
							                	$resultKonto = mysql_fetch_array(mysql_query("SELECT id_klienta, nr_konta FROM konto WHERE id_klienta = '".$row['id_klienta']."' "));
							                	echo '<tr class="clickable-row" data-href="/administrator-pulpit?id='.$row['id_klienta'].'" ">';
						                    	echo '<th scope="row">'.$i.'</th>';
						                      	echo '<td>'.$row['imie'].'</td>';
						                      	echo '<td>'.$row['nazwisko'].'</td>';
						                      	echo '<td>'.$row['pesel'].'</td>';
						                      	echo '<td>'.$row['data_urodzenia'].'</td>';
						                      	echo '<td>'.$resultKonto['nr_konta'].'</td>';
						                    	echo '</tr>';
							                    $i++;
							                }
						                echo '</tbody></table>';
					            	}

									if (!$flag) {
										$result2 = mysql_query(" SELECT * FROM klient WHERE imie LIKE '".$imieKlienta."%' AND nazwisko LIKE '".$nazwiskoKlienta."%' ORDER BY imie ASC");
					            		if (mysql_num_rows($result2) > 0) {
						                	echo '<table class="table table-hover table-pointer" style="margin-top: 20px;">';
						                		echo '
								                  	<thead class="thead-inverse color-info">
								                    	<tr style="color:#fff; cursor: default; ">
								                      		<th>#</th>
								                      		<th>Imię</th>
								                      		<th>Nazwisko</th>
								                      		<th>PESEL</th>
								                      		<th>Data urodzenia</th>
								                      		<th>Numer konta</th>
								                    	</tr>
								                  	</thead>';
						                  		echo '<tbody>';
						                  		$i = 1;
							            	while($row2 = mysql_fetch_array($result2)) {
									            $resultKonto = mysql_fetch_array(mysql_query("SELECT id_klienta, nr_konta FROM konto WHERE id_klienta = '".$row2['id_klienta']."' "));
									            echo '<tr class="clickable-row" data-href="/administrator-pulpit?id='.$row2['id_klienta'].'" ">';
								                echo '<th scope="row">'.$i.'</th>';
								                echo '<td>'.$row2['imie'].'</td>';
								                echo '<td>'.$row2['nazwisko'].'</td>';
								                echo '<td>'.$row2['pesel'].'</td>';
								                echo '<td>'.$row2['data_urodzenia'].'</td>';
								                echo '<td>'.$resultKonto['nr_konta'].'</td>';
								                echo '</tr>';
									            $i++;
							            	} 
						        			echo '</tbody></table>';
						           		}
						            	else  {
							                echo '<table class="table table-hover table-pointer" style="margin-top: 20px;">';
							                	echo '
									              	<thead class="thead-inverse color-info">
									                  	<tr style="color:#fff; cursor: default; ">
									                   		<th>#</th>
									                   		<th>Imię</th>
									                   		<th>Nazwisko</th>
									                   		<th>PESEL</th>
									                   		<th>Data urodzenia</th>
									                   		<th>Numer konta</th>
									                  	</tr>
									               	</thead>';
							                	echo '<tbody>';
								                   	echo '<th scope="row">-</th>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                  	echo '</tr>';	                   
								               	echo '</tbody>
								            </table>';
						            	}
					        		}
								}

				            	else if ($imieKlienta) {
				            		$flag = FALSE;
						            if ($conn) { 
							           	mysql_select_db('logowanie');
										mysql_query("SET NAMES utf8");
						            }
									$result = mysql_query("SELECT * FROM klient WHERE imie = '".$imieKlienta."' ORDER BY nazwisko ASC");
				            		if (mysql_num_rows($result) > 0) {
				            			$flag = TRUE;
					                	echo '<table class="table table-hover table-pointer" style="margin-top: 20px;">';
					                		echo '
							                  	<thead class="thead-inverse color-info">
							                    	<tr style="color:#fff; cursor: default; ">
							                      		<th>#</th>
							                      		<th>Imię</th>
							                      		<th>Nazwisko</th>
							                      		<th>PESEL</th>
							                      		<th>Data urodzenia</th>
							                      		<th>Numer konta</th>
							                    	</tr>
							                  	</thead>';
					                  		echo '<tbody>';
							                $i = 1;
							                while($row = mysql_fetch_array($result)) {
							                	$resultKonto = mysql_fetch_array(mysql_query("SELECT id_klienta, nr_konta FROM konto WHERE id_klienta = '".$row['id_klienta']."' "));
							                	echo '<tr class="clickable-row" data-href="/administrator-pulpit?id='.$row['id_klienta'].'" ">';
						                    	echo '<th scope="row">'.$i.'</th>';
						                      	echo '<td>'.$row['imie'].'</td>';
						                      	echo '<td>'.$row['nazwisko'].'</td>';
						                      	echo '<td>'.$row['pesel'].'</td>';
						                      	echo '<td>'.$row['data_urodzenia'].'</td>';
						                      	echo '<td>'.$resultKonto['nr_konta'].'</td>';
						                    	echo '</tr>';
							                    $i++;
							                }
						                echo '</tbody></table>';
					            	}

									if (!$flag) {
										$result2 = mysql_query(" SELECT * FROM klient WHERE imie LIKE '".$imieKlienta."%' ORDER BY nazwisko ASC");
					            		if (mysql_num_rows($result2) > 0) {
						                	echo '<table class="table table-hover table-pointer" style="margin-top: 20px;">';
						                		echo '
								                  	<thead class="thead-inverse color-info">
								                    	<tr style="color:#fff; cursor: default; ">
								                      		<th>#</th>
								                      		<th>Imię</th>
								                      		<th>Nazwisko</th>
								                      		<th>PESEL</th>
								                      		<th>Data urodzenia</th>
								                      		<th>Numer konta</th>
								                    	</tr>
								                  	</thead>';
						                  		echo '<tbody>';
						                  		$i = 1;
							            	while($row2 = mysql_fetch_array($result2)) {
									            $resultKonto = mysql_fetch_array(mysql_query("SELECT id_klienta, nr_konta FROM konto WHERE id_klienta = '".$row2['id_klienta']."' "));
									            echo '<tr class="clickable-row" data-href="/administrator-pulpit?id='.$row2['id_klienta'].'" ">';
								                echo '<th scope="row">'.$i.'</th>';
								                echo '<td>'.$row2['imie'].'</td>';
								                echo '<td>'.$row2['nazwisko'].'</td>';
								                echo '<td>'.$row2['pesel'].'</td>';
								                echo '<td>'.$row2['data_urodzenia'].'</td>';
								                echo '<td>'.$resultKonto['nr_konta'].'</td>';
								                echo '</tr>';
									            $i++;
							            	} 
						        			echo '</tbody></table>';
						           		}
						            	else  {
							                echo '<table class="table table-hover table-pointer" style="margin-top: 20px;">';
							                	echo '
									              	<thead class="thead-inverse color-info">
									                  	<tr style="color:#fff; cursor: default; ">
									                   		<th>#</th>
									                   		<th>Imię</th>
									                   		<th>Nazwisko</th>
									                   		<th>PESEL</th>
									                   		<th>Data urodzenia</th>
									                   		<th>Numer konta</th>
									                  	</tr>
									               	</thead>';
							                	echo '<tbody>';
								                   	echo '<th scope="row">-</th>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                  	echo '</tr>';	                   
								               	echo '</tbody>
								            </table>';
						            	}
					        		}
								}

				            	else if ($nazwiskoKlienta) {
				            		$flag = FALSE;
						            if ($conn) { 
							           	mysql_select_db('logowanie');
										mysql_query("SET NAMES utf8");
						            }
									$result = mysql_query("SELECT * FROM klient WHERE nazwisko = '".$nazwiskoKlienta."' ORDER BY imie ASC");
				            		if (mysql_num_rows($result) > 0) {
				            			$flag = TRUE;
					                	echo '<table class="table table-hover table-pointer" style="margin-top: 20px;">';
					                		echo '
							                  	<thead class="thead-inverse color-info">
							                    	<tr style="color:#fff; cursor: default; ">
							                      		<th>#</th>
							                      		<th>Imię</th>
							                      		<th>Nazwisko</th>
							                      		<th>PESEL</th>
							                      		<th>Data urodzenia</th>
							                      		<th>Numer konta</th>
							                    	</tr>
							                  	</thead>';
					                  		echo '<tbody>';
							                $i = 1;
							                while($row = mysql_fetch_array($result)) {
							                	$resultKonto = mysql_fetch_array(mysql_query("SELECT id_klienta, nr_konta FROM konto WHERE id_klienta = '".$row['id_klienta']."' "));
							                	echo '<tr class="clickable-row" data-href="/administrator-pulpit?id='.$row['id_klienta'].'" ">';
						                    	echo '<th scope="row">'.$i.'</th>';
						                      	echo '<td>'.$row['imie'].'</td>';
						                      	echo '<td>'.$row['nazwisko'].'</td>';
						                      	echo '<td>'.$row['pesel'].'</td>';
						                      	echo '<td>'.$row['data_urodzenia'].'</td>';
						                      	echo '<td>'.$resultKonto['nr_konta'].'</td>';
						                    	echo '</tr>';
							                    $i++;
							                }
						                echo '</tbody></table>';
					            	}

									if (!$flag) {
										$result2 = mysql_query(" SELECT * FROM klient WHERE nazwisko LIKE '".$nazwiskoKlienta."%' ORDER BY imie ASC");
					            		if (mysql_num_rows($result2) > 0) {
						                	echo '<table class="table table-hover table-pointer" style="margin-top: 20px;">';
						                		echo '
								                  	<thead class="thead-inverse color-info">
								                    	<tr style="color:#fff; cursor: default; ">
								                      		<th>#</th>
								                      		<th>Imię</th>
								                      		<th>Nazwisko</th>
								                      		<th>PESEL</th>
								                      		<th>Data urodzenia</th>
								                      		<th>Numer konta</th>
								                    	</tr>
								                  	</thead>';
						                  		echo '<tbody>';
						                  		$i = 1;
							            	while($row2 = mysql_fetch_array($result2)) {
									            $resultKonto = mysql_fetch_array(mysql_query("SELECT id_klienta, nr_konta FROM konto WHERE id_klienta = '".$row2['id_klienta']."' "));
									            echo '<tr class="clickable-row" data-href="/administrator-pulpit?id='.$row2['id_klienta'].'" ">';
								                echo '<th scope="row">'.$i.'</th>';
								                echo '<td>'.$row2['imie'].'</td>';
								                echo '<td>'.$row2['nazwisko'].'</td>';
								                echo '<td>'.$row2['pesel'].'</td>';
								                echo '<td>'.$row2['data_urodzenia'].'</td>';
								                echo '<td>'.$resultKonto['nr_konta'].'</td>';
								                echo '</tr>';
									            $i++;
							            	} 
						        			echo '</tbody></table>';
						           		}
						            	else  {
							                echo '<table class="table table-hover table-pointer" style="margin-top: 20px;">';
							                	echo '
									              	<thead class="thead-inverse color-info">
									                  	<tr style="color:#fff; cursor: default; ">
									                   		<th>#</th>
									                   		<th>Imię</th>
									                   		<th>Nazwisko</th>
									                   		<th>PESEL</th>
									                   		<th>Data urodzenia</th>
									                   		<th>Numer konta</th>
									                  	</tr>
									               	</thead>';
							                	echo '<tbody>';
								                   	echo '<th scope="row">-</th>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                   	echo '<td>-</td>';
								                  	echo '</tr>';	                   
								               	echo '</tbody>
								            </table>';
						            	}
					        		}
								}




				            	else  {
					                echo '<table class="table table-hover table-pointer" style="margin-top: 20px;">';
					                	echo '
							              	<thead class="thead-inverse color-info">
							                  	<tr style="color:#fff; cursor: default; ">
							                   		<th>#</th>
							                   		<th>Imię</th>
							                   		<th>Nazwisko</th>
							                   		<th>PESEL</th>
							                   		<th>Data urodzenia</th>
							                   		<th>Numer konta</th>
							                  	</tr>
							               	</thead>';
					                	echo '<tbody>';
						                   	echo '<th scope="row">-</th>';
						                   	echo '<td>-</td>';
						                   	echo '<td>-</td>';
						                   	echo '<td>-</td>';
						                   	echo '<td>-</td>';
						                   	echo '<td>-</td>';
						                  	echo '</tr>';	                   
						               	echo '</tbody>
						            </table>';
				            	}
				            ?>



				                <br />

				                <?php 
					                if ( $idKlienta ) {

					                	echo '
							                <a data-toggle="modal" data-target="#wplata" href="#wplata" type="button" class="btn btn-info squareBtn tl">
							                  	<span class="glyphicon glyphicon-plus-sign"></span> WPŁATA
							                </a>

							                <a data-toggle="modal" data-target="#wyplata" href="#wyplata" type="button" class="btn btn-info squareBtn tl">
							                  	<span class="glyphicon glyphicon-minus-sign"></span> WYPŁATA
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
	    <div class="modal fade" id="wplata" tabindex="-1" role="dialog" aria-labelledby="wplata" aria-hidden="true">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
	                    <h4 class="modal-title" id="myModalLabel">Wpłata</h4>
	                </div>
	                <div class="modal-body">
	                    <p>
	                      <form action="/dodaj/wplata" method="post" id="addWplata" name="addWplata" class="addWplata">

	                        <div class="form-group">
	                          <label for="inputNazwa">Kwota:</label>
	                          <input type="kwota" class="form-control" id="kwota" name="kwota" required data-fv-notempty-message="Pole nie może być puste!">
	                        </div>
	                        <input type="hidden" id="id_klienta" name="id_klienta" value='<?php echo $idKlienta; ?>'>
	                        <input type="submit" value="Wpłać" name="submitWplata" id="submitWplata" class="btn btn-success addWplataBtn"/>
	                        <b class="hidden_text">Wykonano!</b>
	                      </form>
	                    </p>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary" id="addWplataClose" data-dismiss="modal">Zamknij</button>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="modal fade" id="wyplata" tabindex="-1" role="dialog" aria-labelledby="wyplata" aria-hidden="true">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
	                    <h4 class="modal-title" id="myModalLabel">Wypłata</h4>
	                </div>
	                <div class="modal-body">
	                    <p>
	                      <form action="/dodaj/wyplata" method="post" id="addWyplata" name="addWyplata" class="addWyplata">

	                        <div class="form-group">
	                          <label for="inputNazwa">Kwota:</label>
	                          <input type="kwota" class="form-control" id="kwota" name="kwota" required data-fv-notempty-message="Pole nie może być puste!">
	                        </div>
	                        <input type="hidden" id="id_klienta" name="id_klienta" value='<?php echo $idKlienta; ?>'>
	                        <input type="submit" value="Wypłać" name="submitWyplata" id="submitWyplata" class="btn btn-success addWyplataBtn"/>
	                        <b class="hidden_text">Wykonano!</b>
	                      </form>
	                    </p>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary" id="addWyplataClose" data-dismiss="modal">Zamknij</button>
	                </div>
	            </div>
	        </div>
	    </div>

	    <script>
	    $(".modal-body form.addWplata").submit(function(e) {
	      var url = "/dodaj/wplata"; 
	        $.ajax({
	          type: "POST",
	          url: url,
	          data: $(this).serialize(), 
	          success: function(data) {
	            $('.hidden_text').css('display', 'block');
	            $('.addWplataBtn').css('display', 'none');
	            $('#addWplataClose').click(function() {
	              window.location.reload();
	            });        
	          }
	        });
	        e.preventDefault(); 
	    });

	    $(".modal-body form.addWyplata").submit(function(e) {
	      var url = "/dodaj/wyplata"; 
	        $.ajax({
	          type: "POST",
	          url: url,
	          data: $(this).serialize(), 
	          success: function(data) {
	            $('.hidden_text').css('display', 'block');
	            $('.addWyplataBtn').css('display', 'none');
	            $('#addWyplataClose').click(function() {
	              window.location.reload();
	            });        
	          }
	        });
	        e.preventDefault(); 
	    });

	  </script>


	</body>

</html>