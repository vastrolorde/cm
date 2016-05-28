<script type="text/javascript">
	$(document).ready(function(){

function randomString(len, charSet) {
    charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var randomString = '';
    for (var i = 0; i < len; i++) {
    	var randomPoz = Math.floor(Math.random() * charSet.length);
    	randomString += charSet.substring(randomPoz,randomPoz+1);
    }
    return randomString;
}


	// Add Attribute Row
		$i = $('#Product_detail tr').length; //Count Row
		$('#Add_Product_row').on('click', function(){
			$product_AttrName = $('#product_AttrName').val();
			$product_AttrDesc = $('#product_AttrDesc').val();

			$product_AttrID   = randomString('5');
			
			$('#Product_detail tr:last').after('<tr id="row'+$i+'"> \
					<td>'+$i+'<input type="hidden" id="product_AttrID" value='+$product_AttrID+' name="product_AttrID[]"></td> \
					<td><input type="text" id="product_AttrName" name="product_AttrName[]" placeholder="คุณลักษณะ" value='+$product_AttrName+'></td> \
					<td><input type="text" id="product_AttrDesc" name="product_AttrDesc[]" placeholder="รายละเอียด" value='+$product_AttrDesc+'></td> \
					<td><a class="Del_Product_row">Delete</a></td> \
				</tr>');

			// Reset Field onClick="$(this).closest(\'tr\').remove();"
			$('#product_AttrName').val('');
			$('#product_AttrDesc').val('');
			$i++;
		});

	// Delete Attribute Row
		$('.Del_Product_row').click(function(){
			$(this).closest('tr').remove();

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