<?php

?>

<?php
  if(!isset($user)){
    echo form_open('/login/add_user');
  }else{
    echo form_open('/login/update_user/'.$user[0]->id);
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
				if(!isset($user)){
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('email').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('email').'</div></div>';
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('password').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('password').'</div></div>';
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('First Name').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('first_name').'</div></div>';
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('Last Name').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('last_name').'</div></div>';
				}else{
					foreach($user as $row){
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('email').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('email',$row->email).form_hidden('id',$row->id).'</div></div>';
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('password').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('password',$row->password).'</div></div>';
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('First Name').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('first_name',$row->first_name).'</div></div>';
						echo '<div class="row">
							<div class="text-right large-2 medium-4 small-4 columns">'.form_label('Last Name').'</div>
							<div class="large-10 medium-8 small-8 columns">'.form_input('last_name',$row->last_name).'</div></div>';
					}
				}
			?>
		</div>
	</div>

 	</div>
 </div>