/* lib_script.js
ใช้เก็บตัวอย่าง การเขียน js ทั้งที่ใช้งานจริงและไม่ได้ใช้งานไว้อ้างอิง
*/

// ใช้คำนวณ GrandTotal

		colSum();

		function colSum() {
			var sum=0;
		//iterate through each input and add to sum
			$('.total_weight').each(function() {     
				sum += parseInt($(this).html());                     
			});
		//change value of total
			$('#grandtotal').html(sum);

			console.log(sum);
		}