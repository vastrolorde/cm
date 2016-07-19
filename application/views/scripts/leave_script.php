<script type="text/javascript">
	$(document).ready(function(){

	// คำนวณเวลาแตกต่าง

		$('#lve_out').change(function(){
			var d2 = $('#lve_out').val();
			var d1 = $('#lve_in').val();

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
			$('#diff').val(diff);
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

});
</script>
