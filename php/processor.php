<?php

    include dirname(__FILE__).'/csrf_protection/csrf-token.php';
	include dirname(__FILE__).'/csrf_protection/csrf-class.php';

    session_start();
	
	include dirname(__FILE__).'/config/config.php';
	
    $language = array('en' => 'en','pt' => 'pt');

	if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
		include dirname(__FILE__).'/language/'.$language[$_GET['lang']].'.php';
	} else {
		include dirname(__FILE__).'/language/en.php';
	}

    $firstname = strip_tags(trim($_POST["firstname"]));
    $lastname = strip_tags(trim($_POST["lastname"]));
	$useremail = strip_tags(trim($_POST["useremail"]));
    $usersubject = strip_tags(trim($_POST["usersubject"]));
    $usermessage = strip_tags(trim($_POST["usermessage"]));
    $department = strip_tags(trim($_POST["department"]));
	$verification = strip_tags(trim($_POST["captcha"]));
	
	$finalfirstname = htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8');
    $finallastname = htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8');
	$finaluseremail = htmlspecialchars($useremail, ENT_QUOTES, 'UTF-8');
    $finalusersubject = htmlspecialchars($usersubject, ENT_QUOTES, 'UTF-8');
    $finalusermessage = htmlspecialchars($usermessage, ENT_QUOTES, 'UTF-8');
    $finaldepartment = htmlspecialchars($department, ENT_QUOTES, 'UTF-8');
	$finalverification = htmlspecialchars($verification, ENT_QUOTES, 'UTF-8');
	
	if(!CSRF::check('contact-form')){
        echo $lang['processor_wrong_security_token'];
    } else {
	
		$file_basename1 = substr($_FILES["userfile1"]["name"], 0, strripos($_FILES["userfile1"]["name"], '.'));
	    $file_extension1 = substr($_FILES["userfile1"]["name"], strripos($_FILES["userfile1"]["name"], '.'));
		$file_basename2 = substr($_FILES["userfile2"]["name"], 0, strripos($_FILES["userfile2"]["name"], '.'));
	    $file_extension2 = substr($_FILES["userfile2"]["name"], strripos($_FILES["userfile2"]["name"], '.'));
		$file_basename3 = substr($_FILES["userfile3"]["name"], 0, strripos($_FILES["userfile3"]["name"], '.'));
	    $file_extension3 = substr($_FILES["userfile3"]["name"], strripos($_FILES["userfile3"]["name"], '.'));
                
		// Add a name to Random Files ID
		$finalname1 = md5($file_basename1).$file_extension1;
		$finalname2 = md5($file_basename2).$file_extension2;
		$finalname3 = md5($file_basename3).$file_extension3;

		// Move upload files to Folder Directory
		move_uploaded_file($_FILES['userfile1']['tmp_name'], '../upload/' .$finalname1);
		move_uploaded_file($_FILES['userfile2']['tmp_name'], '../upload/' .$finalname2);
		move_uploaded_file($_FILES['userfile3']['tmp_name'], '../upload/' .$finalname3);
			
		if ($SMTP == true) {
			
			if($according_department == true){
			
				if($finaldepartment == $lang['form_option_2_department']){
					$administrator = $admin_email_one;
					$name = $admin_name_one;
				} elseif($finaldepartment == $lang['form_option_3_department']){
					$administrator = $admin_email_two;
					$name = $admin_name_two;
				} elseif($finaldepartment == $lang['form_option_4_department']){
					$administrator = $admin_email_three;
					$name = $admin_name_three;
				} elseif($finaldepartment == $lang['form_option_5_department']){
					$administrator = $admin_email_four;
					$name = $admin_name_four;
				} elseif($finaldepartment == $lang['form_option_6_department']){
					$administrator = $admin_email_five;
					$name = $admin_name_five;
				} else {
					echo $lang['processor_according_department'];
				}
					
				include dirname(__FILE__).'/classes/PHPMailerAutoload.php';
				$language = array('en' => 'en','pt' => 'pt');
				if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
					include dirname(__FILE__).'/language/'.$language[$_GET['lang']].'.php';
				} else {
					include dirname(__FILE__).'/language/en.php';
				}
				include dirname(__FILE__).'/messages/message.php';

				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = $protocol;
				$mail->Host = $host;
				$mail->Port = $port;
				$mail->Username = $username;
				$mail->Password = $password;
				$mail->IsHTML(true);
				$mail->From = $finaluseremail;
				$mail->CharSet = "UTF-8";
				$mail->FromName = $finalfirstname . $finallastname;
				$mail->Encoding = "base64";
				$mail->Timeout = 200;
				$mail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
				$mail->ContentType = "text/html";
				$mail->addAddress($administrator, $name);
				$mail->Subject = $lang['processor_subject'];
				$mail->AddAttachment('../upload/'.$finalname1);
				$mail->AddAttachment('../upload/'.$finalname2);
				$mail->AddAttachment('../upload/'.$finalname3);
				$mail->Body = $message;
				$mail->AltBody = "To view this message, please use an HTML compatible email";

				if($automessage == true){		
					if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
								
									include dirname(__FILE__).'/messages/automessage.php';
												
									$automail = new PHPMailer();
									$automail->IsSMTP();
									$automail->SMTPAuth = true;
									$automail->SMTPSecure = $protocol;
									$automail->Host = $host;
									$automail->Port = $port;
									$automail->Username = $username;
									$automail->Password = $password;
									$automail->From = $administrator;
									$automail->FromName = $company;
									$automail->isHTML(true);
									$automail->CharSet = "UTF-8";
									$automail->Encoding = "base64";
									$automail->Timeout = 200;
									$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
									$automail->ContentType = "text/html";
									$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
									$automail->Subject = $lang['processor_automail_subject'];
									$automail->Body = $automessage;
									$automail->AltBody = "To view this message, please use an HTML compatible email";

									if ($automail->Send()) {
										echo $lang['contact_processor_successful'];				
									} else {
										echo $lang['contact_processor_unsuccessful'];
									}
							    }
						    }
						} else {
						    
							$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
								
								include dirname(__FILE__).'/messages/automessage.php';
												
								$automail = new PHPMailer();
								$automail->IsSMTP();
								$automail->SMTPAuth = true;
								$automail->SMTPSecure = $protocol;
								$automail->Host = $host;
								$automail->Port = $port;
								$automail->Username = $username;
								$automail->Password = $password;
								$automail->From = $administrator;
								$automail->FromName = $company;
								$automail->isHTML(true);
								$automail->CharSet = "UTF-8";
								$automail->Encoding = "base64";
								$automail->Timeout = 200;
								$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
								$automail->ContentType = "text/html";
								$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
								$automail->Subject = $lang['processor_automail_subject'];
								$automail->Body = $automessage;
								$automail->AltBody = "To view this message, please use an HTML compatible email";

								if ($automail->Send()) {
									echo $lang['contact_processor_successful'];				
								} else {
									echo $lang['contact_processor_unsuccessful'];
								}
							}
						}
					} else {
							
						if ($mail->Send()){
							
							include dirname(__FILE__).'/messages/automessage.php';
											
							$automail = new PHPMailer();
							$automail->IsSMTP();
							$automail->SMTPAuth = true;
							$automail->SMTPSecure = $protocol;
							$automail->Host = $host;
							$automail->Port = $port;
							$automail->Username = $username;
							$automail->Password = $password;
							$automail->From = $administrator;
							$automail->FromName = $company;
							$automail->isHTML(true);
							$automail->CharSet = "UTF-8";
							$automail->Encoding = "base64";
							$automail->Timeout = 200;
							$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
							$automail->ContentType = "text/html";
							$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
							$automail->Subject = $lang['processor_automail_subject'];
							$automail->Body = $automessage;
							$automail->AltBody = "To view this message, please use an HTML compatible email";

							if ($automail->Send()) {
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					}
				} else {
				    if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						} else {
						
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
							
						}
					} else { 
						if ($mail->Send()){
							echo $lang['processor_successful'];				
						} else {
							echo $lang['processor_unsuccessful'];
						}	
					}
				}
			} else {
				
				include dirname(__FILE__).'/classes/PHPMailerAutoload.php';
				include dirname(__FILE__).'/messages/message.php';

				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = $protocol;
				$mail->Host = $host;
				$mail->Port = $port;
				$mail->Username = $username;
				$mail->Password = $password;
				$mail->IsHTML(true);
				$mail->From = $finaluseremail;
				$mail->CharSet = "UTF-8";
				$mail->FromName = $finalfirstname . $finallastname;
				$mail->Encoding = "base64";
				$mail->Timeout = 200;
				$mail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
				$mail->ContentType = "text/html";
				$mail->addAddress($youremail, $yourname);
				$mail->Subject = $lang['processor_subject'];
				$mail->AddAttachment('../upload/'.$finalname1);
				$mail->AddAttachment('../upload/'.$finalname2);
				$mail->AddAttachment('../upload/'.$finalname3);
				$mail->Body = $message;
				$mail->AltBody = "To view this message, please use an HTML compatible email";

				if($automessage == true){
					if ($mysql == true){
					    if ($duplicate_email == true){ 
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
								
									include dirname(__FILE__).'/messages/automessage.php';
												
									$automail = new PHPMailer();
									$automail->IsSMTP();
									$automail->SMTPAuth = true;
									$automail->SMTPSecure = $protocol;
									$automail->Host = $host;
									$automail->Port = $port;
									$automail->Username = $username;
									$automail->Password = $password;
									$automail->From = $youremail;
									$automail->FromName = $company;
									$automail->isHTML(true);
									$automail->CharSet = "UTF-8";
									$automail->Encoding = "base64";
									$automail->Timeout = 200;
									$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
									$automail->ContentType = "text/html";
									$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
									$automail->Subject = $lang['processor_automail_subject'];
									$automail->Body = $automessage;
									$automail->AltBody = "To view this message, please use an HTML compatible email";

									if ($automail->Send()) {
										echo $lang['processor_successful'];				
									} else {
										echo $lang['processor_unsuccessful'];
									}
								}
							}
						} else {
						
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
								
								include dirname(__FILE__).'/messages/automessage.php';
												
								$automail = new PHPMailer();
								$automail->IsSMTP();
								$automail->SMTPAuth = true;
								$automail->SMTPSecure = $protocol;
								$automail->Host = $host;
								$automail->Port = $port;
								$automail->Username = $username;
								$automail->Password = $password;
								$automail->From = $youremail;
								$automail->FromName = $company;
								$automail->isHTML(true);
								$automail->CharSet = "UTF-8";
								$automail->Encoding = "base64";
								$automail->Timeout = 200;
								$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
								$automail->ContentType = "text/html";
								$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
								$automail->Subject = $lang['processor_automail_subject'];
								$automail->Body = $automessage;
								$automail->AltBody = "To view this message, please use an HTML compatible email";

								if ($automail->Send()) {
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						}	
					} else {
							
						if ($mail->Send()){
							
							include dirname(__FILE__).'/messages/automessage.php';
											
							$automail = new PHPMailer();
							$automail->IsSMTP();
							$automail->SMTPAuth = true;
							$automail->SMTPSecure = $protocol;
							$automail->Host = $host;
							$automail->Port = $port;
							$automail->Username = $username;
							$automail->Password = $password;
							$automail->From = $youremail;
							$automail->FromName = $company;
							$automail->isHTML(true);
							$automail->CharSet = "UTF-8";
							$automail->Encoding = "base64";
							$automail->Timeout = 200;
							$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
							$automail->ContentType = "text/html";
							$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
							$automail->Subject = $lang['processor_automail_subject'];
							$automail->Body = $automessage;
							$automail->AltBody = "To view this message, please use an HTML compatible email";

							if ($automail->Send()) {
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					}
			    } else {
				    if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						} else {
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					} else { 
						if ($mail->Send()){
							echo $lang['processor_successful'];				
						} else {
							echo $lang['processor_unsuccessful'];
						}	
					}
				}
			}
		} if ($sendmail == true) {
			
			if($according_department == true){
				
				if($finaldepartment == $lang['form_option_2_department']){
					$administrator = $admin_email_one;
					$name = $admin_name_one;
				} elseif($finaldepartment == $lang['form_option_3_department']){
					$administrator = $admin_email_two;
					$name = $admin_name_two;
				} elseif($finaldepartment == $lang['form_option_4_department']){
					$administrator = $admin_email_three;
					$name = $admin_name_three;
				} elseif($finaldepartment == $lang['form_option_5_department']){
					$administrator = $admin_email_four;
					$name = $admin_name_four;
				} elseif($finaldepartment == $lang['form_option_6_department']){
					$administrator = $admin_email_five;
					$name = $admin_name_five;
				} else {
					echo $lang['processor_according_department'];
				}
					
				include dirname(__FILE__).'/classes/PHPMailerAutoload.php';
				$language = array('en' => 'en','pt' => 'pt');
				if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
					include dirname(__FILE__).'/language/'.$language[$_GET['lang']].'.php';
				} else {
					include dirname(__FILE__).'/language/en.php';
				}
				include dirname(__FILE__).'/messages/message.php';

				$mail = new PHPMailer();
				$mail->isSendmail();
				$mail->IsHTML(true);
				$mail->From = $finaluseremail;
				$mail->CharSet = "UTF-8";
				$mail->FromName = $finalfirstname . $finallastname;
				$mail->Encoding = "base64";
				$mail->Timeout = 200;
				$mail->ContentType = "text/html";
				$mail->addAddress($administrator, $name);
				$mail->Subject = $lang['processor_subject'];
				$mail->AddAttachment('../upload/'.$finalname1);
				$mail->AddAttachment('../upload/'.$finalname2);
				$mail->AddAttachment('../upload/'.$finalname3);
				$mail->Body = $message;
				$mail->AltBody = "To view this message, please use an HTML compatible email";

                if($automessage == true){				
					if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
								
									include dirname(__FILE__).'/messages/automessage.php';
														
									$automail = new PHPMailer();
									$automail->isSendmail();
									$automail->From = $administrator;
									$automail->FromName = $company;
									$automail->isHTML(true);
									$automail->CharSet = "UTF-8";
									$automail->Encoding = "base64";
									$automail->Timeout = 200;
									$automail->ContentType = "text/html";
									$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
									$automail->Subject = $lang['processor_automail_subject'];
									$automail->Body = $automessage;
									$automail->AltBody = "To view this message, please use an HTML compatible email";

									if ($automail->Send()) {
										echo $lang['processor_successful'];				
									} else {
										echo $lang['processor_unsuccessful'];
									}
								}
							}
						} else {
						
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
								
								include dirname(__FILE__).'/messages/automessage.php';
														
								$automail = new PHPMailer();
								$automail->isSendmail();
								$automail->From = $administrator;
								$automail->FromName = $company;
								$automail->isHTML(true);
								$automail->CharSet = "UTF-8";
								$automail->Encoding = "base64";
								$automail->Timeout = 200;
								$automail->ContentType = "text/html";
								$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
								$automail->Subject = $lang['processor_automail_subject'];
								$automail->Body = $automessage;
								$automail->AltBody = "To view this message, please use an HTML compatible email";

								if ($automail->Send()) {
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						}
					} else {
									
						if ($mail->Send()){
							
							include dirname(__FILE__).'/messages/automessage.php';
													
							$automail = new PHPMailer();
							$automail->isSendmail();
							$automail->From = $administrator;
							$automail->FromName = $company;
							$automail->isHTML(true);
							$automail->CharSet = "UTF-8";
							$automail->Encoding = "base64";
							$automail->Timeout = 200;
							$automail->ContentType = "text/html";
							$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
							$automail->Subject = $lang['processor_automail_subject'];
							$automail->Body = $automessage;
							$automail->AltBody = "To view this message, please use an HTML compatible email";

							if ($automail->Send()) {
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					}
				} else {
				    if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						} else {
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					} else { 
						if ($mail->Send()){
							echo $lang['processor_successful'];				
						} else {
							echo $lang['processor_unsuccessful'];
						}	
					}
				}
		    } else {
					
			    include dirname(__FILE__).'/classes/PHPMailerAutoload.php';
				include dirname(__FILE__).'/messages/message.php';

				$mail = new PHPMailer();
				$mail->isSendmail();
				$mail->IsHTML(true);
				$mail->From = $finaluseremail;
				$mail->CharSet = "UTF-8";
				$mail->FromName = $finalfirstname . $finallastname;
			    $mail->Encoding = "base64";
				$mail->Timeout = 200;
				$mail->ContentType = "text/html";
				$mail->addAddress($youremail, $yourname);
				$mail->Subject = $lang['processor_subject'];
				$mail->AddAttachment('../upload/'.$finalname1);
				$mail->AddAttachment('../upload/'.$finalname2);
				$mail->AddAttachment('../upload/'.$finalname3);
				$mail->Body = $message;
				$mail->AltBody = "To view this message, please use an HTML compatible email";

                if($automessage == true){				
					if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
									
									include dirname(__FILE__).'/messages/automessage.php';
														
									$automail = new PHPMailer();
									$automail->isSendmail();
									$automail->From = $youremail;
									$automail->FromName = $company;
									$automail->isHTML(true);
									$automail->CharSet = "UTF-8";
									$automail->Encoding = "base64";
									$automail->Timeout = 200;
									$automail->ContentType = "text/html";
									$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
									$automail->Subject = $lang['processor_automail_subject'];
									$automail->Body = $automessage;
									$automail->AltBody = "To view this message, please use an HTML compatible email";

									if ($automail->Send()) {
										echo $lang['processor_successful'];				
									} else {
										echo $lang['processor_unsuccessful'];
									}
								}
							}
						} else {
						
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
									
								include dirname(__FILE__).'/messages/automessage.php';
														
								$automail = new PHPMailer();
								$automail->isSendmail();
								$automail->From = $youremail;
								$automail->FromName = $company;
								$automail->isHTML(true);
								$automail->CharSet = "UTF-8";
								$automail->Encoding = "base64";
								$automail->Timeout = 200;
								$automail->ContentType = "text/html";
								$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
								$automail->Subject = $lang['processor_automail_subject'];
								$automail->Body = $automessage;
								$automail->AltBody = "To view this message, please use an HTML compatible email";

								if ($automail->Send()) {
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						}
					} else  {
									
						if ($mail->Send()){
							
							include dirname(__FILE__).'/messages/automessage.php';
													
							$automail = new PHPMailer();
							$automail->isSendmail();
							$automail->From = $youremail;
							$automail->FromName = $company;
							$automail->isHTML(true);
							$automail->CharSet = "UTF-8";
							$automail->Encoding = "base64";
							$automail->Timeout = 200;
							$automail->ContentType = "text/html";
							$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
							$automail->Subject = $lang['processor_automail_subject'];
							$automail->Body = $automessage;
							$automail->AltBody = "To view this message, please use an HTML compatible email";

							if ($automail->Send()) {
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					}
				} else {
				    if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						} else {
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					} else { 
						if ($mail->Send()){
							echo $lang['processor_successful'];				
						} else {
							echo $lang['processor_unsuccessful'];
						}	
					}
				}
			}		
		} else {
				
		    if($according_department == true){
			
				if($finaldepartment == $lang['form_option_2_department']){
					$administrator = $admin_email_one;
					$name = $admin_name_one;
				} elseif($finaldepartment == $lang['form_option_3_department']){
					$administrator = $admin_email_two;
					$name = $admin_name_two;
				} elseif($finaldepartment == $lang['form_option_4_department']){
					$administrator = $admin_email_three;
					$name = $admin_name_three;
				} elseif($finaldepartment == $lang['form_option_5_department']){
					$administrator = $admin_email_four;
					$name = $admin_name_four;
				} elseif($finaldepartment == $lang['form_option_6_department']){
					$administrator = $admin_email_five;
					$name = $admin_name_five;
				} else {
					echo $lang['processor_according_department'];
				}
					
				include dirname(__FILE__).'/classes/PHPMailerAutoload.php';
				$language = array('en' => 'en','pt' => 'pt');
				if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
					include dirname(__FILE__).'/language/'.$language[$_GET['lang']].'.php';
				} else {
					include dirname(__FILE__).'/language/en.php';
				}
				include dirname(__FILE__).'/messages/message.php';

				$mail = new PHPMailer();
				$mail->IsHTML(true);
				$mail->From = $finaluseremail;
				$mail->CharSet = "UTF-8";
				$mail->FromName = $finalfirstname . $finallastname;
				$mail->Encoding = "base64";
				$mail->Timeout = 200;
				$mail->ContentType = "text/html";
				$mail->addAddress($administrator, $name);
				$mail->Subject = $lang['processor_subject'];
				$mail->AddAttachment('../upload/'.$finalname1);
				$mail->AddAttachment('../upload/'.$finalname2);
				$mail->AddAttachment('../upload/'.$finalname3);
				$mail->Body = $message;
				$mail->AltBody = "To view this message, please use an HTML compatible email";

				if($automessage == true){		
					if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
									
									include dirname(__FILE__).'/messages/automessage.php';
														
									$automail = new PHPMailer();
									$automail->From = $administrator;
									$automail->FromName = $company;
									$automail->isHTML(true);
									$automail->CharSet = "UTF-8";
									$automail->Encoding = "base64";
									$automail->Timeout = 200;
									$automail->ContentType = "text/html";
									$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
									$automail->Subject = $lang['processor_automail_subject'];
									$automail->Body = $automessage;
									$automail->AltBody = "To view this message, please use an HTML compatible email";

									if ($automail->Send()) {
										echo $lang['processor_successful'];				
									} else {
										echo $lang['processor_unsuccessful'];
									}
								}
							}
						} else {
						
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
									
								include dirname(__FILE__).'/messages/automessage.php';
														
								$automail = new PHPMailer();
								$automail->From = $administrator;
								$automail->FromName = $company;
								$automail->isHTML(true);
								$automail->CharSet = "UTF-8";
								$automail->Encoding = "base64";
								$automail->Timeout = 200;
								$automail->ContentType = "text/html";
								$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
								$automail->Subject = $lang['processor_automail_subject'];
								$automail->Body = $automessage;
								$automail->AltBody = "To view this message, please use an HTML compatible email";

								if ($automail->Send()) {
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						}
					} else {
										
						if ($mail->Send()){
							
							include dirname(__FILE__).'/messages/automessage.php';
													
							$automail = new PHPMailer();
							$automail->From = $administrator;
							$automail->FromName = $company;
							$automail->isHTML(true);
							$automail->CharSet = "UTF-8";
							$automail->Encoding = "base64";
							$automail->Timeout = 200;
							$automail->ContentType = "text/html";
							$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
							$automail->Subject = $lang['processor_automail_subject'];
							$automail->Body = $automessage;
							$automail->AltBody = "To view this message, please use an HTML compatible email";

							if ($automail->Send()) {
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					}
				} else {
				    if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						} else {
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					} else { 
						if ($mail->Send()){
							echo $lang['processor_successful'];				
						} else {
							echo $lang['processor_unsuccessful'];
						}	
					}
				}
			} else {
					
			    include dirname(__FILE__).'/classes/PHPMailerAutoload.php';
				include dirname(__FILE__).'/messages/message.php';

				$mail = new PHPMailer();
				$mail->IsHTML(true);
				$mail->From = $finaluseremail;
				$mail->CharSet = "UTF-8";
				$mail->FromName = $finalfirstname . $finallastname;
				$mail->Encoding = "base64";
				$mail->Timeout = 200;
				$mail->ContentType = "text/html";
				$mail->addAddress($youremail, $yourname);
				$mail->Subject = $lang['processor_subject'];
				$mail->AddAttachment('../upload/'.$finalname1);
				$mail->AddAttachment('../upload/'.$finalname2);
				$mail->AddAttachment('../upload/'.$finalname3);
				$mail->Body = $message;
				$mail->AltBody = "To view this message, please use an HTML compatible email";

                if($automessage == true){				
					if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
									
									include dirname(__FILE__).'/messages/automessage.php';
														
									$automail = new PHPMailer();
									$automail->From = $youremail;
									$automail->FromName = $company;
									$automail->isHTML(true);
									$automail->CharSet = "UTF-8";
									$automail->Encoding = "base64";
									$automail->Timeout = 200;
									$automail->ContentType = "text/html";
									$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
									$automail->Subject = $lang['processor_automail_subject'];
									$automail->Body = $automessage;
									$automail->AltBody = "To view this message, please use an HTML compatible email";

									if ($automail->Send()) {
										echo $lang['processor_successful'];				
									} else {
										echo $lang['processor_unsuccessful'];
									}
								}
							}
						} else {
						
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
									
								include dirname(__FILE__).'/messages/automessage.php';
														
								$automail = new PHPMailer();
								$automail->From = $youremail;
								$automail->FromName = $company;
								$automail->isHTML(true);
								$automail->CharSet = "UTF-8";
								$automail->Encoding = "base64";
								$automail->Timeout = 200;
								$automail->ContentType = "text/html";
								$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
								$automail->Subject = $lang['processor_automail_subject'];
								$automail->Body = $automessage;
								$automail->AltBody = "To view this message, please use an HTML compatible email";

								if ($automail->Send()) {
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						}
					} else {
										
						if ($mail->Send()){
							
							include dirname(__FILE__).'/messages/automessage.php';
													
							$automail = new PHPMailer();
							$automail->From = $youremail;
							$automail->FromName = $company;
							$automail->isHTML(true);
							$automail->CharSet = "UTF-8";
							$automail->Encoding = "base64";
							$automail->Timeout = 200;
							$automail->ContentType = "text/html";
							$automail->AddAddress($finaluseremail, $finalfirstname . $finallastname);
							$automail->Subject = $lang['processor_automail_subject'];
							$automail->Body = $automessage;
							$automail->AltBody = "To view this message, please use an HTML compatible email";

							if ($automail->Send()) {
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					}	
				} else {
				    if ($mysql == true){
					    if ($duplicate_email == true){
							$duplicate = mysql_query("SELECT * FROM ".$mysqltable_name." WHERE contact_form_useremail = '".mysql_real_escape_string($finaluseremail)."'");
							$result = mysql_num_rows($duplicate);
							if ($result == 1) {
								echo $lang['processor_duplicate_email'];
							} else {
								$sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
								$result = mysql_query($sql);
								if ($mail->Send()){
									echo $lang['processor_successful'];				
								} else {
									echo $lang['processor_unsuccessful'];
								}
							}
						} else {
						    $sql = "INSERT INTO ".$mysqltable_name." (contact_form_date,contact_form_firstname,contact_form_lastname,contact_form_useremail,contact_form_usersubject,contact_form_usermessage,contact_form_department) VALUES (CURRENT_TIMESTAMP,'".mysql_real_escape_string($finalfirstname)."','".mysql_real_escape_string($finallastname)."','".mysql_real_escape_string($finaluseremail)."','".mysql_real_escape_string($finalusersubject)."','".mysql_real_escape_string($finalusermessage)."','".mysql_real_escape_string($finaldepartment)."')";
							$result = mysql_query($sql);
							if ($mail->Send()){
								echo $lang['processor_successful'];				
							} else {
								echo $lang['processor_unsuccessful'];
							}
						}
					} else { 
						if ($mail->Send()){
							echo $lang['processor_successful'];				
						} else {
							echo $lang['processor_unsuccessful'];
						}	
					}
				}
			}
		}
    }	
?>