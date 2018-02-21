
$(document).ready(function(){

    //dropdownlist governartor 

    $('#governorate').on('change',function(e){

    console.log(e);
    var governrate_id =e.target.value;

    //Ajax

  $.get('/ajax-governrate?governorate_id='+ governrate_id,function(data){
         $('#city').empty();
        console.log(data);
        $.each(data,function(index,cityobj){

          $('#city').append('<option value="'+cityobj.id+'">'+cityobj.name+'</option>');

          });
      });
  });
      //---------- vaild title Compaign-----------
      $('#title').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
            $(this).focus();
        }
    });

      //---------- vaild Location Compaign-----------  
      $('#location').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
            $(this).focus();
        }
    });

      //---------- vaild budget Compaign-----------
     $('#budget').blur(function() {
        $('span.error-keyup-1').hide();
        var inputVal = $(this).val();
        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
        if(!numericReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-1">Numeric characters only.</span>');
            $(this).focus();
        }
    });

     //---------- vaild description Compaign-----------
    $('#description').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
            $(this).focus();
        }
    });

    //---------- vaild Name Blood-----------
    $('#name-field').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^\s*[a-zA-Z\s]+\s*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
            $(this).focus();
          
        }
    });

    //---------- vaild Address case and Hospital Blood-----------
    $('#address-field').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
            $(this).focus();
        }
    });

   $('#phone-field').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^[0-9]{11}$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">phone must be 11 numbers</span>');
            $(this).focus();
        }
    }); 


    //---------- vaild Amount blood-----------    
    $('#amount-field').blur(function() {
        $('span.error-keyup-1').hide();
        var inputVal = $(this).val();
        var numericReg = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
        if(!numericReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-1">Numeric characters only.</span>');
            $(this).focus();
        }
    });
    
    //---------- vaild hospital Name blood----------- 
    $('#hospital-field').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^\s*[a-zA-Z,\s]+\s*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
            $(this).focus();
        }
    });

    //---------- vaild description Others-----------
    $('#description-field').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
            $(this).focus();
        }
    });



    //---------- vaild Name medicin-----------   
    $('#name-medicin').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^[a-zA-Z\s]*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
            $(this).focus();
          
        }
    });

    //---------- vaild Address Hospital-----------   
    $('#address-hos').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
            $(this).focus();
        }
    });

     // ----------- vaild nationalid-----------------------

    $('#nationalid-field').blur(function() {
        $('span.error-keyup-2').remove();
        var inputVal = $(this).val();
        var characterReg = /^[0-9]{14}$/;
        if(!characterReg.test(inputVal)) {
            $(this).after('<span class="error error-keyup-2">National id must 14 numbers</span>');
            $(this).focus();
        }
    }); 

 });   
//------------------------------------------------------

