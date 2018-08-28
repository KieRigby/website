$(document).ready(function() {

	$('form.ajax').on('submit', function(){

		var that = $(this),
			type = that.attr('method'),
			url = that.attr('action'),
			data = {};

		that.find('[name]').each(function(index, value){
			var that = $(this),
				name = that.attr('name'),
				value = that.val();

			data[name] = value;
		});

		console.log(data);

		$.ajax({
			url:url,
			type:type,
			data:data,
			success: function(resp){
				response(resp);
			}
		});
    
		return false;
	});

});
