<script type="text/javascript">
	$(document).ready(function(){

	// Add Product Row
	$i = $('#inventory_transaction tr').length; //Count Row
	$('#addProductRow').on('click', function(){
		
		$('#inventory_transaction tr:last').after(' \
			<tr> \
			<td>'+$i+'</td> \
			<td>' + $("#product_id").val() + '<input type="hidden" name="product_id[]" value="'+$("#product_id").val()+'"><input type="hidden" name="inventory_move_id[]" value="'+$("input[name=id]").val()+'"></td> \
			<td>' + $("#weight").val() + ' kg <input type="hidden" name="amount[]" value="'+$("#weight").val()+'"></td> \
			<td>' + $("#amount").val() + '<input type="hidden" name="weight[]" value="'+$("#amount").val()+'"></td> \
			<td><a href="#" class="deltransactionRow">ลบ</a></td> \
			</tr>'
		);

		$("#product_id").val('');
		$("#amount").val('');
		$("#weight").val();

		$i++;
	});

	// Delete Product Row
		$('#transaction').on('click','.deltransactionRow',function(){
			$(this).closest('tr').remove();
		});



		$("#product_id").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "<?php echo site_url().'/Inventory/Inventory/product_get'; ?>",
					data: {
						product_id:	$("#product_id").val()
					},
					dataType: "json",
					type: "POST",
					success: function (data) {
						console.log(data);
		                response($.map(data,function (value) {
		                    return {
		                        'label': value.product_id,
		                        'value': value.product_id
		                    };
		            	}))
		            },
					error: function (request, status, error) {
						console.log(request);
						console.log(status);
						console.log(error);
					}
				});
			},
			minLength: 2
		});//End Product Autocomplete

		$('#product_id').on('blur',function(){

			$.ajax({
				url: "<?php echo site_url().'/Inventory/Inventory/product_get'; ?>",
				data: {
					product_id:	$("#product_id").val()
				},
				dataType: "json",
				type: "POST",
				success: function (data) {
					console.log(data);
					$.each(data,function(key,value){
						$('#weight').val(value.product_weight);
						// $('#weight').val(value.product_name);
					});

				},
				error: function (request, status, error) {
					console.log(error);
					console.log(status);
					console.log(request);
				}
			});
		});//End Product weight

	});// End jquery

</script>