var username;
var username_err;

$(function() {
	username = $('#name1');
	username_err = $('#uspan');

	username.on('blur', function(event) {
		event.preventDefault();
		var user={};

		$.ajax({
			url: '/user_infos/create/?action=name1'+$(this).val(),
			type: 'POST', 
			// dataType: 'html',
			data: {'username': $(":input[name='name1']").val(), '_token': $('input[name=_token]').val()},

			success: function (data) {
				console.log(data);
				
				 if(data == "yes"){
					username_err.html("<b>User Name Available</b>");
				}else{
					username_err.html("<b>User Name NOT Available</b>");
					$('#name1').focus();
				}
			},
			error: function (error) {
				console.log(error);
			}
		});		
	});
});
