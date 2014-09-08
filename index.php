<?php
// Turn off all error reporting
error_reporting(0);
    
	include dirname(__FILE__).'/php/csrf_protection/csrf-token.php';
	include dirname(__FILE__).'/php/csrf_protection/csrf-class.php';
	
	include dirname(__FILE__).'/php/config/config.php';
	
	$language = array('es'=>'es','en' => 'en','pt' => 'pt');

	if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
		include dirname(__FILE__).'/php/language/'.$language[$_GET['lang']].'.php';
	} else {
		include dirname(__FILE__).'/php/language/es.php';
	}
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php 
  	require 'vendor/autoload.php';
 
	use Parse\ParseClient;
 
	ParseClient::initialize('BvaGdIVblCHcJPqXfLRhmsfnwOcQQsDrEG7M5sN9', 'lH58zjciislH6Usg90j5kl0j0fPZkcDE9QUcfEIw', 'YhNLMjR1smdrmAcheQbREbVVuzHx2xJjuIVgMtIC');
	use Parse\ParseObject;
 
$testObject = ParseObject::create("TestObject");
$testObject->set("foo", "bar");
$testObject->set("user","juanda");
$testObject->save();
  ?>
    <meta charset="utf-8">
    <meta name="author" content="<?php echo $lang['website_author'];?>">
	<meta name="description" content="<?php echo $lang['website_description'];?>">
	<meta name="keywords" content="<?php echo $lang['website_keywords'];?>">
    <title><?php echo $lang['website_title'];?></title>
		
		<!-- Viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/png" href="<?php echo $baseurl;?>images/favicon.png">
		
		<!-- Css Styles -->
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/settings.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/tooltipster.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/responsive.css">
		
		<!-- Font Link -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>		

	    

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/style-flat2.css" rel="stylesheet"> <!-- CSS for Blue(Payday List) Layout -->
    <link href="css/style-responsive.css" rel="stylesheet">
	 
	 <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,400italic' rel='stylesheet' type='text/css'><!-- Google Web Fonts - Lato -->
	 <link href="css/animate.min.css" rel="stylesheet"> <!-- Animated CSS  -->
	 <link href="css/flexslider.css" rel="stylesheet"> <!-- Flexslider CSS  -->
    <!-- Custom Flexslider Style -->
    <style>
	    .flexslider-testimonial{
			margin-top: 40px;
			margin-bottom: 20px;
			min-height: 200px;
			position: relative;
			zoom: 1;
			border: none;
			box-shadow: none;
			text-align: center;
			background: url(img/bubble.png) no-repeat center top;
			padding-top: 80px;
	    }
	    
	    .flexslider-featurettes{
			margin-bottom: 20px;
			background: none;
			position: relative;
			zoom: 1;
			border: none;
			box-shadow: none;
			min-height: 435px;
	    }
	    
	    .flexslider-featurettes .slides img{
		    width: auto;
		    margin: 0 auto;
	    }
	    
	    .flexslider-featurettes .flex-control-nav{
		    bottom: 0;
	    }
	    
	    .flexslider-featurettes .flex-control-nav{
		    text-align: right;
	    }
	    
	    .flexslider-featurettes .flex-control-paging li a{
		    font: 0/0 a;
	    }
	    
	    .flexslider-content-testimonial{
		    margin: 65px 0;
			background: url(img/quote.png) right center no-repeat;
			position: relative;
			zoom: 1;
			border: none;
			box-shadow: none;
	    }
	    
		.flexslider-content-testimonial .slides img{
		    width: auto;
	    }
    </style>
    <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" /> <!-- PrettyPhoto CSS -->

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="img/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="img/ico/favicon.png">
  <!--Language Specific Error Codes for scripts-->
	<script type="text/javascript">
	var error_firstname = "<?php echo $lang['error_form_placeholder_firstname'];?>";
	var	error_lastname = "<?php echo $lang['error_form_placeholder_lastname'];?>";
	var	error_useremail = "<?php echo $lang['error_form_placeholder_useremail'];?>";
	var	error_usercedula = "<?php echo $lang['error_form_placeholder_cedula'];?>";
	var	error_userphone = "<?php echo $lang['error_form_placeholder_userphone'];?>";
	var	error_city = "<?php echo $lang['error_form_option_1_city'];?>";
	var	error_filerequired = "<?php echo $lang['error_form_placeholder_userfile'];?>";
	var	error_fileextension = "<?php echo $lang['error_form_placeholder_userfiletype'];?>";
	var	error_filesize = "<?php echo $lang['error_form_placeholder_userfilesize'];?>";
	var	error_captcharequired = "<?php echo $lang['error_form_placeholder_captcha_put'];?>";
	var	error_captcharemote = "<?php echo $lang['error_form_placeholder_captcha_type'];?>";
	</script>                                
  </head>

  <body>
	
	<!-- Begin Main Container Section -->
	<div class="main-container">
	
		<!-- Top Header -->
		<section id="top-header" class="blue-gradient">
    
		    <div class="container">
		
		     	<div class="row">
		     		
		     		<!-- .head-social -->
		     		<div class="span6 head-social">
		     		
		     			<ul class="social">
		     				<li><a href="#"><span aria-hidden="true" class="boton-facebook"></span></a></li>
		     				<li><a href="#"><span aria-hidden="true" class="boton-twitter"></span></a></li>
		     				<li><a href="#"><span aria-hidden="true" class="boton-googleplus"></span></a></li>
		     				<li><a href="#"><span aria-hidden="true" class="boton-linkedin"></span></a></li>
		     			</ul><!--/ .green-social -->
		     		
		     		</div><!--/ .head-social -->
		     		
		     		<!-- .head-nav -->
		     		<div class="span6 head-nav blue-nav">
		     		
		     			<ul class="nav nav-pills pull-right">
				          <li class="active"><a href="<?php echo $baseurl; ?>">Inicio</a></li>
				          <!--<li><a href="about.html">Información</a></li>
				          <li><a href="faq.html">Preguntas</a></li>
				          <li><a href="contact.html">Contacto</a></li>-->
				        </ul>
		     		
		     		</div><!--/ .head-nav -->
		     		
		     	</div>
		
		    </div> <!-- /container -->
		    
		</section>
    	<!--/ END Top Header Section -->
    	
    	<!-- Header Section -->
    	<section id="head-content">
    		
    		<div class="container">
		
		     	<div class="row">
		     	
		     		<div class="span6 leftside-header">
		     		
		     			<a href="#"><img src="img/logo_medium.png" alt="Local PlayMate - Premium Escort Service - Maneja Tu tiempo desde una App Móvil, selecciona los clientes que quieres atender y recibe pagos online para no manejar efectivo."/></a>		     			
		     		
		     		</div><!--/ leftside-header -->
		     		
		     		
		     
		     </div> <!-- /container -->
    	
    	</section>
    	<!--/ END Header Section-->
    	
    	<!-- Head Banner Section -->
    	<section id="head-banner">
    	
    		<div class="container">
		
		     	<div class="row">
		     	
		     	
		     		<div class="span6">
		     		
		     			<h1 class="tagline animated fadeInLeft">¡La forma más novedosa del mundo para ser un Premium Escort!</h1>
		     			
		     			<h4 class="sub-tagline">Maneja tus tiempos, indica tu disponibilidad en tiempo real, usa tu celular como herramienta de seguridad en línea, para recepción de pagos y lo mejor, selecciona los clientes que consideres son de tu perfil.</h4>
		     			
		     			<div class="video-button">
		     				
		     				<a href="#">
		     					<img src="img/play.png" class="play-button" alt="Inscríbete para ser un Premium Escort usando Local PlayMate"/>
		     				</a>
		     				
		     			</div> <!--/ .video-button -->
		     		
		     		</div>
		     		
		     		<div class="span5 pull-right">
		     		
		     			<div class="headbanner-form animated fadeInUp">
		     			
		     				<h2><?php echo $lang['form_intro_title'];?></h2>
		     				
			     				<div class="form">
			    <div class="header">
					<div class="grid-container">
				        <div class="column-twelve">
							<h4><?php echo $lang['form_title'];?></h4>
						</div>
						
				    </div>
				</div>
				<div class="section">
                    <form method="post" action="<?php echo $baseurl;?>php/processor.php?lang=<?php echo $_GET['lang'];?>" id="contact" enctype="multipart/form-data">					   
					    <fieldset>
					        <div class="grid-container">
						        <div class="column-twelve">
		                            <div id="contact-message"></div>
							    </div>
								<div class="column-twelve">
							        <div class="input-group">
                                        <?php echo CSRF::make('contact-form')->protect(); ?>                                      
									</div>
							    </div>
								<div class="column-six">
							        <div class="input-group-right">
									    <label for="firstname" class="group label-input">
										    <i class="icon-user-3"></i>
			                                <input type="text" id="firstname" name="firstname" maxlength="30" class="input-right" placeholder="<?php echo $lang['form_placeholder_firstname'];?>">
										</label>
								    </div>
								</div>
								<div class="column-six">
								    <div class="input-group-right">
										<label for="lastname" class="group label-input">
										    <i class="icon-user-3"></i>
			                                <input type="text" id="lastname" name="lastname" maxlength="30" class="input-right" placeholder="<?php echo $lang['form_placeholder_lastname'];?>">
										</label>
								    </div>
								</div>
						        <div class="column-twelve">
						        	<div class="input-group-right">
										<label for="usercedula" class="group label-input">
										    <i class="icon-envelop-opened"></i>
			                                <input type="text" id="usercedula" name="usercedula" maxlength="15" class="input-right" placeholder="<?php echo $lang['form_placeholder_cedula'];?>">
										</label>
								    </div>
								    <div class="input-group-right">
										<label for="useremail" class="group label-input">
										    <i class="icon-envelop-opened"></i>
			                                <input type="email" id="useremail" name="useremail" maxlength="70" class="input-right" placeholder="<?php echo $lang['form_placeholder_useremail'];?>">
										</label>
								    </div>
								    <div class="input-group-right">
										<label for="userphone" class="group label-input">
										    <i class="icon-envelop-opened"></i>
			                                <input type="text" id="userphone" name="userphone" maxlength="70" class="input-right" placeholder="<?php echo $lang['form_placeholder_userphone'];?>">
										</label>
								    </div>
								    
									<div class="select-group">
										<label for="city" class="group custom-select">
											<select id="city" name="city" class="select">
												<option value=""><?php echo $lang['form_option_1_city'];?></option>
												<option value="<?php echo $lang['form_option_2_city']?>"><?php echo $lang['form_option_2_city'];?></option>
												<option value="<?php echo $lang['form_option_3_city']?>"><?php echo $lang['form_option_3_city'];?></option>
											</select>
										</label>
							        </div>
									<?php if($upload == true){ ?>
									<div class="file-group">
										<label for="userfile1" class="group label-file">
											<span class="button-upload blue"><?php echo $lang['form_userfile_choose'];?></span>								
											<input type="file" id="userfile1" name="userfile1" class="file" onchange="document.getElementById('fake1').value = this.value;">
											<i class="icon-upload-2"></i>
											<input type="text" id="fake1" class="input" placeholder="<?php echo $lang['form_placeholder_userfilecedula'];?>">
										</label>
									</div>
                                    <div class="file-group">
										<label for="userfile2" class="group label-file">
											<span class="button-upload green"><?php echo $lang['form_userfile_choose'];?></span>								
											<input type="file" id="userfile2" name="userfile2" class="file" onchange="document.getElementById('fake2').value = this.value;">
											<i class="icon-upload-2"></i>
											<input type="text" id="fake2" class="input" placeholder="<?php echo $lang['form_placeholder_userfilefront'];?>">
										</label>
									</div>
									<div class="file-group">
										<label for="userfile3" class="group label-file">
											<span class="button-upload green"><?php echo $lang['form_userfile_choose'];?></span>								
											<input type="file" id="userfile3" name="userfile3" class="file" onchange="document.getElementById('fake3').value = this.value;">
											<i class="icon-upload-2"></i>
											<input type="text" id="fake3" class="input" placeholder="<?php echo $lang['form_placeholder_userfileback'];?>">
										</label>
									</div>
									<div class="file-group">
										<label for="userfile4" class="group label-file">
											<span class="button-upload green"><?php echo $lang['form_userfile_choose'];?></span>								
											<input type="file" id="userfile4" name="userfile4" class="file" onchange="document.getElementById('fake4').value = this.value;">
											<i class="icon-upload-2"></i>
											<input type="text" id="fake4" class="input" placeholder="<?php echo $lang['form_placeholder_userfileprofile'];?>">
										</label>
									</div>
									<?php } ?>
								</div>
								<?php if($captcha == true){ ?>
								<div class="column-six">
                                    <div class="captcha-group">
                                        <div class="captcha center">
										    <img src="<?php echo $baseurl;?>php/captcha/captcha.php" alt="captcha">
									    </div>
                                    </div>
                                </div>
								<div class="column-six">
                                    <div class="captcha-group">												
                                        <label for="captcha" class="group label-captcha">
									        <input type="text" name="captcha" class="captcha center" id="captcha" maxlength="6" placeholder="<?php echo $lang['form_placeholder_captcha'];?>">
										</label>
                                    </div>
                                </div>
								<?php } ?>
								<?php if($upload == true){ ?>
								<div class="column-twelve">
								    <div class="progress-bar-container">
										<div class="progress-bar">
											<div class="bar blue"></div>
											<div class="percent">0%</div>
										</div>
									</div>
								</div>
								<?php } ?>
					            <div class="column-twelve">
									<button type="submit" id="contact-button" class="button button-large button-blue space"><?php echo $lang['form_button_submit'];?></button>
							        <button type="reset" class="button button-large button-red"><?php echo $lang['form_button_reset'];?></button>
								</div>
						    </div>
					    </fieldset>
					</form>
		     			
		     			</div> <!--/ .headbanner-form -->
		     		
		     		</div>
    	
		     	</div>
		     
		     </div> <!-- /container -->
    		
    	</section>
    	<!--/ END Head Banner Section -->
    	
    	<!-- Marketing Section -->
    	<section id="marketing">
    	
    		<div class="container">
		
		     	<div class="row">
		     	
		     		<div class="span12 centered">
		     	
			     		<h2 class="title centered">¿Cómo Funciona?</h2>
		     		
			     		<hr class="title-line">
		     		
		     		</div>
		     		
		     		<div class="span4 marketing-content">
		     		
			     		<img class="marketing-icon" src="img/mobile.png" alt="Marketing Icon"/>
		     			
		     			<h5>Descarga La App Móvil</h5>
		     			
		     			<p>Una App de Android desde la cual, en el momento que estés disponible, los potenciales clientes podrán contratarte; en servicios, podrás notifiar tu ubicación, si tienes emergencias y detalles como si necesitas transporte, asesoría o incluso otros servicios.</p>
		     		
		     		</div>
		     		
		     		<div class="span4 marketing-content">
		     		
		     			<img class="marketing-icon" src="img/like.png" alt="Marketing Icon"/>
		     			
		     			<h5>Crea Tu Perfil</h5>
		     			
		     			<p>Indica tus cualidades, habilidades y formas de trabajo. Mientras más específico, más probabilidad de conseguir mejores y exclusivos clientes tendrás. Todos los perfiles son auditados y deben cumplir con un estándar mínimo, así que si estás en Local PlayMate es porque eres un verdadero Premium Escort.</p>
		     		
		     		</div>
		     		
		     		
		     		
		     		<div class="span4 marketing-content">
		     		
		     			<img class="marketing-icon" src="img/zoom.png" alt="Marketing Icon"/>
		     			
		     			<h5>Recibe Notificaciones de Servicio</h5>
		     			
		     			<p>Si un cliente está interesado en tusu servicios, una notificación llegará a tu celular, y podrás revisar todas las condiciones de la misma. Si crees que se acomoda a tu perfil, la aceptas y la aplicación organiza tu agenda, te avisa con tiempo para que no la vayas a olvidar y además te permite usar muchas funcionalidades de la plataforma para seguridad y buen servicio mientras lo estás prestando.</p>
		     		
		     		</div>
		     		
		     		<div class="span4 marketing-content">
		     		
		     			<img class="marketing-icon" src="img/heart.png" alt="Marketing Icon"/>
		     			
		     			<h5>Te Cuidamos 24/7</h5>
		     			
		     			<p>Con Local PlayMate cuentas con un ayudante durante un servicio. Además de recordarte las horas, el tiempo de servicio y muchos otras cosas, puedes comunicarte con servicios de emergencias para tu seguridad, domicilios, transporte puerta a puerta y cada vez integramos más cosas que harán que tu trabajo sea más Premium.</p>
		     		
		     		</div>

		     		<div class="span4 marketing-content">
		     		
		     			<img class="marketing-icon" src="img/money.png" alt="Marketing Icon"/>
		     			
		     			<h5>Evita Manejar Efectivo</h5>
		     			
		     			<p>Como sabemos que te gusta evitar problemas, procesamos el pago de tu servicio y así evitamos que tengas que manejar efectivo o entenderte con tu cliente sobre el tema. Además, si inscribes una cuenta en la plataforma, el dinero estará disponibel el mimso día calendario en tu cuenta. (Pronto)</p>
		     		
		     		</div>
		     		
		     		<div class="span4 marketing-content">
		     		
		     			<img class="marketing-icon" src="img/note.png" alt="Marketing Icon"/>
		     			
		     			<h5>Contacto y Soporte en Línea</h5>
		     			
		     			<p>Contamos con un equipo que podrá asesorarte en múltiples temas, desde seguridad hasta como hacer que tu servicio sea más placentero para los clientes. Esto pensado para que cada vez seas más Premium y tu trabajo más especial. Local PlayMate - Premium Escort Service.</p>
		     		
		     		</div>
    	
    			</div>
		     
		     </div> <!-- /container -->
    	
    	</section>
    	<!--/ END Marketing Section -->
    	
    	
    	
    	
    	
    	
    	
    	<!-- Footer Section -->
    	<section id="footer" class="blue-gradient">
    		
    		<div class="container">
    		
    			<div class="row">
    				
    				<div class="span12 footer-offer centered">
    				
    					<h4>¿Qué esperas para hacer tu Pre-Casting? </h4>
    					
    					<p class="uppercase">¡Inscríbete Ya y te llamaremos para un Casting Virtual!</p>
    					
    					<a href="#" id="doitnow" class="btn btn-large btn-yellow uppercase">¡Inscribirme Ya!</a>
    				
    				</div>
    				
    				<div class="span6 leftside-footer">
	    				
	    				<p class="copyright small">Local PlayMate © copyright 2014. Todos Los Derechos Reservados</p>
	    				
    				</div><!--/ .leftside-footer -->
    				
    				<div class="span6 rightside-footer">
	    				
	    				<ul class="social pull-right" style="margin-top:37px;">
	    					<li><a href="#"><span aria-hidden="true" class="boton-facebook"></span></a></li>
		     				<li><a href="#"><span aria-hidden="true" class="boton-twitter"></span></a></li>
		     				<li><a href="#"><span aria-hidden="true" class="boton-googleplus"></span></a></li>
		     				<li><a href="#"><span aria-hidden="true" class="boton-linkedin"></span></a></li>
	    				</ul><!--/ .green-social -->
	    				
    				</div><!--/ .rightside-footer -->
    				
    			</div>
    		
    		</div> <!-- /container -->
    		
    	
    	</section>
    	<!--/ END Footer Section -->

	  <!-- Begin Scroll to Top Button -->
	  <div class="toTop"><a href="#">top</a></div>
	  <!-- END Scroll to Top Button -->    	
	      	
	</div>
    <!--/ END Main Container -->
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script> 
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="js/gmap3.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="js/payday.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl;?>js/jquery.custom.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl;?>js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl;?>js/jquery.methods.js"></script>
    <script type="text/javascript" src="<?php echo $baseurl;?>js/jquery.form.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl;?>js/localization/messages_en.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl;?>js/jquery.tooltipster.js"></script>


  </body>
</html>