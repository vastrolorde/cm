<script type="text/javascript">
	$(document).ready(function(){

		var inventory_move_id = $('#id').val();

		$('#transaction').load('<?php echo site_url() ?>/Inventory/Inventory/data_tr?id='+inventory_move_id);

		//Total Weight Row

		// colSum();

		// function colSum() {
		// 	var sum=0;
		// //iterate through each input and add to sum
		// 	$('.total_weight').each(function() {     
		// 		sum += parseInt($(this).html());                     
		// 	});
		// //change value of total
		// 	$('#grandtotal').html(sum);

		// 	console.log(sum);
		// }

	// Add Product Row

	$i = $('#transaction tr').length; //Count Row

		$('#AddtransactionRow').on('click', function(){
			var product = $('#product_id').val();
			var product_amount = $('#product_amount').val();

			var Something = $('#transaction tbody').closest('tr').find('td:eq(1)').text();

			if(product == Something){
				alert('รายการซ้ำ กรุณาตรวจสอบ');
			}else{
				var insert_data = {'inventory_move_id': inventory_move_id,'product_id': product, 'amount': product_amount};

				$.ajax({
					url:'<?php echo site_url() ?>/Inventory/Inventory/add_tr',
					type: 'POST',
					data: insert_data,
					success: function(){
						$('#transaction').load('<?php echo site_url() ?>/Inventory/Inventory/data_tr?id='+inventory_move_id);
					}
				});

				if($i>1){
					$('#transaction tbody tr:last').after(
						'<tr> \
							<td>'+product+'</td> \
							<td></td> \
							<td></td> \
							<td>'+product_amount+'</td> \
							<td></td> \
							<td>Edit | Delete</td> \
						</tr>'
					);
				} else{
					$('#transaction tbody').append(
						'<tr> \
							<td>'+product+'</td> \
							<td></td> \
							<td></td> \
							<td>'+product_amount+'</td> \
							<td></td> \
							<td>Edit | Delete</td> \
						</tr>'
					);
				}
			}
		});

	// Edit Product Row
	$('#transaction').on('click','.edit',function(){
		var amount = $(this).parent().siblings().find('input');

		amount.removeAttr('readonly');
		$(this).attr('class','update');
		$(this).text('update');
	});

	$('#transaction').on('click','.update',function(){
		var amount = $(this).parent().siblings().find('input');

		var id = $(this).attr('id');

		console.log(id);
		$.ajax({
			url:'<?php echo site_url() ?>/Inventory/Inventory/update_tr?id='+id,
				type: 'POST',
				data: {amount:amount},
			success: function(){
				$('#transaction').load('<?php echo site_url() ?>/Inventory/Inventory/data_tr?id='+inventory_move_id);
			}
		});

		amount.attr('readonly','readonly');
		$(this).attr('class','edit');
		$(this).text('Edit');
	});

	// Delete Product Row
		$('#transaction').on('click','.DeltransactionRow',function(){

		var answer = confirm("คุณต้องการลบหรือไม่?");
		if (answer) {
			id = $(this).attr('id');
			$.ajax({
				url:'<?php echo site_url() ?>/Inventory/Inventory/del_tr',
				type: 'GET',
				data: {id : id},
				success: function(){
					console.log('success');
				}
			});
			$(this).closest('tr').remove();
		}else{
			return false;
		}

		});
	});// End jquery

</script>