<?php
	session_start();
	session_destroy();
	header('Location: klient-logowanie');
?>