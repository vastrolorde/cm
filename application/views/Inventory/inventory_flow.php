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

		<table id="datatable">
			<thead>
				<tr>
					<th>id</th>
					<th>รายการสินค้า</th>
					<th>stock</th>
					<th>จอง</th>
					<th>นำออก</th>
					<th>นำเข้าแล้ว</th>
					<th>คงเหลือ</th>
				</tr>
			</thead>
			<tbody>
			  <?php
			    if($product != null){
			    foreach ($product as $key){
			      echo '
			    <tr>
			      <td>'.$key->product_id.'</td>
			      <td>'.$key->product_name.'</td>
			      <td>'.$key->product_stock.'</td>
			    </tr>
			      ';
			      }
			    }else{
			      echo '
			        <tr>
			          <td colspan="6"> No Data </td>
			        </tr>
			      ';
			    }
			  ?>
			</tbody>
		</table>

	</div>
</div>