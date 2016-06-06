<script type="text/javascript">
	$(document).ready(function(){

	// Add Attribute Row
		$i = $('#contactor tbody tr').length; //Count Row
		$('#Add_contactor_row').on('click', function(){
			$i++;
			
			$('#contactor tr:last').after('<tr> \
					<td>'+$i+'</td> \
              <td><input type="text" name="partner_contactor['+$i+'][name]" placeholder="กรอก ชื่อผู้ติดต่อ"></td> \
              <td><input type="text" name="partner_contactor['+$i+'][position]" placeholder="กรอก ตำแหน่ง"></td> \
              <td><input type="text" name="partner_contactor['+$i+'][tel]" placeholder="กรอก เบอร์โทรศัพท์"></td> \
              <td><input type="text" name="partner_contactor['+$i+'][email]" placeholder="กรอก email"></td> \
              <td><input type="text" name="partner_contactor['+$i+'][remark]" placeholder="กรอก หมายเหตุ"></td> \
              <td><a href="#" class="Del_contactor_row">ลบ</a></td> \
				</tr>');
		});

	// Delete Attribute Row
		$('#contactor').on('click','.Del_contactor_row',function(){
			if ($("#contactor tbody tr").length != 1) {
				$(this).closest('tr').remove();
			}else{
				alert('เหลือแถวสุดท้ายแล้ว ไม่สามารถลบได้');
			}
		});

	// Alert Popup
	    $('.delitem').click(function (){
	       var answer = confirm("คุณต้องการลบหรือไม่?");
	          if (answer) {
	             return true;
	          }else{
	             return false;
	          }
	    });

	// Autocomplete
		$("#search").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "<?php echo site_url().'/partner/lookup'; ?>",
					data: {
						search:	$("#search").val()
					},
					dataType: "json",
					type: "POST",
					success: function (data) {
		                response(data.map(function (value) {
		                    return {
		                        'label': value.partner_name,
		                        'value': value.partner_name
		                    };
		            	}))
		            }
				});
			},
			minLength: 3
		});

	});	
</script>