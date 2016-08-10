<?php
  $attributes = array(
      'id' => 'validate_form'
    );

  if(!isset($data)){
    echo form_open('/Inventory/Warehouse/add',$attributes);
  }else{
    echo form_open('/Inventory/Warehouse/edit/'.$data[0]->id,$attributes);
  }

/*
id          => รหัสคลังสินค้า
wh_name     => ชื่อคลังสินค้า
wh_add1     => ที่อยู่ 1
wh_subDist  => ตำบล/แขวง
wh_Province => จังหวัด
wh_add2     => ที่อยู่ 2
wh_Dist     => อำเภอ/เขต
wh_Postal   => รหัสไปรษณีย์
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

<!-- Warehouse -->

    <div class="row">
      <h4>คลังสินค้า</h4>

      <div class="large-12 columns">
          <h5>ข้อมูลทั่วไป</h5>

          <?php

            $id = array(
              'type'  =>  'text',
              'name'  =>  'id',
              'value' =>  (isset($data))? $data[0]->id: '',
              'readonly'=>'true'
            );
            $id2 = array(
              'type'  =>  'text',
              'name'  =>  'id',
              'data-parsley-required' => 'true'
            );

            $wh_name = array(
              'type'  =>  'text',
              'name'  =>  'wh_name',
              'value'  =>  (isset($data))? $data[0]->wh_name: '',
              'data-parsley-required' => 'true'
            );

            if(isset($data)){
              echo form_label('รหัสคลังสินค้า *')
                  .form_input($id);
              echo form_label('ชื่อคลังสินค้า *')
                  .form_input($wh_name);
            }else{
              echo form_label('รหัสคลังสินค้า *')
                  .form_input($id2);
              echo form_label('ชื่อคลังสินค้า *')
                  .form_input($wh_name);
            }
            ?>

      </div>
    </div>

    <div class="row">
      <div class="large-6 columns">
          <?php

            if(isset($data)){
            //Assign Variable
              $wh_add1 = $data[0]->wh_add1;
              $wh_subDist = $data[0]->wh_subDist;
              $wh_Province = $data[0]->wh_Province;


              echo form_label('ที่อยู่ 1')
                  .form_input('wh_add1',$wh_add1);
              echo form_label('ตำบล/แขวง')
                  .form_input('wh_subDist',$wh_subDist);
              echo form_label('จังหวัด')
                  .form_input('wh_Province',$wh_Province);
            }else{
              echo form_label('ที่อยู่ 1')
                  .form_input('wh_add1');
              echo form_label('ตำบล/แขวง')
                  .form_input('wh_subDist');
              echo form_label('จังหวัด')
                  .form_input('wh_Province');
            }
            ?>
      </div>
      <div class="large-6 columns">
          <?php

            $wh_Postal = array(
              'type'  =>  'number',
              'name'  =>  'wh_Postal',
              'value' =>  (isset($data))? $data[0]->wh_Postal: '00000'
              );

            if(isset($data)){
            //Assign Variable
              $wh_add2 = $data[0]->wh_add2;
              $wh_Dist = $data[0]->wh_Dist;


              echo form_label('ที่อยู่ 2')
                  .form_input('wh_add2',$wh_add2);
              echo form_label('อำเภอ/เขต')
                  .form_input('wh_Dist',$wh_Dist);
              echo form_label('รหัสไปรษณีย์')
                  .form_input($wh_Postal);
            }else{
              echo form_label('ที่อยู่ 2')
                  .form_input('wh_add2');
              echo form_label('อำเภอ/เขต')
                  .form_input('wh_Dist');
              echo form_label('รหัสไปรษณีย์')
                  .form_input($wh_Postal);
            }
            ?>
      </div>
    </div>


  </div>
</div>