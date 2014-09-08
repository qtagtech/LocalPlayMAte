<?php

$message = '
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>EMAIL TEMPLATE</title>
        <style type="text/css">

            /* ---------- RESET STYLES ---------- */

            body{margin:0; padding:0;}

            /* ---------- TEMPLATE STYLES ---------- */

            .bodyTable{
			    position:relative;
				display:block;
				padding:0 30px;
				margin:30px auto;
				height:auto !important; 
				max-width:600px;
                width:100%;	
                -webkit-box-sizing:border-box;
	               -moz-box-sizing:border-box; 
	                    box-sizing:border-box;				
            }

            /* ---------- BODY STYLES ---------- */

            .bodyContent{
			    position:relative;
				display:block;
                background-color:#fff;
                border:1px solid #ddd;
				padding:30px;
				margin:0;
				height:auto!important; 
				max-width:600px;
				width:100%;
				line-height:20px;
				word-wrap:break-word;
                -webkit-box-sizing:border-box;
	               -moz-box-sizing:border-box; 
	                    box-sizing:border-box;				
            }
			
			.bodyContent h1{
                color:#272e38;
                font-family:Helvetica;
                font-size:22px;
				font-style:normal;
				font-weight:normal;
				padding:0;
				margin:20px 0;
            }
			
            .bodyContent h6{
                color:#272e38;
                font-family:Helvetica;
                font-size:14px;
				font-style:normal;
				font-weight:normal;
				padding:0;
				margin:0 0 20px 0;
            }
			
            .bodyContent a:link, .bodyContent a:visited{
                /*@editable*/ color:#3597c2;
                /*@editable*/ font-family:Helvetica;
                /*@editable*/ font-size:14px;
                /*@editable*/ font-weight:normal;
                /*@editable*/ text-decoration:none;
            }
			
        </style>
    </head>
    <body>
        <div class="bodyTable">
			<div class="bodyContent">
                <h1>'.$lang['message_form_1'].'</h1>
                <h6>'.$lang['message_form_2'].'</h6>
                <h6>'.$lang['message_form_3'].'</h6>
                <h6>'.$lang['message_form_4'].'</h6>
                <h6>'.$lang['message_form_5'].'</h6>
				<h6>'.$lang['message_form_6'].'</h6>
                <h6>'.$lang['message_form_7'].'</h6>
				<h6>'.$lang['message_form_8'].'</h6>
            </div>
        </div>
    </body>
</html>';
?>