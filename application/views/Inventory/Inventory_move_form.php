<?php
  if(!isset($data)){
    echo form_open('/Inventory/Inventory/add');
  }else{
    echo form_open('/Inventory/Inventory/edit/'.$data[0]->id);
  }


/*

partner_id => ลูกค้า
id  =>  เลขที่เอกสาร
invent_move_createDate  =>  วันที่เอกสาร
invent_move_Date  =>  วันที่ลูกค้ามารับของ
invent_move_type  =>  ชนิดรายการ
invent_move_status  =>  สถานะรายการ
invent_move_wh => โกดัง

product_id => รายการสินค้า
amount => จำนวน

*/

?>

<div class="row">
  <div class="large-12 medium-12 small-12 column">

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
<!-- Start Form -->

    <div class="row">
      <div class="large-6 medium-6 small-6 columns">
        <fieldset class="fieldset">

        <legend>ที่อยู่ในการรับส่งสินค้า</legend>

        <?php
          $i = 0;
          foreach ($partner as $key) {
            $partner_list[$partner[$i]['id']] = $partner[$i]['partner_name'];
            $i++;
          }

          $partner_id = $data[0]->partner_id;

          echo form_label('ลูกค้า')
              .form_dropdown('partner_id',$partner_list,$partner_id,'id="partner_id"');


        ?>

        <!-- ที่อยู่ในการรับส่งสินค้า -->
          <?php

            $i = 0;
            foreach ($warehouse as $key) {
              $warehouse_list[$warehouse[$i]['id']] = $warehouse[$i]['wh_name'];
              $i++;
            }

            $label_attr = array(
                'class' => 'warehouse'
              );

            echo form_label('โกดัง','invent_move_wh',$label_attr)
                .form_dropdown('invent_move_wh',$warehouse_list,'','id="warehouse"');

          ?>

        </fieldset>
      </div>

        <!-- ข้อมูลเอกสาร -->

      <div class="large-6 medium-6 small-6 columns text-right">
        <fieldset class="fieldset">
          <legend>ข้อมูลเอกสาร</legend>

            <?php
              $id                     = $data[0]->id;
              $invent_move_createDate = $data[0]->invent_move_createDate;
              $invent_move_type       = $data[0]->invent_move_type;
            ?>

          <div class="row">
            <div class="large-6 medium-6 small-6 columns">
              <label class="middle"><b>id:</b></label>
            </div>
            <div class="large-6 medium-6 small-6 columns">
              <?php
                echo form_input('id',$id,'id="id" readonly');
              ?>
            </div>
          </div>

          <div class="row">
            <div class="large-6 medium-6 small-6 columns">
              <label class="middle"><b>วันที่เอกสาร:</b></label>
            </div>
            <div class="large-6 medium-6 small-6 columns">
              <?php
                echo form_input('invent_move_createDate',$invent_move_createDate,'readonly');
              ?>
            </div>
          </div>

          <div class="row">
            <div class="large-6 medium-6 small-6 columns">
              <label class="middle"><b>ชนิดรายการ:</b></label>

            </div>
            <div class="large-6 medium-6 small-6 columns">
              <?php
                $id                     = $data[0]->id;
                $invent_move_createDate = $data[0]->invent_move_createDate;
                $invent_move_type       = $data[0]->invent_move_type;


                if($invent_move_type == 'recieve'){
                  echo form_input('invent_move_type','รับสินค้า','readonly');
                }elseif($invent_move_type == 'deliver'){
                  echo form_input('invent_move_type','ส่งสินค้า','readonly');
                }
              ?>
            </div>
          </div>

          <div class="row">
            <div class="large-6 medium-6 small-6 columns">
              <label class="middle"><b>สถานะรายการ:</b></label>
            </div>
            <div class="large-6 medium-6 small-6 columns">
              <?php
                $tr_status = array(
                  'draft' => 'ร่างเอกสาร',
                  'process' => 'กำลังเตรียมการ',
                  'done' => 'ดำเนินการแล้ว',
                  'cancel' =>'ยกเลิก'
                  );

                $status = $data[0]->invent_move_status;

                echo form_dropdown('invent_move_status',$tr_status,$status);
              ?>
            </div>
          </div>

        </fieldset>
      </div>
    </div>

        <!-- Table -->

        <div class="row">
          <div class="large-12 medium-12 small-12 columns">

          <?php
            form_open();
          ?>
            <div class="row">
              <div class="large-6 medium-6 small-6 columns">
                <?php

                  $option = array();

                  $i = 0;
                  foreach($product as $row){
                    $option[$row['product_id']] = '('.$row['product_id'].') : '.$row['product_name'];
                    $i++;
                  }

                  echo form_dropdown('product_id',$option,'','id="product_id"');
                ?>
              </div>
              <div class="large-4 medium-4 small-4 columns">
                <?php
                  echo form_input('product_amount','','id="product_amount" placeholder="จำนวน"')
                ?>
              </div>

              <div class="large-2 medium-2 small-2 columns">
                <a class="button" id="AddtransactionRow">เพิ่ม</a>
              </div>
            </div>

          <?php
            form_close();
          ?>
            </div>
          </div>
            <table id="transaction">
            </table>
          </div>
        </div>

        <!-- End Table -->

<!-- End Form -->

  </div>
</div>