<?php
  if(!isset($auth)){
    echo form_open('/login/add_auth');
  }else{
    echo form_open('/login/update_auth/'.$auth[0]->id);
  }
?>

 <div class="row">
 	<div class="large-12 columns">

		<!--  Sub Topbar -->
		<div class="top-bar sub-top-bar">
			<div class="top-bar-left">
				<ul class="dropdown menu" data-dropdown-menu>
					<li class="menu-text"><h4><?php echo $title ?></h4></li>
				</ul>
			</div>
			<div class="top-bar-right">
				<ul class="menu">
					<?php echo $execute; ?>
				</ul>
			</div>
		</div>

	<!-- Info -->

	<div class="row">
		<div class="large-12 columns">
			<?php

				foreach($users as $row){
					$option[$row->id] = $row->email;
				}

				if(!isset($auth)){
						echo '<div class="row">
								<div class="text-right large-2 medium-4 small-4 columns">'.form_label('เลือก User').'</div>
								<div class="large-10 medium-8 small-8 columns">
									'.form_dropdown('user',$option).'
								</div>
							</div>';
						echo '<div class="row">
								<h5>เลือกกลุ่มที่ต้องการ</h5>';
								foreach($groups as $row){
									echo form_checkbox('group[]',$row->id).form_label($row->description).'<br />';
								}
						echo '</div>';
				}else{
					foreach($auth as $row){
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('id').'</div>
							<div class="large-10 medium-8 small-8 columns">'.$row->id.form_hidden('id',$row->id).'</div></div>';
						echo '<div class="row">
								<div class="text-right large-2 medium-4 small-4 columns">'.form_label('เลือก User').'</div>
								<div class="large-10 medium-8 small-8 columns">
									'.form_dropdown('auth',$option).'
								</div>
							</div>';
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('auth_desc').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('รายละเอียด',$row->description).'</div></div>';
					}
				}
			?>
		</div>
	</div>

 	</div>
 </div>