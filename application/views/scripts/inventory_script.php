<script type="text/javascript">
	$(document).ready(function(){

	// Add Product Row
	$i = $('#inventory_transaction tr').length; //Count Row
	$('#addProductRow').on('click', function(){
		
		$('#inventory_transaction tr:last').after(' \
			<tr> \
			<td>'+$i+'</td> \
			<td>' + $("#product_id").val() + '</td> \
			<td>8 kg</td> \
			<td>' + $("#amount").val() + '</td> \
			<td><a href="#" class="delProductRow">ลบ</a></td> \
			</tr>'
		);

		$("#product_id").val('');
		$("#amount").val('');

		$i++;
	});

	// Delete Product Row
		$('#positions').on('click','.delProductRow',function(){
			if ($("#inventory_transaction tbody tr").length != 1) {
				$(this).closest('tr').remove();
			}else{
				alert('เหลือแถวสุดท้ายแล้ว ไม่สามารถลบได้');
			}
		});


	// change address function


			$('.warehouse').hide();

		$('#delivery_add').change(function(){
			var address = $('#delivery_add').val();

			if(address == '!sameAdd'){

				$('.warehouse').hide();
				$('input[name="invent_move_add1"]').val('').removeAttr('readonly');
				$('input[name="invent_move_add2"]').val('').removeAttr('readonly');
				$('input[name="invent_move_subDist"]').val('').removeAttr('readonly');
				$('input[name="invent_move_Dist"]').val('').removeAttr('readonly');
				$('input[name="invent_move_Province"]').val('').removeAttr('readonly');
				$('input[name="invent_move_Postal"]').val('').removeAttr('readonly');
			
			}else if(address == 'sameAdd'){

				$('.address input').attr('readonly','readonly');
				$('.warehouse').hide();
				
				// var partner =  $('#partner_id').val();

				$.ajax({
							url: "<?php echo site_url().'/Inventory/Inventory/partner_get'; ?>",
							data: {
								pid : $('#partner_id').val()
							},
							dataType: "json",
							type: "POST",
							success: function (data) {
								console.log(data);
								$.each(data,function(key,value){
									$('input[name="invent_move_add1"]').val(value['add1']);
									$('input[name="invent_move_add2"]').val(value['add2']);
									$('input[name="invent_move_subDist"]').val(value['subDist']);
									$('input[name="invent_move_Dist"]').val(value['Dist']);
									$('input[name="invent_move_Province"]').val(value['Province']);
									$('input[name="invent_move_Postal"]').val(value['Postal']);
								});
   
							},
							error: function (request, status, error) {
								console.log(error);
								console.log(status);
								console.log(request);
							}
						});

				$('#partner_id').on('change',function(){

					$.ajax({
						url: "<?php echo site_url().'/Inventory/Inventory/partner_get'; ?>",
						data: {
							pid : $('#partner_id').val()
						},
						dataType: "json",
						type: "POST",
						success: function (data) {
							console.log(data);
							$.each(data,function(key,value){
								$('input[name="invent_move_add1"]').val(value['add1']);
								$('input[name="invent_move_add2"]').val(value['add2']);
								$('input[name="invent_move_subDist"]').val(value['subDist']);
								$('input[name="invent_move_Dist"]').val(value['Dist']);
								$('input[name="invent_move_Province"]').val(value['Province']);
								$('input[name="invent_move_Postal"]').val(value['Postal']);
							});

						},
						error: function (request, status, error) {
							console.log(error);
							console.log(status);
							console.log(request);
						}
					});


				});


			}else if(address == 'compAdd'){

				$('.address input').attr('readonly','readonly');
				$('.warehouse').show();

				$('#warehouse').on('change',function(){

						$.ajax({
							url: "<?php echo site_url().'/Inventory/Inventory/warehouse_get'; ?>",
							data: {
								warehouse : $('#warehouse').val()
							},
							dataType: "json",
							type: "POST",
							success: function (data) {
								console.log(data);
								$.each(data,function(key,value){
									$('input[name="invent_move_add1"]').val(value['wh_add1']);
									$('input[name="invent_move_add2"]').val(value['wh_add2']);
									$('input[name="invent_move_subDist"]').val(value['wh_subDist']);
									$('input[name="invent_move_Dist"]').val(value['wh_Dist']);
									$('input[name="invent_move_Province"]').val(value['wh_Province']);
									$('input[name="invent_move_Postal"]').val(value['wh_Postal']);
								});
   
							},
							error: function (request, status, error) {
								console.log(error);
								console.log(status);
								console.log(request);
							}
						});
				});
			};
		})

	});// End jquery

</script>