<script type="text/javascript">
	$(document).ready(function(){

	// Autocomplete

		//หาหัวหน้า
		$("input[name='position_manager']").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "<?php echo site_url().'/HR/position/lookup_manager'; ?>",
					data: {
						lookup:	$("input[name='position_manager']").val()
					},
					dataType: "json",
					type: "POST",
					success: function (data) {
		                response($.map(data,function (value) {
		                    return {
								'label': value.position_name,
								'value': value.position_name
		                    };
		            	}))


		                	console.log(data);
		            }
				});
			},
			minLength: 3
		});

	});	
</script>