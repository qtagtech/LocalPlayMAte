<?php

/*	--------------------------------------------------
	:: PT LANGUAGE
	-------------------------------------------------- */
	
	// Site Configuration
    	
    $lang['website_title']		                           = 'Formulário de contacto PHP & Ajax'; 
    $lang['website_author']		                           = ''.$company.' - Estúdio de desenhador e devenvolvedor Web'; 
	$lang['website_description']		                   = 'Formulário de contacto PHP & Ajax um formulário seguro e leve para o seu site'; 
	$lang['website_keywords']		                       = 'Formulário de contacto PHP & Ajax, google maps, formulário de contacto, contacto, upload de arquivos, phpmailer, auto resposta, smtp'; 
	
    // Form
	
    $lang['form_title']		                               = 'Tem alguma dúvida ? Envie-nos uma mensagem';	
	$lang['form_placeholder_firstname']		               = 'Insira o seu primeiro Nome';
	$lang['form_placeholder_lastname']		               = 'Insira o seu último Nome'; 
    $lang['form_placeholder_useremail']			           = 'Insira o seu endereço de Email'; 
    $lang['form_placeholder_subject']			           = 'Insira o seu Assunto'; 
	$lang['form_placeholder_message']		               = 'Insira a sua Mensagem'; 
	$lang['form_option_1_department']		               = 'Seleccione o seu Departamento'; 
 	$lang['form_option_2_department']		               = 'Outros assuntos'; 
	$lang['form_option_3_department']		               = 'Comercial'; 
	$lang['form_option_4_department']		               = 'Vendas'; 
	$lang['form_option_5_department']		               = 'Depositos'; 
	$lang['form_option_6_department']		               = 'Levantamentos'; 
	$lang['form_userfile_choose']		                   = 'Escolha'; 
	$lang['form_placeholder_userfile1']		               = 'Insira o seu primeiro arquivo para upload'; 
	$lang['form_placeholder_userfile2']		               = 'Insira o seu segundo arquivo para upload'; 
	$lang['form_placeholder_userfile3']		               = 'Insira o seu terceiro arquivo para upload'; 
	$lang['form_placeholder_captcha']		               = 'Insira o código de Verificação';
	$lang['form_button_submit']		                       = 'Enviar Mensagem'; 
	$lang['form_button_reset']		                       = 'Agagar os dados'; 
	$lang['form_footer']		                           = 'Subscreva a nossas Campanhas de email <a href="#">Clique Aqui</a>'; 
	
	// Form processor
	
    $lang['processor_wrong_security_token']		           = '<div class="error-message"><i class="icon-close"></i>Atenção o seu código de segurança está errado</div>'; 
    $lang['processor_according_department']		           = '<div class="error-message"><i class="icon-close"></i>Algum erro aconteceu na configuração dos departamentos</div>'; 
  	$lang['processor_duplicate_email']	                   = '<div class="error-message"><i class="icon-close"></i>Este email já existe na nossa base de dados</div>';
    $lang['processor_subject']				               = 'Mensagem enviada do formulário de suporte '.$company.'';   	
	$lang['processor_automail_subject']	                   = 'Nós recebemos o seu pedido de suporte';
	$lang['processor_successful']				           = '<div class="success-message"><i class="icon-checkmark"></i>Parabéns! A sua mensagem foi enviada com successo</div>';
	$lang['processor_unsuccessful']				           = '<div class="error-message"><i class="icon-close"></i>Atenção! Ouve um erro ao enviar a sua mensagem</div>';

	// Message form
	 
    $lang['message_form_1']		                           = 'Olá '.$name.''; 
	$lang['message_form_2']		                           = 'Uma pessoa chamada '.$_POST["firstname"].' '.$_POST["lastname"].' contactou-o'; 
	$lang['message_form_3']		                           = 'O seu email é : '.$_POST["useremail"].''; 
    $lang['message_form_4']                                = 'O seu assunto é : '.$_POST["usersubject"].'';
	$lang['message_form_5']		                           = 'A sua mensagem é : '.$_POST["usermessage"].''; 
	$lang['message_form_6']		                           = 'O seu departamento é : '.$_POST["department"].''; 
	$lang['message_form_7']		                           = 'O IP do cliente é : '.$_SERVER['REMOTE_ADDR'].''; 
    $lang['message_form_8']                                = 'Este email foi enviado em : '.$localtime.'';
	
	// Automessage form
	 
    $lang['automessage_form_1']		                       = 'Olá '.$_POST["firstname"].' '.$_POST["lastname"].''; 
	$lang['automessage_form_2']		                       = 'Nós recebemos o seu pedido de suporte no nosso email'; 
	$lang['automessage_form_3']		                       = 'Iremos processar o seu pedido tão breve quanto possivel'; 
    $lang['automessage_form_4']                            = 'Se precisar de alguma ajuda adicional não hesite em contactar-nos';
	$lang['automessage_form_5']                            = 'O nosso endereço da web : <a href="'.$website.'">'.$website.'</a>';	 
?>