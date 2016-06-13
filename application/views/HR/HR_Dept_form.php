<?php
  if(!isset($data)){
    echo form_open('/HR/Dept/add');
  }else{
    echo form_open('/HR/Dept/edit/'.$data[0]->id);
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
        <?php
          if(validation_errors()){
            echo '<div class="callout alert">
                    <h5>Error</h5>
                    <p>มีการกรอกข้อมูลผิดพลาด โปรดตรวจสอบ</p>
                  </div>';
          }

        ?>

<!-- Info -->

    <div class="row">
      <div class="large-6 columns">

        <?php
          
          if(isset($data)){
            //Assign Variable

            $id = $data[0]->id;
            $dept_mother = $data[0]->dept_mother;

            echo form_label('รหัสแผนก')
                .form_input('id',$id);
            echo form_label('แผนกแม่')
                .form_error('dept_mother')
                .form_input('dept_mother',$dept_mother);
          }else{
            echo form_label('รหัสแผนก')
                .form_input('id');
            echo form_label('แผนกแม่')
                .form_error('dept_mother')
                .form_input('dept_mother');
          }
        ?>

      </div>

      <div class="large-6 columns">
        <?php
          
          if(isset($data)){
            //Assign Variable

            $dept_name = $data[0]->dept_name;
            $dept_manager = $data[0]->dept_manager;

            echo form_label('ชื่อแผนก')
                .form_input('dept_name',$dept_name);
            echo form_label('ผู้จัดการ')
                .form_error('dept_manager')
                .form_input('dept_manager',$dept_manager);
          }else{
            echo form_label('ชื่อแผนก')
                .form_input('dept_name');
            echo form_label('ผู้จัดการ')
                .form_error('dept_manager')
                .form_input('dept_manager');
          }
        ?>
      </div>
    </div>

  </div>
</div>