<?php

  $attributes = array(
      'id' => 'validate_form'
    );

  if(!isset($data)){
    echo form_open('/HR/Dept/add',$attributes);
  }else{
    echo form_open('/HR/Dept/edit/'.$data[0]->id,$attributes);
  }
/*

'id'           => รหัสแผนก,
'dept_name'    => ชื่อแผนก,
'dept_mother'  => แผนกแม่,
'dept_manager' => ผู้จัดการ

*/
?>

<div class="row">
  <div class="large-12 column">

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
      <div class="large-6 columns">

        <?php
          
          if(isset($data)){
            //Assign Variable

            $id = array(
              'type' => 'text',
              'name' => 'id',
              'value' => $data[0]->id,
              'readonly' => 'readonly'
              );
            $dept_mother = $data[0]->dept_mother;

            echo form_label('รหัสแผนก')
                .form_input($id);
            echo form_label('แผนกแม่')
                .form_input('dept_mother',$dept_mother);
          }else{
              $id = array(
                'type' => 'text',
                'name' => 'id',
                'data-parsley-required' => 'true'
              );

            echo form_label('รหัสแผนก')
                .form_input($id);
            echo form_label('แผนกแม่')
                .form_input('dept_mother');
          }
        ?>

      </div>

      <div class="large-6 columns">
        <?php
          
          if(isset($data)){
            //Assign Variable

            $dept_name = array(
              'type' => 'text',
              'name' => 'dept_name',
              'value' => $data[0]->dept_name,
              'data-parsley-required' => 'true'
              );

            $dept_manager = array(
              'type' => 'text',
              'name' => 'dept_manager',
              'value' => $data[0]->dept_manager,
              'data-parsley-required' => 'true'
              );

            $dept_manager = $data[0]->dept_manager;

            echo form_label('ชื่อแผนก')
                .form_input($dept_name);
            echo form_label('ผู้จัดการ')
                .form_input($dept_manager);
          }else{

            $dept_name = array(
              'type' => 'text',
              'name' => 'dept_name',
              'data-parsley-required' => 'true'
              );

            $dept_manager = array(
              'type' => 'text',
              'name' => 'dept_manager',
              'data-parsley-required' => 'true'
              );

            echo form_label('ชื่อแผนก')
                .form_input($dept_name);
            echo form_label('ผู้จัดการ')
                .form_input($dept_manager);
          }
        ?>
      </div>
    </div>

  </div>
</div>