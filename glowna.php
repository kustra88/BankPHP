<?php
session_start();
?>
<!DOCTYPE HTML> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">  

<head>  
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" /> 
<title>Panel logowania</title>
</head>
<body> 
<?php

echo"<p>Test ".$_SESSION['imie']." ".$_SESSION['nazwisko'];

?>
</body>  

</html>