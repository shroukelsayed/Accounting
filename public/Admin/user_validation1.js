/**
 * 
 */ 
$(document).ready(function () {
    username_err = $('#uspan');
    email_err = $('#upan');
    naid_err=$('#idspan');
    $(":input[name='name']").on("blur", function () {
        
            var sentData = {'username': $(":input[name='name']").val(), '_token': $('input[name=_token]').val()};
            console.log(sentData);
            $.ajax({
                url: '/user_infos/create/?action=name',
                type: "POST",
                data: {'username': $(":input[name='name']").val(), '_token': $('input[name=_token]').val()},

              success: function (data) 
              {
                // alert(data);
                console.log(data.length==0); 
                if(data.length==0)
                {
                    console.log("Available");
                    username_err.hide();
                }
                else
                {
                    console.log("not Available");
                    username_err.html("<b>The Name Of Charity Already Exist</b>");
                    $('#name').focus();
                }

            }
        });

        

    
    });
    $(":input[name='email']").on("blur", function () {
        $.ajax({
                url: '/user_infos/create/?action=email',
                type: "post",
                data: {'email': $(":input[name='email']").val(), '_token': $('input[name=_token]').val()},

             success: function (data) 
             {
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
        
        
    });
});
