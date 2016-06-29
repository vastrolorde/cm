<script type="text/javascript">
	$(document).ready(function(){

		//Total Weight Row
		$('#totalweight').val(0);

	// Add Product Row
	$i = $('#inventory_transaction tr').length; //Count Row
	$('#addProductRow').on('click', function(){
		
		if($i > 1){
			$('#inventory_transaction tr:last').after(' \
				<tr> \
				<td>'+$i+'</td> \
				<td>' + $("#product_id").val() + '<input type="hidden" name="product_id[]" value="'+$("#product_id").val()+'"><input type="hidden" name="inventory_move_id[]" value="'+$("input[name=id]").val()+'"></td> \
				<td>' + $("#weight").val() + ' kg <input type="hidden" name="weight[]" value="'+$("#weight").val()+'"></td> \
				<td>' + $("#amount").val() + '<input type="hidden" name="amount[]" value="'+$("#amount").val()+'"></td> \
				<td><input type="hidden" name="sum[]" value="'+$("#amount").val() * $("#weight").val()+'"><a href="#" class="deltransactionRow">ลบ</a></td> \
				</tr>'
			);
			$i++;
		} else {
			$i++;
			$('#inventory_transaction').append(' \
				<tr> \
				<td>'+1+'</td> \
				<td>' + $("#product_id").val() + '<input type="hidden" name="product_id[]" value="'+$("#product_id").val()+'"><input type="hidden" name="inventory_move_id[]" value="'+$("input[name=id]").val()+'"></td> \
				<td>' + $("#weight").val() + ' kg <input type="hidden" name="weight[]" value="'+$("#weight").val()+'"></td> \
				<td>' + $("#amount").val() + '<input type="hidden" name="amount[]" value="'+$("#amount").val()+'"></td> \
				<td><input type="hidden" name="sum[]" value="'+$("#amount").val() * $("#weight").val()+'"><a href="#" class="deltransactionRow">ลบ</a></td> \
				</tr>'
			);
		}

		// Calculate weight

			var total;

	    	$('#inventory_transaction tr').each(function(){
			      total +=	parseInt($(this).find('input[name=sum]').val(),10); 
	    	});


	         $('#totalweight').append(total);

	     //Reset fields after add row

		$("#product_id").val('');
		$("#amount").val('');
		$("#weight").val();

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