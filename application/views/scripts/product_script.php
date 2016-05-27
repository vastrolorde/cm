<script type="text/javascript">
	$(document).ready(function(){

	// Add Attribute Row
		$i = $('#Product_detail tr').length; //Count Row
		$('#Add_Product_row').on('click', function(){
			$product_AttrName = $('#product_AttrName').val();
			$product_AttrDesc = $('#product_AttrDesc').val();
			
			$('#Product_detail tr:last').after('<tr id="row'+$i+'"> \
					<td>'+$i+'</td> \
					<td><input type="text" id="product_AttrName" name="product_AttrName[]" placeholder="คุณลักษณะ" value='+$product_AttrName+'></td> \
					<td><input type="text" id="product_AttrDesc" name="product_AttrDesc[]" placeholder="รายละเอียด" value='+$product_AttrDesc+'></td> \
					<td><a onClick="$(this).closest(\'tr\').remove();">Delete</a></td> \
				</tr>');

			// Reset Field
			$('#product_AttrName').val('');
			$('#product_AttrDesc').val('');
			$i++;
		});

	// Alert Popup
    $('.delitem').click(function (){
       var answer = confirm("Are you sure?");
          if (answer) {
             return true;
          }else{
             return false;
          }
    });

	});	
</script>