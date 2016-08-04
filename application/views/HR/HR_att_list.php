<!-- Add Form -->

<div class="reveal" id="Att" data-reveal>

  <h3>เพิ่มรายการใหม่</h3>
  <?php
    echo form_open('/HR/Attendance/add');

    $emp = array();
    foreach ($emp as $key) {
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

  ?>

  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<!-- Add Form -->

<!-- Import Form -->

<div class="reveal" id="Att_file" data-reveal>

  <h3>นำเข้าบันทึกลงเวลา</h3>

  <?php
    echo form_open_multipart('/HR/Attendance/upload');
  ?>
  <label>กรุณาเลือกไฟล์บันทึกเวลา <span style="color:red;">(ต้องเป็นไฟล์นามสกุล csv เท่านั้น)</span>
    <input type="file" name="att_csv">
  </label>
  <input type="submit" class="button">

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
