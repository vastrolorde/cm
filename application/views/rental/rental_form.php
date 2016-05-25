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

    <ul class="tabs" data-tabs id="rental-tabs">
      <li class="tabs-title is-active"><a href="#info" aria-selected="true">Info</a></li>
      <li class="tabs-title"><a href="#inv">Invoice Detail</a></li>
      <li class="tabs-title"><a href="#contract">Contract Detail</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="rental-tabs">
      <div class="tabs-panel is-active" id="info">

<!-- Content -->

        <?php echo form_open('/rental/add') ?>

        <div class="row">
          <div class="large-6 columns">
        <?php

          $fields = array(
            'partner' => 'partner_id',
            'ที่อยู่' => 'address',
            'ที่อยู่2' => 'address2',
          );

          foreach ($fields as $key => $value) {
            echo form_label($key).form_input($value);
          }

        ?>

          </div>
          <div class="large-6 columns">

        <?php

          $fields = array(
            'เลขที่เอกสาร' => 'id',
            'วันที่สร้างเอกสาร' => 'create_date',
            'เอกสารอ้างอิง' => 'ref_doc'
          );

          foreach ($fields as $key => $value) {
            echo form_label($key).form_input($value);
          }

        ?>

          </div>                                                                     
        </div>

<hr />

        <div class="row">
            <div class="large-12 columns">
              <table>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>รายการสินค้า</th>
                    <th>จำนวน</th>
                    <th>หน่วย</th>
                    <th>ค่าเช่า</th>
                    <th>ค้ำประกัน</th>
                    <th>รวม</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" name="" placeholder=""></td>
                    <td><input type="text" name="" placeholder=""></td>
                    <td><input type="text" name="" placeholder=""></td>
                    <td><input type="text" name="" placeholder=""></td>
                    <td><input type="text" name="" placeholder=""></td>
                    <td><input type="text" name="" placeholder=""></td>
                    <td><input type="text" name="" placeholder=""></td>
                    <td><a href="#">Add</a></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="#">Delete</a></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4" class="text-right">รวม</td>
                    <td></td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>

              <hr />

              <div class="row">
                <div class="large-6 columns">
              <?php

                $fields = array(
                  'วันที่เริ่มสัญญา' => 'start_contract',
                  'ค่าปรับต่อวันในกรณีเช่าเกิน' => 'paneltyperday'
                );

                foreach ($fields as $key => $value) {
                  echo form_label($key).form_input($value);
                }

              ?>
                </div>

                <div class="large-6 columns">
                 <!-- Blank -->
                </div>
              </div>
            
            </div>
        </div>

      </div>

      <div class="tabs-panel" id="inv">

        <h4>รายละเอียดการเรียกเก็บเงิน</h4>

        <div class="row">
          <div class="large-12 columns">
            <h5>ค้ำประกัน</h5>
              <?php

              $options = array(
                'ca' => 'เงินสด',
                'tr' => 'เงินโอน',
                'ch' => 'เช็ค'
                );
              echo form_label('การจ่ายเงินค้ำประกัน','GuaranteeType');
              echo form_dropdown('GuaranteeType',$options);

                $fields = array(
                  'จำนวนเงินค่าค้ำประกัน' => 'GuaranteeAmount'
                );

                foreach ($fields as $key => $value) {
                  echo form_label($key).form_input($value);
                }

              ?>
          </div>
        </div>

        <hr />

        <h5>ค่าเช่า</h5>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>เลขที่ Invoice</th>
              <th>วันที่ของ Invoice</th>
              <th>จำนวนเงิน Invoice</th>
              <th>การชำระเงิน</th>
              <th>หมายเหตุ</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td><input type="text" name="" placeholder="กรอก เลขที่ Invoice"></td>
              <td><input type="text" name="" placeholder="กรอก วันที่ของ Invoice"></td>
              <td><input type="text" name="" placeholder="กรอก จำนวนเงิน"></td>
              <td><input type="text" name="" placeholder="กรอก วิธีการชำระเงิน"></td>
              <td><input type="text" name="" placeholder="กรอก หมายเหตุ"></td>
              <td><a href="#">เพิ่ม</a></td>
            </tr>
          </tbody>
        </table>

      </div>
      <div class="tabs-panel" id="contract">
        <h4>รายละเอียดการต่อสัญญา</h4>

        <div class="row">
          <div class="large-12 columns">
            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>วันสิ้นสุดสัญญาเดิม</th>
                  <th>วันสิ้นสุดสัญญาใหม่</th>
                  <th>วันต่อสัญญา</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td><input type="text" name="old_exp_date"></td>
                  <td><input type="text" name="new_exp_date"></td>
                  <td><input type="text" name="mod_date"></td>
                  <td><a href="#">Create</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>

    </div>


  </div>
</div>