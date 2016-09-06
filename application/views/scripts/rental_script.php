<script type="text/javascript">
$(document).ready(function(){
	$('#datatable').DataTable();
	$('#validate_form').parsley();


//autocomplete ลูกค้า
	$('#partner_id').autocomplete({
			source: function(req,res){
				$.ajax({
					url:'<?php echo site_url() ?>/settings/search/lookup',
					data: {search: $('#refdoc_id').val()},
					dataType:"json",
					type:"POST",
					success: function(data){
						res(data.map(function(value){
								return {
									'label' : value.partner_name,
									'value' : value.id
								}
						}));
					}
				})
			},
			minLength: 2
	});

//autocomplete ลูกค้า
	$('#product_search').autocomplete({
			source: function(req,res){
				$.ajax({
					url:'<?php echo site_url() ?>/settings/search/lookup_product',
					data: {search: $('#product_search').val()},
					dataType:"json",
					type:"POST",
					success: function(data){
						res(data.map(function(value){
								return {
									'label' : value.product_name,
									'value' : value.product_id
								}
						}));
					}
				})
			},
			minLength: 2
	});

//Call View
	var inventory_move_id = $('#id').val();
	$('#transaction').load('<?php echo site_url() ?>/rental/data_tr?id='+inventory_move_id,
		function(){
			VAT_calc();
		}
	);

	Date_calc();
	$('#expire_contract').change(function() {
		Date_calc();
	});

//Date Date_calc
	function Date_calc(){
		var start = $('#start_contract').datepicker('getDate');
		var end   = $('#expire_contract').datepicker('getDate');
		var days   = (end - start)/1000/60/60/24;
		
		$('#duration').val(days+1);
	}

// Vat calculation
	function VAT_calc(){


		var daily_rental = $('#daily_rental').val();
		var total_rental = parseFloat(daily_rental)*parseFloat($('#duration').val());
		var discount = $('#discount_db').val();
		var subtotal = parseFloat(total_rental)-parseFloat(discount);

		$('#VATType').val($('#VATType_db').val());
		var VATType = parseFloat($('#VATType option:selected').val()).toFixed(2);
		var VAT = parseFloat(subtotal*VATType).toFixed(2);

		var grandtotal = parseFloat(VAT)+parseFloat(subtotal);

		$('#total_rental').val(total_rental);
		$('#subtotal').val(subtotal);
		$('#discount').val(discount);
		$('#VAT').val(VAT);
		$('#grandtotal').val(grandtotal);

		//Track on change
		$('#total_rental, #discount, #VATType, #expire_contract').change(function() {
			daily_rental = $('#daily_rental').val();
			total_rental = parseFloat(daily_rental)*parseFloat($('#duration').val());
			discount = $('#discount').val();
			subtotal = parseFloat(total_rental)-parseFloat(discount);

			VATType = parseFloat($('#VATType option:selected').val()).toFixed(2);
			VAT = parseFloat(subtotal*VATType).toFixed(2);

			grandtotal = parseFloat(VAT)+parseFloat(subtotal);

			$('#total_rental').val(total_rental);
			$('#subtotal').val(subtotal);
			$('#discount').val(discount);
			$('#VAT').val(VAT);
			$('#grandtotal').val(grandtotal);
		});
	}

//Add

	$i = $('#transaction tr').length; //Count Row

		$('#AddtransactionRow').on('click', function(){
			//ดึงค่าตัวแปรจาก input
			var id             = $('#id').val();
			var product        = $('#product_id').val();
			var product_amount = $('#product_amount').val();

			//สร้างค่าสำหรับเตรียมส่งเข้า db
			var insert_data = {'rental_id': id,'product_id': product, 'amount': product_amount};

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
					url:'<?php echo site_url() ?>/rental/add_tr',
					type: 'POST',
					data: insert_data,
					success: function(){
						$('#transaction').load('<?php echo site_url() ?>/rental/data_tr?id='+inventory_move_id,
							function(){
								VAT_calc();
							}

						);//
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
			url:'<?php echo site_url() ?>/rental/update_tr?id='+id,
			type: 'POST',
			data: {amount:amount},
			success: function(){
				$('#transaction').load('<?php echo site_url() ?>/rental/data_tr?id='+inventory_move_id,
					function(){
						VAT_calc();
					}

				);//
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
				url:'<?php echo site_url() ?>/rental/del_tr',
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

// Control Peyment
	$('select[name="guaranteeType"]').each(function(){

				if($(this).val() == 'โอน'){
					$('input[name="tranferNote"]').attr('readonly',true);
					$('input[name="Acc_no"]').removeAttr('readonly');
					$('input[name="Acc_no"]').val('');
				}else if($(this).val() == 'เงินสด'){
					$('input[name="tranferNote"]').attr('readonly',true);
					$('input[name="Acc_no"]').attr('readonly',true);
					$('input[name="branch"]').attr('readonly',true);
				}else if($(this).val() == 'เช็ค'){
					$('input[name="tranferNote"]').removeAttr('readonly');
					$('input[name="Acc_no"]').removeAttr('readonly');
					$('input[name="branch"]').removeAttr('readonly');
					$('input[name="tranferNote"]').val('');
					$('input[name="Acc_no"]').val('');
					$('input[name="branch"]').val('');
				}

			$(this).on('change',function(){
				if($(this).val() == 'โอน'){
					$('input[name="tranferNote"]').attr('readonly',true);
					$('input[name="Acc_no"]').removeAttr('readonly');
				}else if($(this).val() == 'เงินสด'){
					$('input[name="tranferNote"]').attr('readonly',true);
					$('input[name="Acc_no"]').attr('readonly',true);
					$('input[name="branch"]').attr('readonly',true);
				}else if($(this).val() == 'เช็ค'){
					$('input[name="tranferNote"]').removeAttr('readonly');
					$('input[name="Acc_no"]').removeAttr('readonly');
					$('input[name="branch"]').removeAttr('readonly');
				}
			});
		});
	
});
</script>