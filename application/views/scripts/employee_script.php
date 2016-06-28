<script src="<?php echo asset_url().'js/js_get_th.js'; ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){

	// Add Attribute Row
		$i1 = $('#positions tr').length; //Count Row
		$('#Add_position_row').on('click', function(){
			
			$('#positions tr:last').after(' \
                  <tr> \
                    <td>'+$i1+'</td> \
                    <td><input type="text" name="emp_position['+$i1+'][position]" placeholder="กรอก ตำแหน่ง"></td> \
                    <td><input type="text" class="datepicker" name="emp_position['+$i1+'][date]" placeholder="กรอก วันที่"></td> \
                    <td><input type="text" name="emp_position['+$i1+'][dept]" placeholder="กรอก แผนก"></td> \
                    <td><input type="text" name="emp_position['+$i1+'][salary]" placeholder="กรอก เงินเดือน"></td> \
                    <td><input type="text" name="emp_position['+$i1+'][remark]" placeholder="กรอก หมายเหตุ"></td> \
                    <td><a href="#" class="Del_position_row">ลบ</a></td> \
                  </tr>');

			$i1++;
		});

		$i2 = $('#training tr').length; //Count Row
		$('#Add_training_row').on('click', function(){
			
			$('#training tr:last').after(' \
                    <tr> \
                      <td>'+$i2+'</td> \
                      <td><input type="text" name="emp_training['+$i2+'][subject]" placeholder="กรอก หลักสูตร"></td> \
                      <td><input type="text" class="datepicker" name="emp_training['+$i2+'][date]" placeholder="กรอก วันที่อบรม"></td> \
                      <td><input type="text" name="emp_training['+$i2+'][institute]" placeholder="กรอก สถาบันอบรม"></td> \
                      <td><input type="text" name="emp_training['+$i2+'][cert_no]" placeholder="กรอก Cert. ID"></td> \
                      <td><input type="text" name="emp_training['+$i2+'][remark]" placeholder="กรอก หมายเหตุ"></td> \
                        <td><a href="#" class="Del_training_row">ลบ</a></td> \
                    </tr>');
			
			$i2++;
		});

	// Delete Attribute Row
		$('#positions').on('click','.Del_position_row',function(){
			if ($("#positions tbody tr").length != 1) {
				$(this).closest('tr').remove();
			}else{
				alert('เหลือแถวสุดท้ายแล้ว ไม่สามารถลบได้');
			}
		});

		$('#training').on('click','.Del_training_row',function(){
			if ($("#training tbody tr").length != 1) {
				$(this).closest('tr').remove();
			}else{
				alert('เหลือแถวสุดท้ายแล้ว ไม่สามารถลบได้');
			}
		});

	});	
</script>