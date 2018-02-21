$(document).ready(function($) {


    //------------- DateTime Picker ----------------
     $("#datetimepicker").keydown(function(event){
          event.preventDefault();          
      }); 

      $("#datetimepicker").datepicker({
          dateFormat: 'yy/mm/dd'
      }); 


	//------------- Dropdown list ajax ----------------
	// console.log("shrouk");



	$('#governorate').on('change',function(e){

	    // console.log(e);
	    var governrate_id =e.target.value;
		$.get('/ajax-governrate?governorate_id='+ governrate_id,function(data){
        $('#city').empty();
        // console.log(data);
        $.each(data,function(index,cityobj){
         	$('#city').append('<option value="'+cityobj.id+'">'+cityobj.name+'</option>');

      	});
	});
});


	//----------- vaild first name ----------------------
	 $('#firstName').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^[a-zA-Z]*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">only characters allowed.</span>');
            $(this).focus();
          
        }
    });

     //----------- vaild last name ----------------------
	 
     $('#lastName').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^[a-zA-Z]*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">only characters allowed.</span>');
            $(this).focus();
          
        }
    });

 //     //----------- vaild name----------------------
	// $('#name').blur(function() {
 //        $('span.error-keyup-2').remove();
 //        var inputVal = $(this).val();
 //        var characterReg = /^[a-zA-Z0-9\_\-]*$/;
 //        if(!characterReg.test(inputVal)) {
 //            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
 //            $(this).focus();
 //        }
 //    }); 

    //----------- vaild  password ----------------------
    $("#password").blur(function () {
        $('span.error-keyup-2').remove();
        var password = $("#password").val();
        var confirmPassword = $("#confirm_password").val();
        // alert("hello");
        if ( password.length < 8 )
        {
            
            $('#password').after('<span class="error error-keyup-2">Password must be Minimum 8 characters.</span>');
            $('#password').focus();
        }else{
        
             $("#confirm_password").blur(function () {
                $('span.error-keyup-2').remove();
                var password = $("#password").val();
                var confirmPassword = $("#confirm_password").val();
            	 if (password != confirmPassword) {
                        $('#confirm_password').after('<span class="error error-keyup-2">Password Not Match.</span>');
                    	$('#password').select();
                        $('#password').focus();
                    }

            });

        }    
    });
        
    //----------- vaild  email ----------------------

    // $('#email').blur(function() {
    //     $('span.error-keyup-2').remove();
    //     var inputVal = $(this).val();
    //     var characterReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    //     if(!characterReg.test(inputVal)) {
    //         $(this).after('<span class="error error-keyup-2">Invaild email format.  ex: (example@gmail.com)</span>');
    //         $(this).focus();
    //     }
    // }); 

    //----------- vaild nationalid-----------------------

    // $('#nationalid').blur(function() {
    //     $('span.error-keyup-2').remove();
    //     var inputVal = $(this).val();
    //     var characterReg = /^[0-9]{14}$/;
    //     if(!characterReg.test(inputVal)) {
    //         $(this).after('<span class="error error-keyup-2">National id must 14 numbers</span>');
    //         $(this).focus();
    //     }
    // }); 

    //----------- vaild address-----------------------
    $('#address-field').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
            $(this).focus();
        }
    });


    //----------- vaild Phone-----------------------
    $('#phone-field').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^[0-9]{11}$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">phone must be 11 numbers</span>');
            $(this).focus();
        }
    }); 


        $('#credit').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^[0-9]$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">Credit must be 11 numbers</span>');
            $(this).focus();
        }
    }); 





});