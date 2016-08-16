<?php
/*
	รายงานแสดง Flow ของคลังสินค้า โดย

				|_______________Receive_____________||_______________Deliver_____________|
	|ชนิดรายการ	|		Process	|		Done		||		Process	|		Done		|
	|recieve	|		Y		|		Y			||				|					|
	|deliver	|				|					||		Y		|		Y			|
	|Rent in	|		Y		|		Y			||				|	Y(Sent back)	|
	|Rent out	|				|	Y(Sent back)	||		Y		|		Y			|


*/
?>
<div class="row">
	<div class="large-12 columns">

		<div class="top-bar sub-top-bar">
		  <div class="top-bar-left">
		    <ul class="dropdown menu" data-dropdown-menu>
		      <li class="menu-text"><?php echo $title;?></li>
		    </ul>
		  </div>
		  <div class="top-bar-right">
		    <ul class="menu">
		      <li><a class="hollow button" href="#">พิมพ์</a></li>
		    </ul>
		  </div>
		</div>

		<table id="datatable" class="stockFlow">
			<thead>
				<tr>
					<th rowspan="2">id</th>
					<th rowspan="2">stock</th>
					<th colspan="3" class="text-center">เข้า</th>
					<th colspan="5" class="text-center">ออก</th>
					<th rowspan="2">คงเหลือ</th>
				</tr>
				<tr>
					<th>ซื้อเข้า</th>
					<th>เช่ามา</th>
					<th>รับคืน</th>
					<th>จอง</th>
					<th>ระหว่างจัดส่ง</th>
					<th>ขายออก</th>
					<th>ส่งคืน</th>
					<th>ปล่อยเช่า</th>
				</tr>
			</thead>
			<tbody>
			  <?php

			  	$flow = array();

			    if($product != null){
				    foreach ($product as $key){
				    	// print_r($key);

				    	$id = $key['product_id'];
				    	$name = $key['product_name'];
				    	$product_stock = $key['product_stock'];
				    	$type = $key['type'];
				    	$status = $key['status'];
				    	$amount = $key['amount'];

				    	$flow[$id][$type][$status] = $amount;
				    	$flow[$id]['name'] = $name;
				    	$flow[$id]['product_stock'] = $product_stock;
				    }

				    $totalrow = 0;

				    foreach ($flow as $key => $value) {
				    	echo '<tr>';
					    	echo '<td>
					    			<p><span data-tooltip aria-haspopup="true" class="has-tip right" data-disable-hover="false" tabindex="1" title="'.$value['name'].'">'.$key.'</span></p>
					    		</td>
					    		<td>
									'.$value['product_stock'].'
					    		</td>';
					    		$totalrow += $value['product_stock'];

						    	if(isset($value["recieve"]['Purchase'])){
						    		echo '<td>'.$value["recieve"]['Purchase'].'</td>';
						    		$totalrow += $value["recieve"]['Purchase'];
						    	}else{
						    		echo '<td></td>';
						    	}
						    	if(isset($value["recieve"]['RentIn'])){
						    		echo '<td>'.$value["recieve"]['RentIn'].'</td>';
						    		$totalrow += $value["recieve"]['RentIn'];
						    	}else{
						    		echo '<td></td>';
						    	}
						    	if(isset($value["recieve"]['GotBack'])){
						    		echo '<td>'.$value["recieve"]['GotBack'].'</td>';
						    		$totalrow += $value["recieve"]['GotBack'];
						    	}else{
						    		echo '<td></td>';
						    	}


						    	if(isset($value["deliver"]['Reserved'])){
						    		echo '<td>'.$value["deliver"]['Reserved'].'</td>';
						    		$totalrow -= $value["deliver"]['Reserved'];
						    	}else{
						    		echo '<td></td>';
						    	}
						    	if(isset($value["deliver"]['Transport'])){
						    		echo '<td>'.$value["deliver"]['Transport'].'</td>';
						    		$totalrow -= $value["deliver"]['Transport'];
						    	}else{
						    		echo '<td></td>';
						    	}
						    	if(isset($value["deliver"]['Sale'])){
						    		echo '<td>'.$value["deliver"]['Sale'].'</td>';
						    		$totalrow -= $value["deliver"]['Sale'];
						    	}else{
						    		echo '<td></td>';
						    	}
						    	if(isset($value["deliver"]['SentBack'])){
						    		echo '<td>'.$value["deliver"]['SentBack'].'</td>';
						    		$totalrow -= $value["deliver"]['SentBack'];
						    	}else{
						    		echo '<td></td>';
						    	}
						    	if(isset($value["deliver"]['RentOut'])){
						    		echo '<td>'.$value["deliver"]['RentOut'].'</td>';
						    		$totalrow -= $value["deliver"]['RentOut'];
						    	}else{
						    		echo '<td></td>';
						    	}

						    echo '<td>';
						    
						    echo $totalrow;

						    echo '</td>';
				    	echo '</tr>';

				    	$totalrow = 0;
				    }

			    }else{
			      echo '
			        <tr>
			          <td colspan="14"> No Data </td>
			        </tr>
			      ';
			    }
			  ?>
			</tbody>
		</table>

	</div>
</div>