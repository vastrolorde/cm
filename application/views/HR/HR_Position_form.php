<?php
  if(!isset($data)){
    echo form_open('/HR/Position/add');
  }else{
    echo form_open('/HR/Position/edit/'.$data[0]->id);
  }
/*

            id => รหัสตำแหน่ง
            position_name => ชื่อตำแหน่ง
            dept_id => แผนก
            position_manager => ผู้บังคับบัญชา

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
       

            $i = 0;
            foreach ($dept as $key) {
              $dept_list[$dept[$i]['id']] = $dept[$i]['dept_name'];
              $i++;
            }

          if(isset($data)){
            //Assign Variable

            $id = $data[0]->id;
            $dept_id = $data[0]->dept_id;

            echo form_label('รหัสตำแหน่ง')
                .form_input('id',$id,'readonly');
            echo form_label('แผนก')
                .form_error('dept_id')
                .form_dropdown('dept_id',$dept_list,$dept_id);
          }else{
            echo form_label('รหัสตำแหน่ง')
                .form_input('id');
            echo form_label('แผนก')
                .form_error('dept_id')
                .form_dropdown('dept_id',$dept_list);
          }
        ?>

      </div>

      <div class="large-6 columns">
        <?php
          
          if(isset($data)){
            //Assign Variable

            $position_name = $data[0]->position_name;
            $position_manager = $data[0]->position_manager;

            echo form_label('ชื่อตำแหน่ง')
                .form_input('position_name',$position_name);
            echo form_label('ผู้บังคับบัญชา')
                .form_error('position_manager')
                .form_input('position_manager',$position_manager);
          }else{
            echo form_label('ชื่อตำแหน่ง')
                .form_input('position_name');
            echo form_label('ผู้บังคับบัญชา')
                .form_error('position_manager')
                .form_input('position_manager');
          }
        ?>
      </div>
    </div>

  </div>
</div>