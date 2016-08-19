<?php
  if(!isset($data)){
    echo form_open('/HR/Holiday/add');
  }else{
    echo form_open('/HR/Holiday/edit/'.$data[0]->id);
  }
/*

'hol_date' => วันที่หยุด,
'hol_name' => ชื่อวันหยุด,
'hol_remark' => หมายเหตุ

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
          
            $year_opt = array();

            for ($i=0; $i < 50; $i++) { 
              $year = 2015;
              $year_opt[$year+$i] = $year+$i;
            }

          if(isset($data)){
            //Assign Variable

            $hol_date = $data[0]->hol_date;
            $fisyear = $data[0]->fisyear;

            $date_input = array(
                'type' => 'text',
                'name' => 'hol_date',
                'class' => 'datepicker',
                'value' => $hol_date
              );

            echo form_label('วันที่หยุด')
                .form_input($date_input);
            echo form_label('งวดปีหยุด')
                .form_dropdown('fisyear',$year_opt,$fisyear);
          }else{
            $date_input = array(
                'type' => 'text',
                'name' => 'hol_date',
                'class' => 'datepicker'
              );

            echo form_label('วันที่หยุด')
                .form_input($date_input);
            echo form_label('งวดปีหยุด')
                .form_dropdown('fisyear',$year_opt);
          }
        ?>

      </div>

      <div class="large-6 columns">
        <?php
          
          if(isset($data)){
            //Assign Variable

            $hol_name = $data[0]->hol_name;

            echo form_label('ชื่อวันหยุด')
                .form_input('hol_name',$hol_name);
          }else{
            echo form_label('ชื่อวันหยุด')
                .form_input('hol_name');
          }
        ?>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
        <?php
          
          if(isset($data)){
            //Assign Variable

            $hol_remark = $data[0]->hol_remark;

            echo form_label('หมายเหตุ')
                .form_textarea('hol_remark',$hol_remark);
          }else{
            echo form_label('หมายเหตุ')
                .form_textarea('hol_remark');
          }
        ?>
      </div>
    </div>

  </div>
</div>