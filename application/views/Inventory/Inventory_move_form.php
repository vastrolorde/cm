<?php
  if(!isset($data)){
    echo form_open('/Inventory/Inventory/add');
  }else{
    echo form_open('/Inventory/Inventory/edit/'.$data[0]->id);
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
<!-- Start Form -->

    <div class="row">
      <div class="large-6 columns">
        <h4>ข้อมูลลูกค้า</h4>
      </div>
      <div class="large-6 columns text-right">
        <h4>ข้อมูลเอกสาร</h4>
      </div>
    </div>

<!-- End Form -->

  </div>
</div>