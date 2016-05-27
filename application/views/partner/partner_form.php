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

    <ul class="tabs" data-tabs id="partner-tabs">
      <li class="tabs-title is-active"><a href="#info" aria-selected="true">Info</a></li>
      <li class="tabs-title"><a href="#Contact">Contact Detail</a></li>
      <li class="tabs-title"><a href="#Bank">Bank Detail</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="partner-tabs">

    <!-- Info -->
      <div class="tabs-panel is-active" id="info">

        <?php echo form_open('/partner/add') ?>

        <div class="row">
          <div class="large-6 columns">
        <?php

          $fields = array(
            'partner' => 'partner_id',
            'ที่อยู่' => 'address',
            'แขวง/ตำบล' => 'subDist',
            'จังหวัด' => 'Province',
          );

          foreach ($fields as $key => $value) {
            echo form_label($key).form_input($value);
          }

        ?>

          </div>
          <div class="large-6 columns">
        <?php

          $fields = array(
            'ชื่อ partner' => 'partner_name',
            'ที่อยู่2' => 'address2',
            'เขต/อำเภอ' => 'Dist',
            'รหัสไปรษณีย์' => 'Postal'
          );

          foreach ($fields as $key => $value) {
            echo form_label($key).form_input($value);
          }

        ?>
          </div>                                                                     
        </div>

<hr />

<div class="row">
  <div class="large-8 columns">
    <?php

      $fields = array(
        'เบอร์โทรศัพท์' => 'tel',
        'Fax' => 'Fax',
        'E-mail' => 'e-mail'
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
          <h5>ประเภท Partner</h5>

            <?php

            $checkbox = array('ลูกค้า','supplier');

            foreach ($checkbox as $value) {
              
              echo form_checkbox('partner_type[]',$value).form_label($value);
            }
            ?>

          <h5>ธุรกิจของ Partner</h5>
            <div class="row">

        <?php

          $checkbox = array(
'ธุรกิจการเกษตร‎',
'ธุรกิจการท่องเที่ยวและนันทนาการ‎',
'ธุรกิจการแพทย์‎',
'ธุรกิจขนส่งและโลจิสติกส์‎',
'ธุรกิจของใช้ส่วนตัวและเวชภัณฑ์‎',
'ธุรกิจเครื่องใช้ในครัวเรือน‎',
'ธุรกิจเงินทุนและหลักทรัพย์‎',
'ธุรกิจเทคโนโลยีสารสนเทศและการสื่อสาร‎',
'ธุรกิจแฟชั่น‎',
'ธุรกิจวัสดุก่อสร้าง‎',
'ธุรกิจเหมืองแร่‎',
'ธุรกิจประกันภัยและประกันชีวิต‎',
'ธุรกิจปิโตรเลียมและเคมีภัณฑ์‎',
'ธุรกิจพลังงานและสาธารณูปโภค‎',
'ธุรกิจพัฒนาอสังหาริมทรัพย์‎',
'ธุรกิจพาณิชย์‎',
'ธุรกิจยานยนต์‎',
'ธุรกิจวัสดุอุตสาหกรรมและเครื่องจักร‎',
'ธุรกิจสื่อและสิ่งพิมพ์‎',
'ธุรกิจอาหารและเครื่องดื่ม‎'
          );

          foreach ($checkbox as $value) {
            echo '<div class="large-6 columns">'.form_checkbox('partner_business[]',$value).form_label($value).'</div>';
          }
        ?>
            </div>


          </div>
        </div>


      </div>


    <!-- Contact -->

      <div class="tabs-panel" id="Contact">

        <h4>ผู้ติดต่อ</h4>

        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>ชื่อผู้ติดต่อ</th>
              <th>ตำแหน่ง</th>
              <th>เบอร์โทรศัพท์</th>
              <th>e-mail</th>
              <th>หมายเหตุ</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td><input type="text" name="contactor_name[]" placeholder="กรอก ชื่อผู้ติดต่อ"></td>
              <td><input type="text" name="contactor_position[]" placeholder="กรอก ตำแหน่ง"></td>
              <td><input type="text" name="contactor_tel[]" placeholder="กรอก เบอร์โทรศัพท์"></td>
              <td><input type="text" name="contactor_e-mail[]" placeholder="กรอก e-mail"></td>
              <td><input type="text" name="contactor_remark[]" placeholder="กรอก หมายเหตุ"></td>
              <td><a href="#">เพิ่ม</a></td>
            </tr>
          </tbody>
        </table>

      </div>

    <!-- Bank -->

      <div class="tabs-panel" id="Bank">
        <h4>รายระเอียด Bank</h4>

        <div class="row">
          <div class="large-12 columns">
        <?php

          $fields = array(
            'Bank' => 'bank',
            'ชื่อบัญชี' => 'Acc_name',
            'เลขที่บัญชี' => 'Acc_no',
            'ประเภทบัญชี' => 'Acc_type',
            'สาขาบัญชี' => 'Acc_branch',
          );

          foreach ($fields as $key => $value) {
            echo form_label($key).form_input($value);
          }

        ?>
          </div>
        </div>

      </div>

    </div>


  </div>
</div>