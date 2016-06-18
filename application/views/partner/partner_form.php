<?php
  if(!isset($data)){
    echo form_open('/partner/add');
  }else{
    echo form_open('/partner/edit/'.$data[0]->id);
  }
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
<!-- Tab -->

    <ul class="tabs" data-tabs id="partner-tabs">
      <li class="tabs-title is-active"><a href="#info" aria-selected="true">Info</a></li>
      <li class="tabs-title"><a href="#Contact">Contact Detail</a></li>
      <li class="tabs-title"><a href="#Bank">Bank Detail</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="partner-tabs">

    <!-- Info -->
      <div class="tabs-panel is-active" id="info">

        <div class="row">
          <h4>ข้อมูลทั่วไป</h4>

          <div class="large-12 columns">
          <h5>ประเภท Partner</h5>

          <?php

            if(isset($data)){
            //Assign Variable
              $partner_id = $data[0]->id;
              $partner_name = $data[0]->partner_name;


              echo form_label('partner *')
                  .form_error('id')
                  .form_input('id',$partner_id,'readonly');
              echo form_label('ชื่อ partner *')
                  .form_error('partner_name')
                  .form_input('partner_name',$partner_name);
            }else{
              echo form_label('partner *')
                  .form_error('id')
                  .form_input('id');
              echo form_label('ชื่อ partner *')
                  .form_error('partner_name')
                  .form_input('partner_name');
            }
            
            if(isset($data)){
              if(!is_null($data[0]->Type) && !empty($data[0]->Type) && $data[0]->Type != 'null'){
                $a = json_decode($data[0]->Type);

                echo form_checkbox('Type[]','customer',(in_array('customer',$a))? TRUE : FALSE ).form_label('ลูกค้า');
                echo form_checkbox('Type[]','supplier',(in_array('supplier',$a))? TRUE : FALSE).form_label('supplier');

              }
            }else{

              echo form_checkbox('Type[]','customer').form_label('ลูกค้า');
              echo form_checkbox('Type[]','supplier').form_label('supplier');
            }
            ?>

          <h5>ธุรกิจของ Partner</h5>
            <div class="row">

        <?php
          $options = array(
              'ธุรกิจการเกษตร‎' =>  'ธุรกิจการเกษตร‎',
              'ธุรกิจการท่องเที่ยวและนันทนาการ‎'  =>  'ธุรกิจการท่องเที่ยวและนันทนาการ‎',
              'ธุรกิจการแพทย์‎' =>  'ธุรกิจการแพทย์‎',
              'ธุรกิจขนส่งและโลจิสติกส์‎' =>  'ธุรกิจขนส่งและโลจิสติกส์‎',
              'ธุรกิจของใช้ส่วนตัวและเวชภัณฑ์‎' =>  'ธุรกิจของใช้ส่วนตัวและเวชภัณฑ์‎',
              'ธุรกิจเครื่องใช้ในครัวเรือน‎'  =>  'ธุรกิจเครื่องใช้ในครัวเรือน‎',
              'ธุรกิจเงินทุนและหลักทรัพย์‎' =>  'ธุรกิจเงินทุนและหลักทรัพย์‎',
              'ธุรกิจเทคโนโลยีสารสนเทศและการสื่อสาร‎' =>  'ธุรกิจเทคโนโลยีสารสนเทศและการสื่อสาร‎',
              'ธุรกิจแฟชั่น‎' =>  'ธุรกิจแฟชั่น‎',
              'ธุรกิจวัสดุก่อสร้าง‎'  =>  'ธุรกิจวัสดุก่อสร้าง‎',
              'ธุรกิจเหมืองแร่‎'  =>  'ธุรกิจเหมืองแร่‎',
              'ธุรกิจประกันภัยและประกันชีวิต‎'  =>  'ธุรกิจประกันภัยและประกันชีวิต‎',
              'ธุรกิจปิโตรเลียมและเคมีภัณฑ์‎' =>  'ธุรกิจปิโตรเลียมและเคมีภัณฑ์‎',
              'ธุรกิจพลังงานและสาธารณูปโภค‎'  =>  'ธุรกิจพลังงานและสาธารณูปโภค‎',
              'ธุรกิจพัฒนาอสังหาริมทรัพย์‎' =>  'ธุรกิจพัฒนาอสังหาริมทรัพย์‎',
              'ธุรกิจพาณิชย์‎'  =>  'ธุรกิจพาณิชย์‎',
              'ธุรกิจยานยนต์‎'  =>  'ธุรกิจยานยนต์‎',
              'ธุรกิจวัสดุอุตสาหกรรมและเครื่องจักร‎'  =>  'ธุรกิจวัสดุอุตสาหกรรมและเครื่องจักร‎',
              'ธุรกิจสื่อและสิ่งพิมพ์‎' =>  'ธุรกิจสื่อและสิ่งพิมพ์‎',
              'ธุรกิจอาหารและเครื่องดื่ม‎'  =>  'ธุรกิจอาหารและเครื่องดื่ม‎'
          );

          if(isset($data)){
              $Type_select = $data[0]->Sector;
            }

            echo '<div class="large-6 columns">'.form_dropdown('Sector',$options,(isset($data))? $Type_select : 'ธุรกิจการเกษตร‎').'</div>';
        ?>
            </div>


          </div>
        </div>

