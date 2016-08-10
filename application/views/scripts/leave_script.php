<script type="text/javascript">
	$(document).ready(function(){

	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		events:[
		// For each orgchart box, provide the name, manager, and tooltip to show.
			<?php 
				$this->db->select('lve.emp_id,lve.lve_type,emp.id,emp.emp_fname,emp.emp_lname,lve.lve_date,lve.lve_in,lve.lve_out');
				$this->db->from('hr_leave as lve');
				$this->db->join('hr_employee_data as emp','lve.emp_id = emp.id');
				$this->db->where('emp.emp_status','บรรจุแล้ว');
				$this->db->or_where('emp.emp_status','ทดลองงาน');
				$query = $this->db->get()->result();

				foreach ($query as $row) {

					// change date format
					$date = strtr($row->lve_date, '/', '-');
					$newDate = date("Y-m-d", strtotime($date));


					echo "{title:'".$row->emp_fname." ".$row->emp_lname." ".$row->lve_type."',
					start:'".$newDate." ".$row->lve_in."',
					end:'".$newDate." ".$row->lve_out."',
					color: '";
					switch ($row->lve_type) {
						case 'Si':
							echo "#ff5050";
							break;
						case 'Bis':
							echo "#3399ff";
							break;
						case 'Vac':
							echo "orange";
							break;
						case 'Tr':
							echo "#66ff99";
							break;
					}

					echo "'},";
				}
			?>
		]
    })

	$('#datatable').DataTable();
	$('#validate_form').parsley();

		var id = $('#emp_id').val();

		$('#leaveTable').load('<?php echo site_url() ?>/HR/Leave/leave_table?id='+id);

	// คำนวณเวลาแตกต่าง

		$('#d2').change(function(){
			var d2 = $('#d2').val();
			var d1 = $('#d1').val();

			s = d1.split(':');
			e = d2.split(':');

			min = e[1]-s[1];	//ลบนาที
	
			if( (e[0] <= 12 && s[0] <= 12) || (e[0] >= 13 && s[0] >= 13) ){
				hour_carry = 0;
			}else{
				hour_carry = 1;
			}

			if(min < 0){
				min += 60;
				hour_carry += 1;
			}

			hour = (e[0]-s[0]-hour_carry);
			min = ((min/60)*100).toString();
			diff = (hour + '.' + min.substring(0,2))/8;
			$('#d_diff').val(diff);
		});

// Highlight cell ในตาราง

		$("#leave tbody td:nth-child(3)").each(function () {
			if (parseInt($(this).text(), 10) >= 15) {
				$(this).css("color", "yellow");
				$(this).css("font-weight", "bold");
			}
		});

		$("#leave tbody td:nth-child(4)").each(function () {
			if (parseInt($(this).text(), 10) >= 6) {
				$(this).css("color", "red");
				$(this).css("font-weight", "bold");
			}
		});


		$("#leave tbody td:nth-child(5)").each(function () {
			if (parseInt($(this).text(), 10) >= 10) {
				$(this).css("color", "red");
				$(this).css("font-weight", "bold");
			}
		});

		// Edit Leave
	$('#leaveTable').on('click','.edit',function(){
		var input = $(this).parent().siblings().find('input');

		input.removeAttr('readonly');
		$(this).attr('class','update');
		$(this).text('update');
	});

	$('#leaveTable').on('click','.update',function(){
		var input = $(this).parent().siblings().find('input');

		var date = $(this).parent().siblings().find('#lve_date').val();
		var lve_in = $(this).parent().siblings().find('#lve_in').val();
		var lve_out = $(this).parent().siblings().find('#lve_out').val();

		//คำนวณค่า Diff
			s = lve_in.split(':');
			e = lve_out.split(':');

			min = e[1]-s[1];	//ลบนาที
	
			if( (e[0] <= 12 && s[0] <= 12) || (e[0] >= 13 && s[0] >= 13) ){
				hour_carry = 0;
			}else{
				hour_carry = 1;
			}

			if(min < 0){
				min += 60;
				hour_carry += 1;
			}

			hour = (e[0]-s[0]-hour_carry);
			min = ((min/60)*100).toString();
			diff = (hour + '.' + min.substring(0,2))/8;
			var lve_diff = diff;

		var lve_id = $(this).attr('id');

		$.ajax({
			url:'<?php echo site_url() ?>/HR/Leave/edit?id='+lve_id,
			type: 'POST',
			data: {lve_date:date, lve_in:lve_in, lve_out:lve_out, lve_diff:lve_diff},
			success: function(){
				$('#leaveTable').load('<?php echo site_url() ?>/HR/Leave/leave_table?id='+id);
				console.log('success');
			}
		});

		input.attr('readonly','readonly');
		$(this).attr('class','edit');
		$(this).text('Edit');
	});

	// Delete Row
		$('#leaveTable').on('click','.delete',function(){

		var answer = confirm("คุณต้องการลบหรือไม่?");
		if (answer) {
			id = $(this).attr('id');
			$.ajax({
				url:'<?php echo site_url() ?>/HR/Leave/delete',
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

});
</script>
