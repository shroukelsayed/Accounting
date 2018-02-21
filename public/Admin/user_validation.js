/**
 * 
 */ 
$(document).ready(function ($) {
    username_err = $('#uspan');
    email_err = $('#upan');
    naid_err=$('#idspan');
    // $(":input[name='name']").on("blur", function () {
        
    //          $.ajax({
    //         url: '/user_infos/create/?action=name',
    //         type: "POST",
    //         data: {'username': $(":input[name='name']").val(), '_token': $('input[name=_token]').val()},

    //         success: function (data)
    //          {
    //             // alert(data);
    //             console.log(data.length==0); 
    //             if(data.length==0)
    //             {
    //                 console.log("Available");
    //                 username_err.hide();
    //             }
    //             else
    //             {
    //                 console.log("not Available");
                    
    //                 username_err.html("<b>UserName Already Exist</b>");
    //                 $('#name').focus();
    //             }

    //         }
    //     });
       
    // });
    $(":input[name='email']").on("blur", function () {
        // $('span.error-keyup-2').remove();
        // var inputVal = $(this).val();
        // var characterReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        // if(!characterReg.test(inputVal)) 
        // {
        //     $(this).after('<span class="error error-keyup-2">Invaild email format.  ex: (example@gmail.com)</span>');
        //     $(this).focus();
        // }
        // else
        // {
            $.ajax({
            url: '/user_infos/create/?action=email',
            type: "post",
            data: {'email': $(":input[name='email']").val(), '_token': $('input[name=_token]').val()},

            success: function (data) {
                // alert(data);
                console.log(data);
                 if(data.length==0)
                 {
                    console.log("Available");
                    email_err.hide();
                }
                else
                {
                    console.log("not Available");
                    email_err.html("<b>Email Already Exist</b>");
                    $('#email').focus();
                }
            }
        });
        // }
        
    });
    $(":input[name='nationalid']").on("blur", function () {
        
        // $('span.error-keyup-2').remove();
        // var inputVal = $(this).val();
        // var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
        // if(!characterReg.test(inputVal)) {
        //     $(this).after('<span class="error error-keyup-2">No special characters allowed.</span>');
        //     $(this).focus();
        // }
        // else{

        
        $.ajax({
            url: '/user_infos/create/?action=nationalid',
            type: "post",
            data: {'nationalid': $(":input[name='nationalid']").val(), '_token': $('input[name=_token]').val()},

            success: function (data) {
                // alert(data);
                console.log(data);
                 if(data.length==0){
                    console.log("Available");
                    naid_err.hide();
                }else{
                    console.log("not Available");
                    naid_err.html("<b>This National ID Already Exist </b>");
                    $('#nationalid').focus();
                }
            }
        });
    // }
    });


});
