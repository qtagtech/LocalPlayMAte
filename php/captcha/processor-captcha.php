<?php

	session_start();
	
	if (strtoupper($_GET['captcha']) == $_SESSION['captcha_id']) {
        echo 'true';
	} else {
	    echo 'false';
	}
	
?>