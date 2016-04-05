<?php
ini_set('error_reporting', E_ALL & ~E_WARNING & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
    $path = $_SERVER['REQUEST_URI'];
    if(!isset($bodyId) || !isset($bodyId_other)) {
		if(eregi('^/klient', $path) == 1) {$bodyId = 'klient'; }
		elseif(eregi('^/administrator', $path) == 1) {$bodyId = 'administrator'; }
		elseif(eregi('^/uslugi', $path) == 1) {$bodyId = 'uslugi'; }
		elseif(eregi('^/kontakt', $path) == 1) {$bodyId = 'kontakt'; }
		else {$bodyId = 'home'; $bodyId_other = ''; $bodyId_other2 = ''; $bodyId_other3 = ''; }
	}
?>