<hr />
        <div class="row">
          <div class="large-6 columns">

        <?php
          
          if(isset($data)){
            //Assign Variable
            $add1 = $data[0]->add1;
            $SubDist = $data[0]->SubDist;
            $Province = $data[0]->Province;


            echo form_label('ที่อยู่')
                .form_input('add1',$add1);
            echo form_label('แขวง/ตำบล')
                .form_input('SubDist',$SubDist);
            echo form_label('จังหวัด')
                .form_input('Province',$Province);
          }else{
            echo form_label('ที่อยู่')
                .form_input('add1');
            echo form_label('แขวง/ตำบล')
                .form_input('SubDist');
            echo form_label('จังหวัด')
                .form_input('Province');
          }
        ?>
          </div>
          <div class="large-6 columns">

        <?php
          
          if(isset($data)){
            //Assign Variable
            $add2 = $data[0]->add2;
            $Dist = $data[0]->Dist;
            $Postal = $data[0]->Postal;


            echo form_label('ที่อยู่2')
                .form_input('add2',$add2);
            echo form_label('เขต/อำเภอ')
                .form_input('Dist',$Dist);
            echo form_label('รหัสไปรษณีย์')
                .form_input('Postal',$Postal);
          }else{
            echo form_label('ที่อยู่2')
                .form_input('add2');
            echo form_label('เขต/อำเภอ')
                .form_input('Dist');
            echo form_label('รหัสไปรษณีย์')
                .form_error('Postal')
                .form_input('Postal');
          }
        ?>

          </div>                                                                     
        </div>

<hr />

<div class="row">
  <div class="large-8 columns">

    <?php
      
      if(isset($data)){
        //Assign Variable
        $tel = $data[0]->tel;
        $Fax = $data[0]->Fax;
        $Email = $data[0]->email;

        echo form_label('เบอร์โทรศัพท์ (ตัวอย่าง 02-345-6789)')
            .form_error('tel')
            .form_input('tel',$tel,'class="tel"');
        echo form_label('Fax (ตัวอย่าง 02-345-6789)')
            .form_error('Fax')
            .form_input('Fax',$Fax,'class="tel"');
        echo form_label('E-mail')
            .form_error('email')
            .form_input('email',$Email);
      }else{
        echo form_label('เบอร์โทรศัพท์ (ตัวอย่าง 081-234-5678)')
            .form_error('tel')
            .form_input('tel','','class="tel"');
        echo form_label('Fax (ตัวอย่าง 081-234-5678)')
            .form_error('Fax')
            .form_input('Fax','','class="tel"');
        echo form_label('E-mail')
            .form_error('email')
            .form_input('email');
      }
    ?>

  </div>
