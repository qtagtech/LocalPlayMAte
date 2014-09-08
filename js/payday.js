// jQuery for Payday Landing Page
jQuery(document).ready(function($) {

    //Own scripts
    $('body').on('click','.video-button, #doitnow',function(e){
        e.preventDefault();
        $("#firstname").focus();
    });

// jQuery Flexslider ------------------------------------------------------ //
	$('.flexslider-testimonial').flexslider({
		animation: "fade",
		animationSpeed: 1000,
		controlNav: false,
		directionNav: false
	}); 	
	
	$('.flexslider-featurettes').flexslider({
		animation: "fade",
		animationSpeed: 1000,
		directionNav: false
	});		 
	
	$('.flexslider-content-testimonial').flexslider({
		animationSpeed: 1000,
		directionNav: false
	});	 	

// jQuery Toggle ------------------------------------------------------ //	
	$('.toggle-button').on('click', function(e) {
		    e.preventDefault();
		    var $this = $(this);
		    var $collapse = $this.closest('.toggle-group').find('.toggle-inner');
		    $collapse.collapse('toggle');
		}); 
		
// jQuery Map  ------------------------------------------------------ // 			 
	 $('#map').gmap3({
		 map: {
			options: {
			  maxZoom: 14 
			}  
		 },
		 marker:{
			 latLng:[-7.765678,110.428482],
			options: {
			 icon: new google.maps.MarkerImage(
			   "http://i1002.photobucket.com/albums/af147/Nu_Vandaliant/map-marker_zps02081b6d.png",
			   new google.maps.Size(110, 110, "px", "px")
			 )
			}
		 }
		},
		"autofit" );

// jQuery PrettyPhoto ------------------------------------------------------ //	
	 $("a[rel^='prettyPhoto']").prettyPhoto();

// jQuery ToTop ------------------------------------------------------ //
	 $(".toTop").hide();
		
	 $(function () {
	 	$(window).scroll(function () {
		    if ($(this).scrollTop() > 200) {
		    	$('.toTop').fadeIn();
		        } else {
		        	$('.toTop').fadeOut();
		     }
		 });        
	 });        
		
	var easing, e, pos;
	    $(function(){
	      $(".toTop").on("click", function(){
	        pos= $(window).scrollTop();
	        $("body").css({
	          "margin-top": -pos+"px" 
	        });
	        $(window).scrollTop(0);
	        $("body").css("transition", "all 2s ease");
	        $("body").css("margin-top", "0");
	        $("body").on("webkitTransitionEnd transitionend msTransitionEnd oTransitionEnd", function(){
	          $("body").css("transition", "none");
	        });
	      });
		
	  });

// List Form Validation ------------------------------------------------------ //
        $('#list_btn').click(function(e){
            
            //Stop form submission & check the validation
            e.preventDefault();
            
            // Variable declaration
            var error = false;
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            
         	// Form field validation
            if(name.length == 0){
                var error = true;
                $('#name_error').fadeIn(500);
            }else{
                $('#name_error').fadeOut(500);
            }
            if(email.length == 0 || email.indexOf('@') == '-1'){
                var error = true;
                $('#email_error').fadeIn(500);
            }else{
                $('#email_error').fadeOut(500);
            }
            if(phone.length == 0){
                var error = true;
                $('#phone_error').fadeIn(500);
            }else{
                $('#phone_error').fadeOut(500);
            }
            
            // If there is no validation error, next to process the submit function
            if(error == false){
               // Disable submit button just after the form processed 1st time successfully.
                $('#list_btn').attr({'disabled' : 'true', 'value' : 'Submitting...' });
                
				/* Post Ajax function of jQuery to get all the data from the submission of the form as soon as the form sends the values to subscribe.php*/
                $.post("subscribe.php", $("#list_form").serialize(),function(result){
                    //Check the result set from subscribe.php file.
                    if(result == 'sent'){
                        //If the email is sent successfully, remove the submit button
                         $('#list_btn').remove();
                        //Display the success message
                        $('#list_success').fadeIn(500);
                    }else{
                        //Display the error message
                        $('#list_fail').fadeIn(500);
                        // Enable the submit button again
                        $('#list_btn').removeAttr('disabled').attr('value', 'Get Access');
                    }
                });
            }
        });

// Contact Form Validation ------------------------------------------------------ //
        $('#send_message').click(function(e){
            
            //Stop form submission & check the validation
            e.preventDefault();
            
            // Variable declaration
            var error = false;
            var name = $('#name').val();
            var email = $('#email').val();
            var inquiry = $('#subject').val();
            var message = $('#message').val();
            
         	// Form field validation
            if(name.length == 0){
                var error = true;
                $('#name_error').fadeIn(500);
            }else{
                $('#name_error').fadeOut(500);
            }
            if(email.length == 0 || email.indexOf('@') == '-1'){
                var error = true;
                $('#email_error').fadeIn(500);
            }else{
                $('#email_error').fadeOut(500);
            }
            if(inquiry.length == 0){
                var error = true;
                $('#subject_error').fadeIn(500);
            }else{
                $('#subject_error').fadeOut(500);
            }
            if(message.length == 0){
                var error = true;
                $('#message_error').fadeIn(500);
            }else{
                $('#message_error').fadeOut(500);
            }
            
            if(error == false){
                $('#send_message').attr({'disabled' : 'true', 'value' : 'Sending...' });
                
                $.post("contact.php", $("#contact_form").serialize(),function(result){

                    if(result == 'sent'){
                         $('#submit').remove();
                        $('#mail_success').fadeIn(500);
                    }else{
                        $('#mail_fail').fadeIn(500);
                        $('#send_message').removeAttr('disabled').attr('value', 'Send');
                    }
                });
            }
        });

// Footer Subscribe Form Validation ------------------------------------------------------ //
 		$('#subscribe_btn').click(function(e){
 			e.preventDefault();
 			
 			var subscribe_error = false;
 			var subscribe_email = $('#subscribe_email').val();
 			
 			if(subscribe_email.length == 0 || subscribe_email.indexOf('@') == '-1'){
	 			var subscribe_error = true;
	 			$('#subscribe_error').fadeIn(500);
 			}else{
	 			$('#subscribe_error').fadeOut(500);
 			}
 			
 			if(subscribe_error == false){
	 			$('#subscribe_btn').attr({'disabled' : 'true', 'value' : 'Submitting...' });
	 			
	 			$.post("footer_subscribe.php", $("#footer_subscribe_form").serialize(),function(result){
                    if(result == 'sent'){
                        //Display the success message
                        $('#subscribe_success').fadeIn(500);
                    }else{
                        //Display the error message
                        $('#subscribe_fail').fadeIn(500);
                    }
                });
            }
 		});    

// Loan Slider Input ------------------------------------------------------ //
//$("#SliderSingle").slider({ from: 1000, to: 10000, step: 500, dimension: '&nbsp;$' });

}); // close	  