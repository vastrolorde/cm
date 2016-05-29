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
			$i++;
			$product_AttrID   = randomString('5');
			
			$('#Product_detail tr:last').after('<tr id="row'+$i+'"> \
					<td>'+$i+'<input type="hidden" id="product_AttrID" value='+$product_AttrID+' name="product_AttrID[]"></td> \
					<td><input type="text" id="product_AttrName" name="product_AttrName[]" placeholder="คุณลักษณะ"></td> \
					<td><input type="text" id="product_AttrDesc" name="product_AttrDesc[]" placeholder="รายละเอียด"></td> \
					<td><a class="Del_Product_row">Delete</a></td> \
				</tr>');
		});

	// Delete Attribute Row
		$('#Product_detail').on('click','.Del_Product_row',function(){
			if ($("#Product_detail tr").length != 1) {
				$(this).closest('tr').remove();
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

	});	
</script>