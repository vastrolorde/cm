<?php
  if(!isset($group)){
    echo form_open('/login/add_group');
  }else{
    echo form_open('/login/update_group/'.$group[0]->id);
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
				if(!isset($group)){
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('group').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('group').'</div></div>';
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('group_desc').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('group_desc').'</div></div>';
				}else{
					foreach($group as $row){
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('id').'</div>
							<div class="large-10 medium-8 small-8 columns">'.$row->id.form_hidden('id',$row->id).'</div></div>';
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('group').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('ชื่อกลุ่ม',$row->name).'</div></div>';
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('group_desc').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('รายละเอียด',$row->description).'</div></div>';
					}
				}
			?>
		</div>
	</div>

 	</div>
 </div>