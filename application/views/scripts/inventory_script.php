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


			$('.address input').attr('readonly','readonly');
			$('.wherehouse').hide();

			$('input[name="invent_move_add1"]').val('test2');
			$('input[name="invent_move_add2"]').val('test2');
			$('input[name="invent_move_subDist"]').val('test2');
			$('input[name="invent_move_Dist"]').val('test2');
			$('input[name="invent_move_Province"]').val('test2');
			$('input[name="invent_move_Postal"]').val('test2');

		$('#delivery_add').change(function(){
			var address = $('#delivery_add').val();

			if(address == '!sameAdd'){
				$('.wherehouse').hide();
				$('input[name="invent_move_add1"]').val('').removeAttr('readonly');
				$('input[name="invent_move_add2"]').val('').removeAttr('readonly');
				$('input[name="invent_move_subDist"]').val('').removeAttr('readonly');
				$('input[name="invent_move_Dist"]').val('').removeAttr('readonly');
				$('input[name="invent_move_Province"]').val('').removeAttr('readonly');
				$('input[name="invent_move_Postal"]').val('').removeAttr('readonly');
			}else if(address == 'sameAdd'){
				$('.address input').attr('readonly','readonly');

				$('.wherehouse').hide();
				$('input[name="invent_move_add1"]').val('test2');
				$('input[name="invent_move_add2"]').val('test2');
				$('input[name="invent_move_subDist"]').val('test2');
				$('input[name="invent_move_Dist"]').val('test2');
				$('input[name="invent_move_Province"]').val('test2');
				$('input[name="invent_move_Postal"]').val('test2');
			}else if(address == 'compAdd'){
				$('.address input').attr('readonly','readonly');

				$('.wherehouse').show();
				$('input[name="invent_move_add1"]').val('93 ซอยอุดมสุข 51');
				$('input[name="invent_move_add2"]').val('ถนนสุขุมวิท 103');
				$('input[name="invent_move_subDist"]').val('บางจาก');
				$('input[name="invent_move_Dist"]').val('พระโขนง');
				$('input[name="invent_move_Province"]').val('กรุงเทพ');
				$('input[name="invent_move_Postal"]').val('10260');
			};
		})

	});// End jquery

</script>