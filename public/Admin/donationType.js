/**
 * Created by shrouk on 07/06/16.
 */
$(document).ready(function () {
    // console.log("hiii in ready");

    // $(":input[name='username']").on("blur", function () {
    //     console.log("hiiiiiiiii")
    // });
    $("#donation_type_id_field").on("change", function () {
        console.log("donation_type");
        //         console.log("blur");
        // $.post("/user/check/?action=username").done(function (data, status) {
        // alert("Data: " + data + "\nStatus: " + status);
        // console.log("Data: " + data + "\nStatus: " + status);
        // console.log(data);
        //
        // });
        // $.ajax({
        //     url: '/people/donation_type/?action=donation_type_id',
        //     type: "post",
        //     data: {'donation_type_id': $("#donation_type_id_field").val(), '_token': $('input[name=_token]').val()},

        //     success: function (data) {
        //         // alert(data);
        //         console.log(data);
        //         if (data=="1"){
        //             console.log(data);
        //             // $(":input[name='username']").next().text("username used").hide();
        //         }else {
        //             console.log("blur");
        //             // $(":input[name='username']").next().text("username used").show();
        //             // $(":input[name='username']").focus();
        //         }
        //     }
        // });

    });


    $(":input[name='email']").on("blur", function () {
        // console.log("blur");
        $.ajax({
            url: '/users/checkdata/?action=email',
            type: "post",
            data: {'email': $(":input[name='email']").val(), '_token': $('input[name=_token]').val()},

            success: function (data) {
                // alert(data);
                console.log(data);
                if (data=="yes"){
                    $(":input[name='email']").next().text("email used").hide();
                }else {
                    $(":input[name='email']").next().text("email used").show();
                    $(":input[name='email']").focus();
                }
            }
        });
    });
});