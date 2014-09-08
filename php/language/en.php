<?php

/*	--------------------------------------------------
	:: EN LANGUAGE
	-------------------------------------------------- */
	
	// Site Configuration
    
	$lang['website_title']		                           = 'PHP Ajax Contact Form'; 
    $lang['website_author']		                           = ''.$company.' - Designer Studio and Front-end Web Developer'; 
	$lang['website_description']		                   = 'PHP Ajax Contact Form a secure and lightweight contact ajax form for your Website'; 
	$lang['website_keywords']		                       = 'PHP Ajax Contact Form, Contact Form, google maps form, upload, email, phpmailer, smtp, autoresponder'; 
	
    // Form
	
    $lang['form_title']		                               = 'Have any Doubt ? Drop us a line';	
	$lang['form_placeholder_firstname']		               = 'Please enter your Firstname'; 
	$lang['form_placeholder_lastname']		               = 'Please enter your Lastname'; 
    $lang['form_placeholder_useremail']			           = 'Please enter your Email'; 
    $lang['form_placeholder_subject']			           = 'Please enter your Subject'; 
	$lang['form_placeholder_message']		               = 'Please enter your Message'; 
	$lang['form_option_1_department']		               = 'Select your Department'; 
 	$lang['form_option_2_department']		               = 'General'; 
	$lang['form_option_3_department']		               = 'Commercial'; 
	$lang['form_option_4_department']		               = 'Sales'; 
	$lang['form_option_5_department']		               = 'Deposit'; 
	$lang['form_option_6_department']		               = 'Withdraw'; 
	$lang['form_userfile_choose']		                   = 'Choose'; 
	$lang['form_placeholder_userfile1']		               = 'Enter your first upload File'; 
	$lang['form_placeholder_userfile2']		               = 'Enter your second upload File'; 
	$lang['form_placeholder_userfile3']		               = 'Enter your third upload File'; 
	$lang['form_placeholder_captcha']		               = 'Please enter Verification Code';
	$lang['form_button_submit']		                       = 'Send message'; 
	$lang['form_button_reset']		                       = 'Reset Fields'; 
	$lang['form_footer']		                           = 'Subscribe our Newsletter <a href="#">Click here</a>'; 
	
	// Form processor
	
    $lang['processor_wrong_security_token']		           = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 
    $lang['processor_according_department']		           = '<div class="error-message"><i class="icon-close"></i>Some error happen in Department configuration</div>'; 
  	$lang['processor_duplicate_email']	                   = '<div class="error-message"><i class="icon-close"></i>This email already exist in our Database</div>';
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