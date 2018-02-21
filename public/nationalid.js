
$(document).ready(function ($) {
    $(":input[name='nationalid']").on("blur", function () {
        
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
    });


});
