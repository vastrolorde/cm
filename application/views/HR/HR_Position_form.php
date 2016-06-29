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
            active => active
            job_grade => job_grade
            job_group => job_group
            position_jd => position_jd
            position_purpose => position_purpose

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
            $position_name = $data[0]->position_name;
            $dept_id = $data[0]->dept_id;
            $active = $data[0]->active;

            echo '<p><big>รหัสตำแหน่ง : </big><u>'.$id.'</u> <big>ชื่อตำแหน่ง : </big><u>'.$position_name.'</u></p>'
                .'สถานะตำแหน่ง : '.form_checkbox('active','Y',$active).form_label('active');
          }else{
            echo form_label('รหัสตำแหน่ง')
                .form_input('id')
                .'สถานะตำแหน่ง: '.form_checkbox('active','Y').form_label('active');
          }
        ?>

      </div>

      <div class="large-6 columns">
        <?php

          if(!isset($data)){
            echo form_label('ชื่อตำแหน่ง')
                .form_input('position_name');
            }
        ?>
      </div>
    </div>

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
            $dept_id = $data[0]->dept_id;
            $job_group = $data[0]->job_group;

            echo form_label('แผนก')
                .form_error('dept_id')
                .form_dropdown('dept_id',$dept_list,$dept_id);
            echo form_label('Job Group')
                .form_error('job_group')
                .form_input('job_group',$job_group);

          }else{
            echo form_label('แผนก')
                .form_error('dept_id')
                .form_dropdown('dept_id',$dept_list);
            echo form_label('Job Grade')
                .form_error('job_group')
                .form_input('job_group',$job_group);
          }
        ?>
      </div>
      <div class="large-6 columns">
        <?php
          
          if(isset($data)){
            //Assign Variable

            
            $position_manager = $data[0]->position_manager;
            $job_grade = $data[0]->job_grade;

            echo form_label('ผู้บังคับบัญชา')
                .form_error('position_manager')
                .form_input('position_manager',$position_manager);
            echo form_label('Job Grade')
                .form_error('job_grade')
                .form_input('job_grade',$job_grade);
          }else{
            echo form_label('ผู้บังคับบัญชา')
                .form_error('position_manager')
                .form_input('position_manager');
            echo form_label('Job Grade')
                .form_error('job_grade')
                .form_input('job_grade',$job_grade);

          }
        ?>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
        <?php
          
          if(isset($data)){
            //Assign Variable

            
            $position_purpose = $data[0]->position_purpose;

            echo form_label('วัตถุประสงค์ของตำแหน่ง')
                .form_error('position_purpose')
                .form_textarea('position_purpose',$position_purpose);
          }else{
            echo form_label('วัตถุประสงค์ของตำแหน่ง')
                .form_error('position_purpose')
                .form_textarea('position_purpose');

          }
        ?>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">

      <div class="row">
        <div class="large-11 columns">
            <input type="text" id="position_jd">
        </div>
        <div class="large-1 columns">
            <a href="#" id="addJDRow" class="button">เพิ่ม</a>
        </div>
      </div>

        <table id="job_description">
          <thead>
            <tr>
              <th>ลำดับ</th>
              <th>รายละเอียด</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php
              $i=0;
              
              if(isset($data[0]->position_jd)){

                $a = json_decode($data[0]->position_jd);

                foreach ($a as $row) {
                  $i++;
                  echo '
                    <tr>
                      <td>'.$i.'</td>
                      <td>'.$row.'<input type="hidden" name="position_jd[]" value="'.$row.'"></td>
                      <td><a href="#" class="delJDRow">ลบ</a></td>
                    </tr>
                  ';
                }
              }
            ?>
          </tbody>
        </table>

      </div>
    </div>

  </div>
</div>