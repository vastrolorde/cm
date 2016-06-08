<?php
  if(!isset($data)){
    echo form_open('/HR/Employee/add');
  }else{
    echo form_open('/HR/Employee/edit/'.$data[0]->id);
  }
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

<!-- Tab -->

    <ul class="tabs" data-tabs id="employee-tabs">
      <li class="tabs-title is-active"><a href="#info" aria-selected="true">Info</a></li>
      <li class="tabs-title"><a href="#contact">Contact</a></li>
      <li class="tabs-title"><a href="#Positions">Positions</a></li>
      <li class="tabs-title"><a href="#Auth_Card">Auth. Card</a></li>
      <li class="tabs-title"><a href="#Training">Training</a></li>
      <li class="tabs-title"><a href="#Education">Education</a></li>
      <li class="tabs-title"><a href="#Working_Experiences">Working Experiences</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="employee-tabs">

      <div class="tabs-panel is-active" id="info">
        <h4>ข้อมูลทั่วไป</h4>
        <div class="row">
          <div class="large-12 columns">
            <h5>ข้อมูลส่วนตัว</h5>

              <?php

                if(isset($data)){
                //Assign Variable
                  $id = $data[0]->id;

                  echo form_label('รหัสพนักงาน *').form_input('id',$id,'disabled').form_hidden('id',$id);
                }else{
                  echo form_label('รหัสพนักงาน *').form_input('id');
                }
                ?>
          </div>
        </div>

        <div class="row">
          <?php
              $prefixoptions = array(
                  'นาย' => 'นาย',
                  'น.ส.' => 'น.ส.',
                  'นาง' => 'นาง',
                );

            if(isset($data)){
              //Assign Variable
              $emp_prefix = $data[0]->emp_prefix;
              $emp_fname  = $data[0]->emp_fname;
              $emp_lname  = $data[0]->emp_lname;

              echo '<div class="large-2 columns">'
                .form_label('คำนำหน้าชื่อ *')
                .form_dropdown('emp_prefix',$prefixoptions,$emp_prefix)
                .'</div>';
              echo '<div class="large-3 columns">'
                .form_label('ชื่อ *')
                .form_input('emp_fname',$emp_fname)
                .'</div>';
              echo '<div class="large-7 columns">'
                .form_label('นามสกุล *')
                .form_input('emp_lname',$emp_lname)
                .'</div>';
            }else{
              echo '<div class="large-2 columns">'
                .form_label('คำนำหน้าชื่อ *')
                .form_dropdown('emp_prefix',$prefixoptions)
                .'</div>';
              echo '<div class="large-3 columns">'
                .form_label('ชื่อ *')
                .form_input('emp_fname')
                .'</div>';
              echo '<div class="large-7 columns">'
                .form_label('นามสกุล *')
                .form_input('emp_lname')
                .'</div>';
            }
          ?>
        </div>

        <div class="row">
          <div class="large-6 columns">
            <?php
              
              if(isset($data)){
                //Assign Variable
                $emp_nickname = $data[0]->emp_nickname;
                $emp_nation = $data[0]->emp_nation;

                echo form_label('ชื่อเล่น').form_input('emp_nickname',$emp_nickname);
                echo form_label('สัญชาติ').form_input('emp_nation',$emp_nation);
              }else{
                echo form_label('ชื่อเล่น').form_input('emp_nickname');
                echo form_label('สัญชาติ').form_input('emp_nation');
              }
            ?>

          </div>
          <div class="large-6 columns">
            <?php
              
              if(isset($data)){
                //Assign Variable
                $emp_sex = $data[0]->emp_sex;
                $emp_DOB = $data[0]->emp_DOB;

                echo form_label('เพศสภาพ').form_input('emp_sex',$emp_sex);
                echo form_label('วันเดือนปี เกิด').form_input('emp_DOB',$emp_DOB);
              }else{
                echo form_label('เพศสภาพ').form_input('emp_sex');
                echo form_label('วันเดือนปี เกิด').form_input('emp_DOB');
              }
            ?>

          </div>
        </div>

        <hr />
        <h5>รายละเอียดสัญญา</h5>
        <div class="row">
          <div class="large-6 columns">

            <?php

                $emp_status_list = array(
                    'ทดลองงาน' => 'ทดลองงาน', 
                    'บรรจุแล้ว' => 'บรรจุแล้ว', 
                    'ลาออก' => 'ลาออก', 
                    'ไล่ออก' => 'ไล่ออก'
                  );
              
              if(isset($data)){
                //Assign Variable

                $emp_startdate = $data[0]->emp_startdate;
                $emp_enddate = $data[0]->emp_enddate;
                $emp_status = $data[0]->emp_status;


                echo form_label('วันเริ่มทำงาน *').form_input('emp_startdate',$emp_startdate);
                echo form_label('วันสิ้นสุดการทำงาน *').form_input('emp_enddate',$emp_enddate);
                echo form_label('สถานะ').form_dropdown('emp_status',$emp_status_list,$emp_status);
              }else{
                echo form_label('วันเริ่มทำงาน *').form_input('emp_startdate');
                echo form_label('วันสิ้นสุดการทำงาน *').form_input('emp_enddate');
                echo form_label('สถานะ *').form_dropdown('emp_status',$emp_status_list);
              }
            ?>
          </div>
          <div class="large-6 columns">

            <?php

                $emp_type_list = array(
                    'พนักงานรายวัน' => 'พนักงานรายวัน',
                    'พนักงานรายเดือน' => 'พนักงานรายเดือน',
                    'พนักงานชั่วคราวรายวัน' => 'พนักงานชั่วคราวรายวัน',
                    'พนักงานชั่วคราวรายเดือน' => 'พนักงานชั่วคราวรายเดือน',
                    'พนักงานฝึกงาน' => 'พนักงานฝึกงาน'
                  );
              
              if(isset($data)){
                //Assign Variable

                $emp_position_now = $data[0]->emp_position_now;
                $emp_dept_now = $data[0]->emp_dept_now;
                $emp_type = $data[0]->emp_type;


                echo form_label('ตำแหน่งปัจจุบัน').form_input('emp_position_now',$emp_position_now);
                echo form_label('แผนกปัจจุบัน').form_input('emp_dept_now',$emp_dept_now);
                echo form_label('ประเภทพนักงาน').form_dropdown('emp_type',$emp_type_list,$emp_type);
              }else{
                echo form_label('ตำแหน่งปัจจุบัน').form_input('emp_position_now');
                echo form_label('แผนกปัจจุบัน').form_input('emp_dept_now');
                echo form_label('ประเภทพนักงาน').form_dropdown('emp_type',$emp_type_list);
              }
            ?>
          </div>
        </div>

      </div>

      <div class="tabs-panel" id="contact">
        <h4>Contact</h4>
        <div class="row">
          <div class="large-12 columns">
            <hr />
            <h5>ที่อยู่</h5>

            <div class="row">
              <div class="large-6 columns">

                <?php
                  
                  if(isset($data)){
                    //Assign Variable
                    $emp_add1 = $data[0]->emp_add1;
                    $emp_SubDist = $data[0]->emp_SubDist;
                    $emp_Province = $data[0]->emp_Province;


                    echo form_label('ที่อยู่ *').form_input('emp_add1',$emp_add1);
                    echo form_label('แขวง/ตำบล *').form_input('emp_SubDist',$emp_SubDist);
                    echo form_label('จังหวัด *').form_input('emp_Province',$emp_Province);
                  }else{
                    echo form_label('ที่อยู่ *').form_input('emp_add1');
                    echo form_label('แขวง/ตำบล *').form_input('emp_SubDist');
                    echo form_label('จังหวัด *').form_input('emp_Province');
                  }
                ?>
              </div>
              <div class="large-6 columns">

                <?php
                  
                  if(isset($data)){
                    //Assign Variable
                    $emp_add2 = $data[0]->emp_add2;
                    $emp_Dist = $data[0]->emp_Dist;
                    $emp_Postal = $data[0]->emp_Postal;


                    echo form_label('ที่อยู่2 *').form_input('emp_add2',$emp_add2);
                    echo form_label('เขต/อำเภอ *').form_input('emp_Dist',$emp_Dist);
                    echo form_label('รหัสไปรษณีย์ *').form_input('emp_Postal',$emp_Postal);
                  }else{
                    echo form_label('ที่อยู่2 *').form_input('emp_add2');
                    echo form_label('เขต/อำเภอ *').form_input('emp_Dist');
                    echo form_label('รหัสไปรษณีย์ *').form_input('emp_Postal');
                  }
                ?>

              </div>
            </div>
            
            <hr />
            <h5>ข้อมูลในการติดต่อ</h5>
            <div class="row">
              <div class="large-6 columns">

                <?php
                  
                  if(isset($data)){
                    //Assign Variable
                    $emp_tel1 = $data[0]->emp_tel1;
                    $emp_tel2 = $data[0]->emp_tel2;
                    $emp_email = $data[0]->emp_email;


                    echo form_label('เบอร์โทรศัพท์ 1').form_input('emp_tel1',$emp_tel1);
                    echo form_label('เบอร์โทรศัพท์ 2').form_input('emp_tel2',$emp_tel2);
                    echo form_label('e-mail').form_input('emp_email',$emp_email);
                  }else{
                    echo form_label('เบอร์โทรศัพท์ 1').form_input('emp_tel1');
                    echo form_label('เบอร์โทรศัพท์ 2').form_input('emp_tel2');
                    echo form_label('e-mail').form_input('emp_email');
                  }
                ?>
              </div>
              <div class="large-6 columns">

                <?php
                  
                  if(isset($data)){
                    //Assign Variable
                    $emp_emergency = $data[0]->emp_emergency;
                    $emp_emer_call = $data[0]->emp_emer_call;


                    echo form_label('บุคคลติดต่อฉุกเฉิน').form_input('emp_emergency',$emp_emergency);
                    echo form_label('เบอร์โทรศัพท์ติดต่อฉุกเฉิน').form_input('emp_emer_call',$emp_emer_call);
                  }else{
                    echo form_label('บุคคลติดต่อฉุกเฉิน').form_input('emp_emergency');
                    echo form_label('เบอร์โทรศัพท์ติดต่อฉุกเฉิน').form_input('emp_emer_call');
                  }
                ?>
              </div>
            </div>

          </div>
        </div>

      </div>

      <div class="tabs-panel" id="Positions">

        <h4>ประวัติการเลื่อนตำแหน่ง</h4>
        <hr />
        <a href="#" id="Add_position_row" class="button">Add row</a>

        <table id="positions">
          <thead>
            <tr>
              <th>#</th>
              <th>ตำแหน่ง</th>
              <th>วันที่ดำรงตำแหน่ง</th>
              <th>แผนก</th>
              <th>เงินเดือน</th>
              <th>หมายเหตุ</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            <?php
              $i=0;
              
              if(isset($data[0]->emp_position)){
                
                $a = json_decode($data[0]->emp_position);

                foreach ($a as $row) {
                  $i++;
                  echo '
                    <tr>
                      <td>'.$i.'</td>
                      <td><input type="text" name="emp_position['.$i.'][position]" value="'.$row->position.'" placeholder="กรอก ตำแหน่ง"></td>
                      <td><input type="text" name="emp_position['.$i.'][date]" value="'.$row->date.'" placeholder="กรอก วันที่"></td>
                      <td><input type="text" name="emp_position['.$i.'][dept]" value="'.$row->dept.'" placeholder="กรอก แผนก"></td>
                      <td><input type="text" name="emp_position['.$i.'][salary]" value="'.$row->salary.'" placeholder="กรอก เงินเดือน"></td>
                      <td><input type="text" name="emp_position['.$i.'][remark]" value="'.$row->remark.'" placeholder="กรอก หมายเหตุ"></td>
                      <td><a href="#" class="Del_position_row">ลบ</a></td>
                    </tr>
                  ';
                }
              }else{
                $i++;
                echo '
                  <tr>
                    <td>'.$i.'</td>
                    <td><input type="text" name="emp_position['.$i.'][position]" placeholder="กรอก ตำแหน่ง"></td>
                    <td><input type="text" name="emp_position['.$i.'][date]" placeholder="กรอก วันที่"></td>
                    <td><input type="text" name="emp_position['.$i.'][dept]" placeholder="กรอก แผนก"></td>
                    <td><input type="text" name="emp_position['.$i.'][salary]" placeholder="กรอก เงินเดือน"></td>
                    <td><input type="text" name="emp_position['.$i.'][remark]" placeholder="กรอก หมายเหตุ"></td>
                    <td><a href="#" class="Del_position_row">ลบ</a></td>
                  </tr>
                ';
              }
            ?>

          </tbody>
        </table>

      </div>

      <div class="tabs-panel" id="Auth_Card">

        <h4>บัตรประจำตัว</h4>
        <div class="row">
          <div class="large-6 columns">
            <h5>บัตรประจำตัวประชาชน</h5>
            <?php
              
              if(isset($data)){
                //Assign Variable
                $emp_cid = $data[0]->emp_cid;
                $emp_cid_exp = $data[0]->emp_cid_exp;

                echo form_label('เลขที่').form_input('emp_cid',$emp_cid);
                echo form_label('วันหมดอายุ').form_input('emp_cid_exp',$emp_cid_exp);
              }else{
                echo form_label('เลขที่').form_input('emp_cid');
                echo form_label('วันหมดอายุ').form_input('emp_cid_exp');
              }
            ?>
          </div>

          <div class="large-6 columns">
            <h5>หนังสือเดืนทาง Passport</h5>
            <?php
              
              if(isset($data)){
                //Assign Variable
                $emp_passport = $data[0]->emp_passport;
                $emp_passport_exp = $data[0]->emp_passport_exp;

                echo form_label('เลขที่').form_input('emp_passport',$emp_passport);
                echo form_label('วันหมดอายุ').form_input('emp_passport_exp',$emp_passport_exp);
              }else{
                echo form_label('เลขที่').form_input('emp_passport');
                echo form_label('วันหมดอายุ').form_input('emp_passport_exp');
              }
            ?>
          </div>
        </div>

        <div class="row">
          <div class="large-6 columns">
            <h5>Visa</h5>
            <?php
              
              if(isset($data)){
                //Assign Variable
                $emp_visa = $data[0]->emp_visa;
                $emp_visa_exp = $data[0]->emp_visa_exp;

                echo form_label('เลขที่').form_input('emp_visa',$emp_visa);
                echo form_label('วันหมดอายุ').form_input('emp_visa_exp',$emp_visa_exp);
              }else{
                echo form_label('เลขที่').form_input('emp_visa');
                echo form_label('วันหมดอายุ').form_input('emp_visa_exp');
              }
            ?>
          </div>

          <div class="large-6 columns">
            <h5>Work Permit</h5>
            <?php
              
              if(isset($data)){
                //Assign Variable
                $emp_wp = $data[0]->emp_wp;
                $emp_wp_exp = $data[0]->emp_wp_exp;

                echo form_label('เลขที่').form_input('emp_wp',$emp_wp);
                echo form_label('วันหมดอายุ').form_input('emp_wp_exp',$emp_wp_exp);
              }else{
                echo form_label('เลขที่').form_input('emp_wp');
                echo form_label('วันหมดอายุ').form_input('emp_wp_exp');
              }
            ?>
          </div>
        </div>

        <div class="row">
          <div class="large-6 columns">
            <h5>ใบขับขี่รถยนต์</h5>
            <?php
              
              if(isset($data)){
                //Assign Variable
                $emp_driver_license = $data[0]->emp_driver_license;
                $emp_driver_license_exp = $data[0]->emp_driver_license_exp;

                echo form_label('เลขที่').form_input('emp_driver_license',$emp_driver_license);
                echo form_label('วันหมดอายุ').form_input('emp_driver_license_exp',$emp_driver_license_exp);
              }else{
                echo form_label('เลขที่').form_input('emp_driver_license');
                echo form_label('วันหมดอายุ').form_input('emp_driver_license_exp');
              }
            ?>
          </div>

          <div class="large-6 columns">
            <h5>ใบขับขี่รถจักรยานยนต์</h5>
            <?php
              
              if(isset($data)){
                //Assign Variable
                $emp_bike_license = $data[0]->emp_bike_license;
                $emp_bike_license_exp = $data[0]->emp_bike_license_exp;

                echo form_label('เลขที่').form_input('emp_bike_license',$emp_bike_license);
                echo form_label('วันหมดอายุ').form_input('emp_bike_license_exp',$emp_bike_license_exp);
              }else{
                echo form_label('เลขที่').form_input('emp_bike_license');
                echo form_label('วันหมดอายุ').form_input('emp_bike_license_exp');
              }
            ?>
          </div>
        </div>

        <div class="row">
          <div class="large-6 columns">
            <h5>ใบขับขี่รถยนต์บรรทุก</h5>
            <?php
              
              if(isset($data)){
                //Assign Variable
                $emp_truck_license = $data[0]->emp_truck_license;
                $emp_truck_license_exp = $data[0]->emp_truck_license_exp;

                echo form_label('เลขที่').form_input('emp_truck_license',$emp_truck_license);
                echo form_label('วันหมดอายุ').form_input('emp_truck_license_exp',$emp_truck_license_exp);
              }else{
                echo form_label('เลขที่').form_input('emp_truck_license');
                echo form_label('วันหมดอายุ').form_input('emp_truck_license_exp');
              }
            ?>
          </div>
        </div>

      </div>

      <div class="tabs-panel" id="Training">

        <h4>ประวัติฝึกอบรม</h4>
        <hr />
        <a href="#" id="Add_training_row" class="button">Add row</a>

        <table id="training">
          <thead>
            <tr>
              <th>#</th>
              <th>หลักสูตร</th>
              <th>วันที่อบรม</th>
              <th>สถาบันอบรม</th>
              <th>Cert. ID</th>
              <th>หมายเหตุ</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i=0;
              
              if(isset($data[0]->emp_training)){

                $a = json_decode($data[0]->emp_training);

                foreach ($a as $row) {
                  $i++;
                  echo '
                    <tr>
                      <td>'.$i.'</td>
                      <td><input type="text" name="emp_training['.$i.'][subject]" value="'.$row->subject.'" placeholder="กรอก หลักสูตร"></td>
                      <td><input type="text" name="emp_training['.$i.'][date]" value="'.$row->date.'" placeholder="กรอก วันที่อบรม"></td>
                      <td><input type="text" name="emp_training['.$i.'][institute]" value="'.$row->institute.'" placeholder="กรอก สถาบันอบรม"></td>
                      <td><input type="text" name="emp_training['.$i.'][cert_no]" value="'.$row->cert_no.'" placeholder="กรอก Cert. ID"></td>
                      <td><input type="text" name="emp_training['.$i.'][remark]" value="'.$row->remark.'" placeholder="กรอก หมายเหตุ"></td>
                      <td><a href="#" class="Del_training_row">ลบ</a></td>
                    </tr>
                  ';
                }
                }else{
                  $i++;
                  echo '
                    <tr>
                      <td>'.$i.'</td>
                      <td><input type="text" name="emp_training['.$i.'][subject]" placeholder="กรอก หลักสูตร"></td>
                      <td><input type="text" name="emp_training['.$i.'][date]" placeholder="กรอก วันที่อบรม"></td>
                      <td><input type="text" name="emp_training['.$i.'][institute]" placeholder="กรอก สถาบันอบรม"></td>
                      <td><input type="text" name="emp_training['.$i.'][cert_no]" placeholder="กรอก Cert. ID"></td>
                      <td><input type="text" name="emp_training['.$i.'][remark]" placeholder="กรอก หมายเหตุ"></td>
                        <td><a href="#" class="Del_training_row">ลบ</a></td>
                    </tr>
                  ';
                }
            ?>

          </tbody>
        </table>

      </div>

      <div class="tabs-panel" id="Education">

        <h4>ประวัติการศึกษา</h4>
        <hr />

      </div>

      <div class="tabs-panel" id="Working_Experiences">

        <h4>ประวัติการทำงาน</h4>
        <hr />

      </div>

    </div>


  </div>
</div>