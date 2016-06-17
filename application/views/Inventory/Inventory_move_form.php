<?php
  if(!isset($data)){
    echo form_open('/Inventory/Inventory/add');
  }else{
    echo form_open('/Inventory/Inventory/edit/'.$data[0]->id);
  }


/*

partner_id => ลูกค้า
invent_move_add1 => ที่อยู่ 1
invent_move_add2 => ที่อยู่ 2
invent_move_subDist => แขวง/ตำบล
invent_move_Dist => อำเภอ/เขต
invent_move_Province => จังหวัด
invent_move_Postal => รหัสไปรษณีย์
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
<!-- Start Form -->

    <div class="row">
      <div class="large-6 columns">
      <?php
        $i = 0;
        foreach ($partner as $key) {
          $partner_list[$partner[$i]['id']] = $partner[$i]['partner_name'];
          $i++;
        }

        echo form_label('ลูกค้า')
            .form_error('partner_id')
            .form_dropdown('partner_id',$partner_list);
      ?>

        <!-- ที่อยู่ในการรับส่งสินค้า -->

        <h5>ที่อยู่ในการรับส่งสินค้า</h5>

        <select name="delivery_add" id="delivery_add">
          <option type="!sameAdd">ที่จัดส่งคนละที่กับของลูกค้า</option>
          <option type="sameAdd" selected="selected">ตามที่อยู่ของลูกค้า</option>
          <option type="comAdd">มารับที่บริษัท</option>
        </select>

      <?php


        echo form_label('ที่อยู่ 1')
            .form_error('invent_move_add1')
            .form_input('invent_move_add1','','class="delivery_to"');
        echo form_label('ที่อยู่ 2')
            .form_error('invent_move_add2')
            .form_input('invent_move_add2','','class="delivery_to"');
        ?>

        <div class="row">
          <div class="large-6 columns">
            <?php
            echo form_label('แขวง/ตำบล')
                .form_error('invent_move_subDist')
                .form_input('invent_move_subDist','','class="delivery_to"');
            echo form_label('อำเภอ/เขต')
                .form_error('invent_move_Dist')
                .form_input('invent_move_Dist','','class="delivery_to"');
            ?>
          </div>
          <div class="large-6 columns">
            <?php
            echo form_label('จังหวัด')
                .form_error('invent_move_Province')
                .form_input('invent_move_Province','','class="delivery_to"');
            echo form_label('รหัสไปรษณีย์')
                .form_error('invent_move_Postal')
                .form_input('invent_move_Postal','','class="delivery_to"');
            ?>
          </div>
        </div>

      </div>

        <!-- ที่อยู่ในการรับส่งสินค้า -->

      <div class="large-6 columns text-right">
        <h5>ข้อมูลเอกสาร</h5>
        
        <div class="row">
          <div class="large-6 columns">
            <b>id:</b><br />
            <b>วันที่เอกสาร:</b><br />
            <b>ชนิดรายการ:</b><br />

          </div>
          <div class="large-6 columns">
            <?php
              echo $data[0]->id.'<br />';
              echo $data[0]->invent_move_createDate.'<br />';


              if($data[0]->invent_move_type == 'recieve'){
                echo 'รับสินค้า<br />';
              }elseif($data[0]->invent_move_type == 'deliver'){
                echo 'ส่งสินค้า<br />';
              }

              
            ?>
          </div>
        </div>

      </div>
    </div>

        <!-- Table -->

        <div class="row">
          <div class="large-12 columns">
          
          <div class="row">
            <div class="large-6 columns">
              <input type="text" name="product_id" placeholder="รายการสินค้า">
            </div>
            <div class="large-4 columns">
              <input type="number" name="amount" placeholder="จำนวน">
            </div>
            <div class="large-2 columns">
              <a class="button">Add</a>
            </div>
          </div>
          

            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>รายการสินค้า</th>
                  <th>น้ำหนัก</th>
                  <th>จำนวน</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="inventory_transaction">
              </tbody>
            </table>
          </div>
        </div>

        <!-- End Table -->

<!-- End Form -->

  </div>
</div>