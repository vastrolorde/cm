<!-- Reveal Block -->

<div class="large reveal" id="Add" data-reveal>
  <h4>เพิ่มใหม่</h4>

  <?php
  $attributes = array(
      'id' => 'validate_form'
    );
    echo form_open('rental/add',$attributes);
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

            $start_contract = array(
                'type'  =>  'text',
                'name'  =>  'start_contract',
                'data-parsley-required' =>  'true',
                'class' =>  'datepicker',
                'id' =>  'start_contract'
              );

            $duration = array(
                'type'  =>  'hidden',
                'name'  =>  'duration',
                'id' =>  'duration'
              );


        echo form_label('วันเริ่มสัญญา')
            .form_input($start_contract);

        echo form_hidden('active','Y')
            .form_input($duration);
      ?>




    </div>
    <div class="large-6 columns">
      <?php
            
            $expire_contract = array(
                'type'  =>  'text',
                'name'  =>  'expire_contract',
                'data-parsley-required' =>  'true',
                'class' =>  'datepicker',
                'id' =>  'expire_contract'
              );


        echo form_label('วันสิ้นสุดสัญญา')
            .form_input($expire_contract);
      ?>
    </div>
  </div>

</div>

<!-- Reveal Block -->

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

<table id="datatable">

  <thead>
    <tr>
      <th>#</th>
      <th>รหัสเช่า</th>
      <th>ชื่อลูกค้า</th>
      <th>วันเริ่มเช่า</th>
      <th>วันถึงกำหนด</th>
      <th>actions</th>
    </tr>
  </thead>

  <tbody>
<?php
  $i=1;

    if($rental != null){
      foreach ($rental as $key){
        echo '
          <tr>
            <td>'.$i.'</td>
            <td>'.$key->id.'</td>
            <td>'.$key->partner_name.'</td>
            <td>'.$key->start.'</td>
            <td>'.$key->exp.'</td>
            <td><a href="'.site_url("Rental/data/".$key->id).'">Edit</a> | <a class="delitem" href="'.site_url("Rental/delete/".$key->id).'">Delete</a></td>
          </tr>
        ';

        $i++;

      }
    }else{
      echo '
        <tr>
          <td colspan="4"> No Data </td>
        </tr>
      ';
    }


?>
  </tbody>
</table>

  </div>
</div>
