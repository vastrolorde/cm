<script type="text/javascript">
	$(document).ready(function(){
	$('#datatable').DataTable();

		var inventory_move_id = $('#id').val();

		$('#transaction').load('<?php echo site_url() ?>/Inventory/Inventory/data_tr?id='+inventory_move_id);

	// Add Product Row

	$i = $('#transaction tr').length; //Count Row

		$('#AddtransactionRow').on('click', function(){
			//ดึงค่าตัวแปรจาก input
			var product = $('#product_id').val();
			var product_amount = $('#product_amount').val();

			//สร้างค่าสำหรับเตรียมส่งเข้า db
			var insert_data = {'inventory_move_id': inventory_move_id,'product_id': product, 'amount': product_amount};

			//สร้างตัวแปรหาค่าซ้ำ
			var Duplicate_row = [];

			$('#transaction tbody tr td:first-child').each(function(){
				var ex_product = $(this).text();

				// Push ผลลัพธ์ที่ตรวจสอบออกไป โดย false คือ ค่าซ้ำ true คือค่าไม่ซ้ำ 
				if(ex_product==product){
					Duplicate_row.push('false');
				}else{
					Duplicate_row.push('true');
				}
			});

			// ทำการนับตำนวน ค่า false แล้วเก็บไว้ในตัวแปร
			var dupNum = jQuery.grep(Duplicate_row, function(a){
				return a == 'false'
			}).length // 3

			//หากนับได้มากกว่า 0 ถือว่ามีค่าซ้ำ ไม่ให้บันทึก
			if(dupNum>0){
				alert('ข้อมูลซ้ำ');
			}else{
				//Ajax Add
				$.ajax({
					url:'<?php echo site_url() ?>/Inventory/Inventory/add_tr',
					type: 'POST',
					data: insert_data,
					success: function(){
						$('#transaction').load('<?php echo site_url() ?>/Inventory/Inventory/data_tr?id='+inventory_move_id);
					}
				});
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
		var amount_input = $(this).parent().siblings().find('input');
		var amount = amount_input.val();

		var id = $(this).attr('id');

		console.log(id);
		console.log(amount);

		$.ajax({
			url:'<?php echo site_url() ?>/Inventory/Inventory/update_tr?id='+id,
			type: 'POST',
			data: {amount:amount},
			success: function(){
				$('#transaction').load('<?php echo site_url() ?>/Inventory/Inventory/data_tr?id='+inventory_move_id);
				console.log('success');
			}
		});

		amount_input.attr('readonly','readonly');
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