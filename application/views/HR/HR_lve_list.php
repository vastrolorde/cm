<!-- เพิ่มการลา -->

<div class="reveal" id="Leave" data-reveal>
  <h1>เพิ่มการลา</h1>
  
  <?php

    echo form_open('HR/Leave/add');

    $emp = array();
    foreach ($empAll as $key) {
      $emp[$key->id] = $key->emp_prefix.' '.$key->emp_fname.' '.$key->emp_lname;
    }

    $options = array(
      'Si' => 'ลาป่วย',
      'Bis' => 'ลากิจ',
      'Vac' => 'ลาพักร้อน',
      'TR' => 'ลาฝึกอบรม'
    );

    echo '<div class="row">
      <div class="large-12 columns">'.
        form_label('รหัสพนักงาน').form_dropdown('emp_id',$emp).
        form_label('วันที่ลา').form_input('lve_date','','class=datepicker').
        form_label('ประเภทการลา').form_dropdown('lve_type',$options).
        form_label('สาเหตุการลา').form_input('lve_reason').
      '</div>
    </div>';

    echo '<div class="row">
      <div class="large-6 columns">'.
        form_label('เริ่มเวลา').form_input('lve_in','','id="d1" class="time" placeholder="00:00"').
      '</div>
      <div class="large-6 columns">'.
          form_label('สิ้นสุดเวลา').form_input('lve_out','','id="d2" class="time" placeholder="00:00"').
      '</div>
    </div>';

    echo '<div class="row">
      <div class="large-12 columns">'.
        form_label('จำนวนวัน').form_input('lve_diff','','id="d_diff" readonly').
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
<!-- เพิ่มการลา -->


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
          <li>
            <?php echo $execute; ?>
          </li>
        </ul>
      </div>
    </div>

<!-- Calendar -->
    <div id="calendar"></div>

<table id="leave datatable">

  <thead>
    <tr>
      <th>รหัสพนักงาน</th>
      <th>ชื่อพนักงาน</th>
      <th style="color: #ff5050;">ลาป่วย (30)</th>
      <th style="color: #3399ff">ลากิจ (6)</th>
      <th style="color: orange">ลาพักร้อน (10)</th>
      <th style="color: #66ff99">ลาอบรม (30)</th>
      <th>actions</th>
    </tr>
  </thead>

  <tbody>
  
  <?php

  //แก้ไข Array ให้มี Key เดียวกันก่อน
    $Lve_array = array();

    foreach ($Lve as $key){
      $id = $key['emp_id'];
      $fname = $key['emp_fname'];
      $lname = $key['emp_lname'];
      $type = $key['lve_type'];
      $diff = $key['lve_diff'];

      $Lve_array[$id][$type] = $diff;
      $Lve_array[$id]['name'] = $fname.' '.$lname;
    }

    foreach ($Lve_array as $key => $value){
      echo '<tr>
        <td>'.$key.'</td>
        <td>'.$value['name'].'</td>
        <td>'.(isset($value["Si"])? $value["Si"] : '') .'</td>
        <td>'.(isset($value["Bis"])? $value["Bis"] : '') .'</td>
        <td>'.(isset($value["Vac"])? $value["Vac"] : '') .'</td>
        <td>'.(isset($value["TR"])? $value["TR"] : '') .'</td>
        <td><a href="'.site_url()."/HR/Leave/data/".$key.'">Link</a></td>
      </tr>';
    }

  ?>
  </tbody>
</table>

</div>



  </div>
</div>
