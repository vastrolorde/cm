<script type="text/javascript">
	$(document).ready(function(){

		//Total Weight Row
		$('#totalweight').val(0);

		// Calculate Function

		function CalcTotal(){

			var total = 0;
			$('#inventory_transaction tr #sum').each(function(){
				var weight = $(this).val();
				total += parseInt(weight);
			});

			return total;
		}

	// Add Product Row
	$i = $('#inventory_transaction tr').length; //Count Row
	// $('#addProductRow').on('click', function(){

	// 	$('#inventory_transaction').append(' \
	// 		<tr> \
	// 		<td>' + $("#product_id").val() + '<input type="hidden" name="product_id[]" value="'+$("#product_id").val()+'"><input type="hidden" name="inventory_move_id[]" value="'+$("input[name=id]").val()+'"></td> \
	// 		<td>' + $("#weight").val() + ' kg <input type="hidden" name="weight[]" value="'+$("#weight").val()+'"></td> \
	// 		<td>' + $("#amount").val() + '<input type="hidden" name="amount[]" value="'+$("#amount").val()+'"></td> \
	// 		<td>'+$("#amount").val() * $("#weight").val()+'<input type="hidden" name="sum[]" id="sum" value="'+$("#amount").val() * $("#weight").val()+'"></td> \
	// 		<td><a href="#" class="deltransactionRow">ลบ</a></td> \
	// 		</tr>'
	// 	);

	// 	// Calculate
	// 	var total = CalcTotal();
	// 	$('#totalweight').val(total);

	//      //Reset fields after add row
	// 	$("#product_id").val('');
	// 	$("#amount").val('');
	// 	$("#weight").val();


	// });

	// Delete Product Row
		$('#transaction').on('click','.deltransactionRow',function(){
			
			// Calculate
			var total = CalcTotal();
			$('#totalweight').val(total);

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