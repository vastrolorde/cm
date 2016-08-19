<div class="top-bar sub-top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><?php echo $title;?></li>
    </ul>
  </div>
</div>

<div class="row">
	<div class="large-6 columns large-centered">
		<?php 
			echo form_open('/HR/Attendance/data');

			echo form_label('ชื่อพนักงาน');
			echo form_input('emp');

			$since = array(
				'type' => 'text',
				'name' => 'since',
				'placeholder' => 'เลือกวันที่',
				'class' => 'datepicker'
				);

			$until = array(
				'type' => 'text',
				'name' => 'until',
				'placeholder' => 'เลือกวันที่',
				'class' => 'datepicker'
				);
			echo '
<div class="row">
	<div class="large-6 columns">';
		echo form_label('ตั้งแต่');
		echo form_input($since).'</div>';

	echo '<div class="large-6 columns">';
		echo form_label('จนถึง');
		echo form_input($until).'</div></div>';
		?>
		<div class="text-right"><button type="submit" class="button">ตกลง</button></div>
	</div>
</div>