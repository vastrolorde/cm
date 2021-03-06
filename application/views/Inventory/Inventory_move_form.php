<?php
  if(!isset($data)){
    echo form_open('/Inventory/Inventory/add');
  }else{
    echo form_open('/Inventory/Inventory/edit/'.$data[0]->id);
  }

/*

refdoc_id => รหัสอ้งอิง
id  =>  เลขที่เอกสาร
create_date  =>  วันที่เอกสาร
invent_move_Date  =>  วันที่ลูกค้ามารับของ
invent_move_type  =>  ชนิดรายการ
invent_move_status  =>  สถานะรายการ
invent_move_wh => โกดัง

product_id => รายการสินค้า
amount => จำนวน

*/

// validate
/*
id
refdoc_id
invent_move_Date
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
<!-- Start Form -->

    <div class="row">
      <div class="large-6 medium-6 small-6 columns">
        <fieldset class="fieldset">

        <legend>ที่อยู่ในการรับส่งสินค้า</legend>

        <?php
          $refdoc_id = array(
              'type'  =>  'text',
              'name'  =>  'refdoc_id',
              'value'  =>  $data[0]->refdoc_id,
              'id' =>  'refdoc_id',
              'data-parsley-required' =>  'true'
            );

          echo form_label('รหัสอ้างอิง')
              .form_input($refdoc_id);


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

            if(!isset($data)){
              echo form_label('โกดัง','invent_move_wh',$label_attr)
                  .form_dropdown('invent_move_wh',$warehouse_list,'','id="warehouse"');
              echo form_label('วันที่รับ/ส่งสินค้า')
                  .form_input('invent_move_Date','','class="datepicker"');
            }else{
              $invent_move_wh = $data[0]->invent_move_wh;
            $invent_move_Date = $data[0]->invent_move_Date;

              echo form_label('โกดัง','invent_move_wh',$label_attr)
                  .form_dropdown('invent_move_wh',$warehouse_list,$invent_move_wh,'id="warehouse"');
              echo form_label('วันที่รับ/ส่งสินค้า')
                  .form_input('invent_move_Date',$invent_move_Date,'class="datepicker" id="invent_move_Date"');
            }

          ?>

        </fieldset>
      </div>

        <!-- ข้อมูลเอกสาร -->

      <div class="large-6 medium-6 small-6 columns text-right">
        <fieldset class="fieldset">
          <legend>ข้อมูลเอกสาร</legend>

            <?php
              $id               = $data[0]->id;
              $create_date      = $data[0]->create_date;
              $invent_move_type = $data[0]->invent_move_type;
              $update_date      = $data[0]->update_date;
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
              <label class="middle"><b>อัพเดตครั้งล่าสุด:</b></label>
            </div>
            <div class="large-6 medium-6 small-6 columns">
              <?php
                echo form_input('create_date',$create_date,'readonly');
                echo form_input('update_date_old',$update_date,'readonly');
                echo '<input type="hidden" name="update_date" class="timestamp">';
              ?>
            </div>
          </div>

          <div class="row">
            <div class="large-6 medium-6 small-6 columns">
              <label class="middle"><b>ชนิดรายการ:</b></label>

            </div>
            <div class="large-6 medium-6 small-6 columns">
              <?php
                if(isset($invent_move_type)){
                  echo form_input('invent_move_type',$invent_move_type,'id="invent_move_type" readonly');
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

                switch ($invent_move_type) {
                  case 'recieve':
                    $tr_status = array(
                      'ซื้อสินค้า'  => array('Purchase' => 'ซื้อเข้า'),
                      'บริษัทเช่า'  => array('RentIn' => 'เช่าสินค้า'),
                      'ลูกค้าเช่า'  => array('GotBack' => 'รับคืนสินค้าเช่า')
                    );
                    break;

                  case 'deliver':
                    $tr_status = array(
                      'ขายสินค้า'  => array(
                          'Reserved' => 'จองสินค้า',
                          'Transport' => 'ระหว่างขนส่ง',
                          'Sale' => 'ขายสินค้า',
                        ),
                      'บริษัทเช่า'  => array('SentBack' => 'คืนสินค้าเช่ามา'),
                      'ลูกค้าเช่า'  => array(
                          'Reserved' => 'จองสินค้า',
                          'Transport' => 'ระหว่างขนส่ง',
                          'RentOut' => 'ปล่อยเช่าสินค้า',
                        ),
                    );
                    break;
                }

                $status = $data[0]->invent_move_status;

                echo form_dropdown('invent_move_status',$tr_status,$status,'id="invent_move_status"');
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