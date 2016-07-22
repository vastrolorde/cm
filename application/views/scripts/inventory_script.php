<script type="text/javascript">
	$(document).ready(function(){

		//Total Weight Row
		$('#totalweight').val(0);

		// Calculate Function

		function CalcTotal(){

			var total = 0;
			$('#inventory_transaction tr #sum').each(function(){
				var weight = $(this).val();
				total += parseInt(weight);
			});

			return total;
		}

	// Add Product Row
		$('#AddtransactionRow').on('click', function(){
			$.post()
		});


	// Delete Product Row
		$('#transaction').on('click','.deltransactionRow',function(){
			
			// Calculate
			var total = CalcTotal();
			$('#totalweight').val(total);

			$(this).closest('tr').remove();
		});
	});// End jquery

</script>