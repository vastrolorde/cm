$('#Province').on('change',function(){

	$.ajax({

		url: "http://localhost/cm/index.php/settings/get_th/Dist",
		data: {
			Province : $('#Province').val()
		},
		dataType: "json",
		type: "POST",
		success: function (data) {
			console.log(data);

			$('#Dist').find('option').remove().end();
			$.each(data,function(key,value){
				$('#Dist').append('<option value="'+value.Dist_ID+'">'+value.Dist_NAME+'</option>');
			});

		},
		error: function (request, status, error) {
			console.log(request);
			console.log(status);
			console.log(error);
		}

	});

});