</div>

      </div>


    <!-- Contact -->

      <div class="tabs-panel" id="Contact">

        <h4>ผู้ติดต่อ</h4>
        <hr />
        <a href="#" id="Add_contactor_row" class="button">Add row</a>

        <table id="contactor">
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

            <?php
              $i=0;
              
              if(isset($data[0]->partner_contactor)){

                $a = json_decode($data[0]->partner_contactor);

                foreach ($a as $row) {
                  $i++;
                  echo '
                    <tr>
                      <td>'.$i.'</td>
                      <td><input type="text" name="partner_contactor['.$i.'][name]" value="'.$row->name.'" placeholder="กรอก ชื่อผู้ติดต่อ"></td>
                      <td><input type="text" name="partner_contactor['.$i.'][position]" value="'.$row->position.'" placeholder="กรอก ตำแหน่ง"></td>
                      <td><input type="text" name="partner_contactor['.$i.'][tel]" value="'.$row->tel.'" placeholder="กรอก เบอร์โทรศัพท์" class="tel"></td>
                      <td><input type="text" name="partner_contactor['.$i.'][email]" value="'.$row->email.'" placeholder="กรอก email"></td>
                      <td><input type="text" name="partner_contactor['.$i.'][remark]" value="'.$row->remark.'" placeholder="กรอก หมายเหตุ"></td>
                      <td><a href="#" class="Del_contactor_row">ลบ</a></td>
                    </tr>
                  ';
                }
              }else{
                $i++;
                echo '
                  <tr>
                    <td>'.$i.'</td>
                    <td><input type="text" name="partner_contactor['.$i.'][name]" placeholder="กรอก ชื่อผู้ติดต่อ"></td>
                    <td><input type="text" name="partner_contactor['.$i.'][position]" placeholder="กรอก ตำแหน่ง"></td>
                    <td><input type="text" name="partner_contactor['.$i.'][tel]" placeholder="กรอก เบอร์โทรศัพท์" class="tel"></td>
                    <td><input type="text" name="partner_contactor['.$i.'][email]" placeholder="กรอก email"></td>
                    <td><input type="text" name="partner_contactor['.$i.'][remark]" placeholder="กรอก หมายเหตุ"></td>
                    <td><a href="#" class="Del_contactor_row">ลบ</a></td>
                  </tr>
                ';
              }
            ?>

          </tbody>
        </table>

      </div>

    <!-- Bank -->

      <div class="tabs-panel" id="Bank">
        <h4>รายระเอียด Bank</h4>

        <div class="row">
          <div class="large-12 columns">
        <?php

          $options = array(
            'ออมทรัพย์' =>  'ออมทรัพย์',
            'ฝากประจำ' =>  'ฝากประจำ',
            'กระแสรายวัน' =>  'กระแสรายวัน'
          );

            $i = 0;
            foreach ($bank as $key) {
              $banklist[$bank[$i]['id']] = $bank[$i]['name'];
              $i++;
            }

            if(isset($data)){
              $bank_select = $data[0]->Bank;
              $Acc_name = $data[0]->Acc_name;
              $Acc_no = $data[0]->Acc_no;
              $Acc_type_select = $data[0]->Acc_type;
              $Acc_branch = $data[0]->Acc_branch;
            }

            echo form_label('Bank')
                .form_dropdown('Bank',$banklist,(isset($data))? $bank_select : 'AGR');
            echo form_label('ชื่อบัญชี')
                .form_input('Acc_name');
            echo form_label('เลขที่บัญชี')
                .form_input('Acc_no',(isset($data))? $Acc_no : '','class="bank"');
            echo form_label('ประเภท')
                .form_dropdown('Acc_type',$options,(isset($data))? $Acc_type_select : 'กระแสรายวัน');
            echo form_label('สาขาบัญชี')
                .form_input('Acc_branch');

        ?>
          </div>
        </div>

      </div>

    </div>


  </div>
</div>