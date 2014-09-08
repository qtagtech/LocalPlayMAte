<?php

/*	--------------------------------------------------
	:: ES LANGUAGE
	-------------------------------------------------- */
	
	// Site Configuration
    
	$lang['website_title']		                           = 'Local  PLAYMATE - Premium Escort Service'; 
    $lang['website_author']		                           = ''.$company; 
	$lang['website_description']		                   = 'La más novedosa red de Escorts Premium del mundo. Nadie te maneja, tu controlas tus tiempos, dinero, clientes y además estás seguro y si quieres, no manejas efectivo y recibes pagos en el mismo día.'; 
	$lang['website_keywords']		                       = ''; 
	
    // Form
	$lang['form_intro_title']							   = 'Inicia Ya el Proceso de Pre-Casting';
    $lang['form_title']		                               = 'Llena el formulario, envía una copia de tu cédula, 3 fotos (Cuerpo entero de frente, espalda y perfil) y si cumples unos requisitos mínimos serás llamado a un segundo Casting Virtual para poder ingresar a trabajar con la plataforma.';	
	$lang['form_placeholder_firstname']		               = 'Nombres'; 
	$lang['form_placeholder_lastname']		               = 'Apellidos'; 
    $lang['form_placeholder_useremail']			           = 'Email'; 
    $lang['form_placeholder_cedula']			           = 'Número de Cédula'; 
	$lang['form_placeholder_userphone']		               = 'Celular'; 
	$lang['form_option_1_city']		               			= 'Ciudad de Residencia'; 
 	$lang['form_option_2_city']		               			= 'Bogotá'; 
	$lang['form_option_3_city']		              			= 'Medellín'; 
	$lang['form_userfile_choose']		                   = 'Selecciona'; 
	$lang['form_placeholder_userfilecedula']		       = 'Copia de Cédula'; 
	$lang['form_placeholder_userfilefront']		           = 'Foto de Frente'; 
	$lang['form_placeholder_userfileback']		           = 'Foto de Espalda'; 
	$lang['form_placeholder_userfileprofile']		       = 'Foto de Perfil'; 
	$lang['form_placeholder_captcha']		               = 'Escribe el código';
	$lang['form_button_submit']		                       = 'Inscribirme'; 
	$lang['form_button_reset']		                       = 'Borrar'; 
	$lang['form_footer']		                           = 'Subscribe our Newsletter <a href="#">Click here</a>'; 

	//Form Validator Error Messages
	$lang['error_form_placeholder_firstname']		         	    = 'Debes indicar tu nombre completo.'; 
	$lang['error_form_placeholder_lastname']		            	= 'Debes indicar tus apellidos.'; 
    $lang['error_form_placeholder_useremail']			       	 	= 'No has puesto un email válido.'; 
    $lang['error_form_placeholder_cedula']			  		        = 'Es necesario indicar tu número de cédula.'; 
	$lang['error_form_placeholder_userphone']		      	        = 'Tu celular es necesario en caso de contactarte.'; 
	$lang['error_form_option_1_city']		            			= 'No has escogido una ciudad.'; 
	$lang['error_form_placeholder_userfilesize']		       		= 'El tamaño del archivo qe¿ue intentas subir es demasiado grande.'; 
	$lang['error_form_placeholder_userfile']		           		= 'No has seleccionado ningún archivo'; 
	$lang['error_form_placeholder_userfiletype']		           	= 'El archivo que subas debe ser de tipo JPG, PNG, GIF, PDF, PSD, DOC, DOCX, RAR, o ZIP';
	$lang['error_form_placeholder_captcha_put']		               	= 'Debes escribir el código que sale en el recuadro de la izquierda para comprobar que eres real.'; 
	$lang['error_form_placeholder_captcha_type']		            = 'No has escrito el código bien. Inténtalo de nuevo por favor.';


	
	// Form processor
	
    $lang['processor_wrong_security_token']		           = '<div class="error-message"><i class="icon-close"></i>¡Atención! Hubo un error de seguridad en el sistema.</div>'; 
    $lang['processor_according_city']		           = '<div class="error-message"><i class="icon-close"></i>Hay errores en la selección de ciudad.</div>'; 
  	$lang['processor_duplicate_email']	                   = '<div class="error-message"><i class="icon-close"></i>Este correo ya se encuentra en nuestra base de datos.</div>';
    $lang['processor_subject']				               = 'Message from '.$company.' Support Form';   	
	$lang['processor_automail_subject']	                   = 'We received your ticket from our Support form';
	$lang['processor_successful']				           = '<div class="success-message"><i class="icon-checkmark"></i>Congratulations! Your Message has been sent</div>';
	$lang['processor_unsuccessful']				           = '<div class="error-message"><i class="icon-close"></i>Attention! There is an Error when send email</div>';

	// Message form
	 
    $lang['message_form_1']		                           = 'Hello '.$name.''; 
	$lang['message_form_2']		                           = 'A person called '.$_POST["firstname"].' '.$_POST["lastname"].' has contact you'; 
	$lang['message_form_3']		                           = 'Their Email is : '.$_POST["useremail"].''; 
    $lang['message_form_4']                                = 'Their Subject is : '.$_POST["usersubject"].'';
	$lang['message_form_5']		                           = 'Their Message is : '.$_POST["usermessage"].''; 
	$lang['message_form_6']		                           = 'Their Department is : '.$_POST["department"].''; 
	$lang['message_form_7']		                           = 'Client IP Address is : '.$_SERVER['REMOTE_ADDR'].''; 
    $lang['message_form_8']                                = 'This Email was sent on : '.$localtime.'';
	
	// Automessage form
	 
    $lang['automessage_form_1']		                       = 'Hello '.$_POST["firstname"].' '.$_POST["lastname"].''; 
	$lang['automessage_form_2']		                       = 'We receive your ticket from our Support Form'; 
	$lang['automessage_form_3']		                       = 'We will process your ticket as soon as possible'; 
    $lang['automessage_form_4']                            = 'If you need any support from us please contact us again';
	$lang['automessage_form_5']                            = 'Our website address : <a href="'.$website.'">'.$website.'</a>';	


	

	
?>