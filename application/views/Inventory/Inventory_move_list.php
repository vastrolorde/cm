
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
    </ul>
  </div>
</div>

<div class="large reveal" id="Add" data-reveal>
  <h4>เพิ่มใหม่</h4>

  <?php
  $attributes = array(
      'id' => 'validate_form'
    );

    echo form_open('Inventory/Inventory/add',$attributes);
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

            $i = 0;
            foreach ($partner as $key) {
              $partner_list[$partner[$i]['id']] = $partner[$i]['partner_name'];
              $i++;
            }

            $id = array(
                'type'  =>  'text',
                'name'  =>  'id',
                'data-parsley-required' =>  'true'
              );

            $tr_type = array(
                'recieve' => 'รับสินค้า',
                'deliver' =>'ส่งสินค้า'
              );

        echo form_label('เลขที่เอกสาร')
            .form_input($id);
        echo form_label('ลูกค้า')
            .form_dropdown('partner_id',$partner_list);
        echo form_label('ชนิดรายการ')
            .form_dropdown('invent_move_type',$tr_type);
      ?>




    </div>
    <div class="large-6 columns">
      <?php

      $create_date = array(
          'name' => 'create_date',
          'type' => 'text',
          'class' => 'timestamp',
          'readonly' => 'true'
        );

        
        echo form_label('วันที่เอกสาร')
            .form_input($create_date);
        echo form_label('วันที่ลูกค้ามารับของ')
            .form_input('invent_move_Date','','class="datepicker"');
        echo form_hidden('invent_move_status','process');
      ?>
    </div>
  </div>

</div>

<table id="datatable">

  <thead>
    <tr>
      <th>#</th>
      <th>เลขที่เอกสาร</th>
      <th>วันที่สร้างเอกสาร</th>
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
      <td>'.$key->create_date.'</td>
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

  </div>
</div>
