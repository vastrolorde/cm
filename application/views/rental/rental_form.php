<?php
  $attributes = array(
      'id' => 'validate_form'
    );

  if(isset($data)){
    echo form_open('/rental/edit/'.$data[0]->id,$attributes);
  }

 // id
// partner_id
// create_date
// ref_doc
// start_contract
// expire_contract
// paymentType
// guaranteeType
// paymentAmount
// guaranteeAmount
// VAT
// panaltyPerDa 
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

    <div class="tabs-content" data-tabs-content="rental-tabs">
      <div class="tabs-panel is-active" id="info">

<!-- Content -->

        <div class="row">
          <div class="large-3 columns">
        <?php      
          if(isset($data)){
            //Assign Variable
            $partner_id = array(
                'type'  =>  'text',
                'name'  =>  'partner_id',
                'value' =>  $data[0]->partner_id,
                'id' => 'partner_id',
                'data-parsley-required' =>  'true',
              );

            echo form_label('ลูกค้า *')
            .form_input($partner_id);
          }
        ?>           
          </div>
          <div class="large-4 columns" id="#customer">
            
          </div>
          <div class="large-4 columns">
        <?php
          
          if(isset($data)){
            //Assign Variable
            $id = $data[0]->id;

            echo form_label('เลขที่เอกสาร')
                .form_input('id',$id,'readonly id="id"');

          }
        ?>
          </div>
        </div>

        <div class="row">
          <div class="large-5 columns">

        <?php
          
          if(isset($data)){
            //Assign Variable
            $start_contract = array(
                'type'  =>  'text',
                'name'  =>  'start_contract',
                'id'  =>  'start_contract',
                'value' => $data[0]->start,
                'data-parsley-required' =>  'true',
                'class' =>  'datepicker',
                'readonly' => 'true'
              );

            $expire_contract = array(
                'type'  =>  'text',
                'name'  =>  'expire_contract',
                'id'  =>  'expire_contract',
                'value' => $data[0]->exp,
                'data-parsley-required' =>  'true',
                'class' =>  'datepicker',
                'readonly' => 'true'
              );

            $duration = array(
                'type'  =>  'text',
                'name'  =>  'duration',
                'id'  =>  'duration',
              );

            echo form_label('วันที่เริ่มสัญญา *')
                .form_input($start_contract);
            echo form_label('วันที่สิ้นสุดสัญญา *')
                .form_input($expire_contract);
            echo form_label('ระยะเวลา')
                .form_input($duration);
          }
        ?>

          </div>
          <div class="large-4 columns">
        <?php
          
          if(isset($data)){
            //Assign Variable
            $create_date = $data[0]->create_date;
            $ref_doc = $data[0]->ref_doc;

            echo form_label('วันที่สร้างเอกสาร')
                .form_input('create_date',$create_date,'readonly');
            echo form_label('เอกสารอ้างอิง')
                .form_input('ref_doc',$ref_doc);
          }
        ?>
          </div>                                                                     
        </div>

        <!-- การจ่ายเงินค้ำประกัน -->
        <h5>ประเภทการจ่ายเงินค้ำประกัน</h5>
        <div class="row">

        <?php

        $guaranteeType = array(
            'เงินสด' => 'เงินสด',
            'เช็ค' => 'เช็ค',
            'โอน' => 'โอน',
          );

          $tranferDate = array(
              'type'  =>  'text',
              'name'  =>  'tranferDate',
              'id'  =>  'tranferDate',
              'value' => $data[0]->trDate,
              'data-parsley-required' =>  'true',
              'class' =>  'datepicker'
            );


          echo '

          <div class="large-2 columns">
            <label for="middle-label" class="text-right middle">ประเภทการจ่าย</label>
          </div>
          <div class="large-4 columns">';

          echo form_dropdown('guaranteeType', $guaranteeType, $data[0]->guaranteeType).'</div>';

          echo '
          <div class="large-2 columns">
            <label for="middle-label" class="text-right middle">ลงวันที่</label>
          </div>
          <div class="large-4 columns">';
          echo form_input($tranferDate).'</div>';

        ?>
        
        </div>

        <div class="row">
        <?php

          $i = 0;
          foreach ($bank as $key) {
            $banklist[$bank[$i]['id']] = $bank[$i]['name'];
            $i++;
          }

          $branch = array(
              'type'  =>  'text',
              'name'  =>  'branch',
              'id'  =>  'branch',
              'value' => $data[0]->branch
            );

          echo '

          <div class="large-2 columns">
            <label for="branch" class="text-right middle">สาขา</label>
          </div>
          <div class="large-4 columns">';

          echo form_input($branch).'</div>';

          echo '
          <div class="large-2 columns">
            <label for="Bank" class="text-right middle">ธนาคาร</label>
          </div>
          <div class="large-4 columns">';
          echo form_dropdown('Bank', $banklist, $data[0]->Bank).'</div>';
        ?>

        </div>

        <div class="row">
        <?php

          $tranferNote = array(
              'type'  =>  'number',
              'name'  =>  'tranferNote',
              'id'  =>  'tranferNote',
              'value' => $data[0]->tranferNote
            );

          $Acc_no = array(
              'type'  =>  'text',
              'name'  =>  'Acc_no',
              'id'  =>  'Acc_no',
              'value' => $data[0]->Acc_no,
              'class' =>  'bank'
            );

          echo '

          <div class="large-2 columns">
            <label for="tranferNote" class="text-right middle">เลขที่เช็ค/อ้างอิง</label>
          </div>
          <div class="large-4 columns">';

          echo form_input($tranferNote);

          echo '</div>
          <div class="large-2 columns">
            <label for="Acc_no" class="text-right middle">เลขที่บัญชี</label>
          </div>
          <div class="large-4 columns">';
          echo form_input($Acc_no);
          echo '</div>';
        ?>

        </div>

        <!-- การจ่ายเงินค้ำประกัน -->

<hr />
        <h5>รายการสินค้า</h5>

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

<?php
/*
  total_rental
  discount
  subtotal  = total_rental - discount
  VAT = subtotal * VATType
  grandtotal = subtotal + VAT

*/
    if(isset($data)){
      //Assign Variable
    $discount_db = array(
      'type'  => 'hidden',
      'name'  => 'discount_db',
      'value' => $data[0]->discount,
      'id'    => 'discount_db'
    );
      //Assign Variable
    $VATType_db = array(
      'type'  => 'hidden',
      'name'  => 'VATType_db',
      'value' => $data[0]->VATType,
      'id'    => 'VATType_db'
    );

      echo form_input($discount_db);
      echo form_input($VATType_db);

    }

?>

        <div class="row">
            <div class="large-12 columns">
              <table id="transaction">
              </table>
            </div>
        </div>
        
    </div>


  </div>
</div>