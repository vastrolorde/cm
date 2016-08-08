<div class="top-bar sub-top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><?php echo $title;?></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <li><a class="hollow button" href="<?php echo site_url('/login/create_user'); ?>">เพิ่ม</a></li>
    </ul>
  </div>
</div>

<div class="row">
	<div class="large-12 columns">

	<table id="datatable">
	  <thead>
	    <tr>
	      <th>email</th>
	      <th>groups</th>
	      <th>action</th>
	    </tr>
	  </thead>
	  <tbody>
	    
	    <?php
	    	print_r($result);
	    	// foreach($result as $row){
	    	// 	echo '<tr>';
	    	// 	echo '<td>'.$row->email.'</td>';
	    	// 	echo '<td>'.$row->group_id.'</td>';
	    	// 	echo '<td><a href="'.site_url().'/login/edit_user/'.$row->id.'">Edit</a> | <a class="delitem" href="'.site_url().'/login/del_user/'.$row->id.'">Delete</a></td>';
	    	// 	echo '</tr>';
	    	// }
	    ?>
	  </tbody>
	</table>


	</div>
</div>