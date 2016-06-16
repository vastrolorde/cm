
<div class="row">
  <div class="large-12 columns">

<div class="top-bar sub-top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><?php echo $title;?></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <li><a class="hollow button" data-open="Add">เพิ่ม</a></li>
      <li><a class="hollow button" href="#">พิมพ์</a></li>
      <li>
        <input id="search" type="text" name="search" placeholder="Search">
      </li>
      <li><button id="submitsearch" type="button" class="button">Search</button></li>
    </ul>
  </div>
</div>

<div class="large reveal" id="Add" data-reveal>
  <h4>เพิ่มใหม่</h4>

  <?php
    echo form_open('Inventory/Inventory/add');
  ?>

  <div class="row">
    <div class="large-12 columns text-right">
      <button class="button">submit</button>
      <button class="button alert" data-close aria-label="Close modal" type="button">ยกเลิก</button>
    </div>
  </div>

  <div class="row">
    <div class="large-6 columns ver-divider">
      
      <?php

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
invent_move_Date  =>  วันที่ดำเนินการ
invent_move_type  =>  ชนิดรายการ
invent_move_status  =>  สถานะรายการ

*/


            $i = 0;
            foreach ($partner as $key) {
              $partner_list[$partner[$i]['id']] = $partner[$i]['partner_name'];
              $i++;
            }

        echo form_label('ลูกค้า')
            .form_error('partner_id')
            .form_dropdown('partner_id',$partner_list);
      ?>

        <h5>ที่อยู่ในการรับส่งสินค้า</h5>

        <select name="delivery_add" id="delivery_add">
          <option type="!sameAdd">ที่จัดส่งคนละที่กับของลูกค้า</option>
          <option type="sameAdd" selected="selected">ตามที่อยู่ของลูกค้า</option>
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
    <div class="large-6 columns">
      <?php
      $tr_type = array(
          'recieve' => 'รับสินค้า',
          'deliver' =>'ส่งสินค้า'
        );
      $tr_status = array(
          'draft' => 'ร่างเอกสาร',
          'done' => 'ดำเนินการแล้ว',
          'cancel' =>'ยกเลิก'
        );

        echo form_label('เลขที่เอกสาร')
            .form_error('id')
            .form_input('id');
        echo form_label('วันที่เอกสาร')
            .'<p><span class="timestamp"></span></p>'
            .form_hidden('invent_move_createDate');
        echo form_label('วันที่ดำเนินการ')
            .form_input('invent_move_Date','','class="datepicker"');
        echo form_label('ชนิดรายการ')
            .form_dropdown('invent_move_type',$tr_type);
        echo form_label('สถานะรายการ')
            .form_dropdown('invent_move_status',$tr_status);
      ?>
    </div>
  </div>

</div>

<table>

  <thead>
    <tr>
      <th>#</th>
      <th>เลขที่เอกสาร</th>
      <th>วันที่เอกสาร</th>
      <th>ชื่อ Partner</th>
      <th>ชนิดรายการ</th>
      <th>สถานะรายการ</th>
      <th>actions</th>
    </tr>
  </thead>

  <tbody>
  <?php
    $i = 1;

    if($result != null){
    foreach ($result as $key){
      echo '
    <tr>
      <td>'.$i.'</td>
      <td>'.$key->id.'</td>
      <td>'.$key->invent_move_createDate.'</td>
      <td>'.$key->partner_id.'</td>
      <td>'.$key->invent_move_type.'</td>
      <td>'.$key->invent_move_status.'</td>
      <td><a href="'.site_url("Inventory/Inventory/data/".$key->id).'">Edit</a></td>
    </tr>
      ';

      $i++;
      }
    }else{
      echo '
        <tr>
          <td colspan="7"> No Data </td>
        </tr>
      ';
    }

  ?>
  </tbody>
</table>

<div class="row">
  <div class="large-12 columns">
      <span class="text-center"><?php echo $pagination; ?></span>
  </div>
</div>

  </div>
</div>


    <script type="text/javascript">


      $('#delivery_add').change(function(){
        if($('#delivery_add').val() == 'ที่จัดส่งคนละที่กับของลูกค้า') {
            $('input[name=invent_move_add1]').val('test');
            $('input[name=invent_move_add2]').val('test');
            $('input[name=invent_move_subDist]').val('test');
            $('input[name=invent_move_Dist]').val('test');
            $('input[name=invent_move_Province]').val('test');
            $('input[name=invent_move_Postal]').val('test');
        }else{
            $('input[name=invent_move_add1]').val('');
            $('input[name=invent_move_add2]').val('');
            $('input[name=invent_move_subDist]').val('');
            $('input[name=invent_move_Dist]').val('');
            $('input[name=invent_move_Province]').val('');
            $('input[name=invent_move_Postal]').val('');
        }
      });
    </script>