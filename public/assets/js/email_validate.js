$(document).ready(function () {
	email_err= $('#upan');
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
                    console.log("not Available");
                    email_err.html("<b>Email NOT Available</b>");
                    $('#email').focus();
                }
                else
                {
                    
                    console.log("Available");
                    email_err.html("<b>Email Available</b>");
                }
            }
        });
    });
});
