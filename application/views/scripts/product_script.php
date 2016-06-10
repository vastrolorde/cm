<script type="text/javascript">
	$(document).ready(function(){

	// Add Attribute Row
		$i = $('#Product_detail tr').length; //Count Row
		$('#Add_Product_row').on('click', function(){
			$i++;
			
			$('#Product_detail tr:last').after('<tr> \
					<td>'+$i+'</td> \
                    <td><input type="text" id="product_AttrName" name="product_Attr['+$i+'][Name]" placeholder="คุณลักษณะ"></td> \
                    <td><input type="text" id="product_AttrDesc" name="product_Attr['+$i+'][Desc]" placeholder="รายละเอียด"></td> \
					<td><a class="Del_Product_row">Delete</a></td> \
				</tr>');
		});

	// Delete Attribute Row
		$('#Product_detail').on('click','.Del_Product_row',function(){
			if ($("#Product_detail tr").length != 1) {
				$(this).closest('tr').remove();
			}else{
				alert('เหลือแถวสุดท้ายแล้ว ไม่สามารถลบได้');
			}
		});

	// Autocomplete
		$("#search").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "<?php echo site_url().'/product/lookup'; ?>",
					data: {
						search:	$("#search").val()
					},
					dataType: "json",
					type: "POST",
					success: function (data) {
		                response(data.map(function (value) {
		                    return {
		                        'label': value.product_name,
		                        'value': value.product_name
		                    };
		            	}))
		            }
				});
			},
			minLength: 3
		});

	});	
</script>