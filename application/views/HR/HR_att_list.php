<!-- Add Form -->

<div class="reveal" id="Att" data-reveal>

  <h3>เพิ่มรายการใหม่</h3>
  <?php
    echo form_open('/HR/Attendance/add');

    $emp = array();
    foreach ($empAll as $key) {
      $emp[$key->id] = $key->emp_prefix.' '.$key->emp_fname.' '.$key->emp_lname;
    }


    echo '<div class="row">
      <div class="large-12 columns">'.
        form_label('รหัสพนักงาน').form_dropdown('emp_id',$emp).
        form_label('วันที่ทำงาน').form_input('att_date','','class=datepicker').
      '</div>
    </div>';

    echo '<div class="row">
      <div class="large-6 columns">'.
        form_label('เริ่มเวลา').form_input('pnch_in','','id="pnch_in" class="time" placeholder="00:00"').
      '</div>
      <div class="large-6 columns">'.
          form_label('สิ้นสุดเวลา').form_input('pnch_out','','id="pnch_out" class="time" placeholder="00:00"').
      '</div>
    </div>';

    echo '<div class="row">
      <div class="large-12 columns">'.
        form_label('จำนวนวัน').form_input('pnch_diff','','id="diff" readonly').
      '</div>
    </div>';

    echo '<div class="row">
      <div class="large-12 columns text-right">
        <input type="submit" class="button">
      </div>
    </div>';

    echo form_close();
  ?>

  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<!-- Add Form -->

<!-- Import Form -->

<div class="reveal" id="Att_file" data-reveal>

  <h3>นำเข้าบันทึกลงเวลา</h3>

  <h4>ขั้นตอนการนำเข้าข้อมูล</h4>

  <ol>
    <li>ดาวน์โหลด <a href="<?php echo site_url().'/HR/Attendance/example' ?>">ไฟล์Excelตัวอย่าง</a></li>
    <li>กรอกข้อมูลในช่อง id date start end remark</li>
    <li>ช่อง convert ไฟล์จะทำการคำนวณให้เอง ไม่ต้องกรอก</li>
    <li>ตรวจสอบข้อมูลให้ถูกต้อง
      <ol>
        <li>ตรวจสอบการกรอกเวลาว่าถูกต้องหรือไม่</li>
        <li>วันที่ต้องเป็น Format "dd/mm/yyyy" ปีเป็น ค.ศ. เช่น 14/08/2016 หรือ 01/10/2016</li>
      </ol>
    </li>
    <li>ทำการบันทึกเป็น csv โดย
      <ol>
        <li>File>Save as</li>
        <li>เลือกdirectory ที่ต้องการ save</li>
        <li>ตั้งชื่อไฟล์ **แนะนำให้ระบุช่วงเวลาของการดึงข้อมูลบันทึกเวลาไว้เป็นชื่อไฟล์ด้วย เช่น ระบุเป็น TA 25 Jan - 25 Feb16 เป็นต้น**</li>
        <li>เปลี่ยน Save As Type: เป็น CSV (Comma Delimited) (*.csv)</li>
      </ol>
    </li>
    <li>กด Save</li>
  </ol>

  <?php
    echo form_open_multipart('/HR/Attendance/upload');

    echo'
  <label>กรุณาเลือกไฟล์บันทึกเวลา <span style="color:red;">(ต้องเป็นไฟล์นามสกุล csv เท่านั้น)</span><br />
    <input type="file" name="att_csv">
  </label>
  <input type="submit" class="button">';
    
    echo form_close();

  ?>

  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<!-- Import Form -->


<div class="row">
  <div class="large-12 columns">

<div class="top-bar sub-top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><?php echo $title;?></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <li><a class="hollow button success" data-open="Att">เพิ่ม</a></li>
      <li><a class="hollow button" data-open="Att_file">นำเข้า</a></li>
      <li><a class="hollow button" href="#">พิมพ์</a></li>
    </ul>
  </div>
</div>

<table id="datatable">

  <thead>
    <tr>
      <th>รหัสพนักงาน</th>
      <th>ชื่อพนักงาน</th>
      <th>วันที่</th>
      <th>เข้า</th>
      <th>ออก</th>
      <th>ระยะเวลา(hr)</th>
      <th>หมายเหตุ</th>
      <th>actions</th>
    </tr>
  </thead>

  <tbody>
  
  <?php
    
    if($result != null){
      foreach ($result as $key){

        echo '
          <tr>
            <td>'.$key->emp_id.'</td>
            <td>'.$key->emp_fname.'  '.$key->emp_lname.'</td>
            <td>'.$key->att_date.'</td>
            <td>'.$key->pnch_in.'</td>
            <td>'.$key->pnch_out.'</td>
            <td>'.$key->pnch_diff.'</td>
            <td>'.$key->remark.'</td>
            <td><a href="'.site_url("HR/Dept/data/".$key->id).'">Edit</a></td>
          </tr>
            ';
      }
    }else{
      echo '
        <tr>
          <td colspan="7"> No Data </td>
        </tr>
      ';
    }

  ?>
  </tbody>
</table>

  </div>
</div>
