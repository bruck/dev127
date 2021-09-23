jQuery(document).ready(function($) {
	$.post('/api/newmessage',
	{
	    'email': $.('#email'),
	    'message': $.('#message'),
	    'widget_id' : $.('#wiget_id')
	},
	function (data,status) {
	    $.('#show_res').attr('background-color' , '#ffffff');
	    if (status == '201') {
                $.get('/api/newmessage/' + data['last_insert_id'] , 
			function(data,status) {
			    $.('#show_res').html('<p>email: ' + data['email'] + '</p><p>Message:</br>' + data['message'] + '</p><p>Created at: ' + data['created_at'] + '</p>');
			}_
            }
	    else {
	        $.('#show_res').attr('background-color':'#800000');
		$.('#show_res').html('<h2>An error has occurred while attempting to send this message</h2>');

	    }
	}
});
