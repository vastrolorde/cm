<!-- เพิ่มการลา -->

<div class="reveal" id="Add" data-reveal>
  <h1>เพิ่มการลา</h1>
  
  <?php

    //Defined ID
    $id = $this->uri->segment(4);

    echo form_open('HR/Leave/add');

    $options = array(
      'Si' => 'ลาป่วย',
      'Bis' => 'ลากิจ',
      'Vac' => 'ลาพักร้อน',
      'TR' => 'ลาฝึกอบรม'
    );

    echo '<div class="row">
      <div class="large-12 columns">'.
        form_label('รหัสพนักงาน').form_input('emp_id',$id,'id="emp_id" readonly').
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
      <div class="large-12 columns">

      <h2>รหัสพนักงาน : <?php

      echo $id;
      ?>
      </h2>
      
      <?php
          $Bis = '';
          $Si = '';
          $Vac = '';
          $TR = '';

        foreach ($data as $key) {

          if($key["lve_type"] == 'Bis'){
            $Bis += $key["lve_diff"];
          }elseif($key["lve_type"] == 'Si'){
            $Si += $key["lve_diff"];
          }elseif($key["lve_type"] == 'Vac'){
            $Vac += $key["lve_diff"];
          }elseif($key["lve_type"] == 'TR'){
            $TR += $key["lve_diff"];
          }
        }
      ?>
      
      <div class="callout primary">
        <h3>สรุปสถิติการลา</h3>
        ลากิจ : <?php echo $Bis; ?> วัน<br />
        ลาป่วย : <?php echo $Si; ?> วัน<br />
        ลาพักร้อน : <?php echo $Vac; ?> วัน<br />
        ลาฝึกอบรม : <?php echo $TR; ?> วัน<br />
      </div>

        <table id="leaveTable">

        </table>

      </div>
    </div>

  </div>
</div>