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
      <li class="tabs-title"><a href="#Price">Price Detail</a></li>
      <li class="tabs-title"><a href="#Attribute">Attribute</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="partner-tabs">

    <!-- Info -->
      <div class="tabs-panel is-active" id="info">

        <?php echo form_open('/product/add') ?>

        <div class="row">
          <div class="large-6 columns">
        <?php

          $fields = array(
            'product code' => 'partner_id',
            'ชื่อสินค้า' => 'product_name',
            'หน่วยนับ' => 'product_unit',
          );

          foreach ($fields as $key => $value) {
            echo form_label($key).form_input($value);
          }

        ?>

          </div>
          <div class="large-6 columns">

          </div>                                                                     
        </div>

<hr />

        <div class="row">
          <div class="large-12 columns">
          <h5>ประเภท Product</h5>

            <?php

            $options = array(
                'Assets' =>'สินทรัพย์',
                'Product' => 'สินค้าเพื่อขาย',
                'Supply_Asset' => 'วัสดุสิ้นเปลือง',
                'sparePart' => 'วัสดุเพื่อการผลิต'
              );

              
              echo form_dropdown('ProductType',$options);
            ?>

          </div>
        </div>


      </div>


    <!-- Price -->

      <div class="tabs-panel" id="Price">

        <h4>ราคา</h4>
        <div class="row">
          <div class="large-12 columns">
          <?php

          $fields = array(
            'ต้นทุน' => 'Cost',
            'ราคาขายมือ1' => '1stSalePrice',
            'ราคาขายมือ2' => '2stSalePrice',
            'ราคาเช่ารายวัน' => 'dRentPrice',
            'ราคาค้ำประกัน' => 'GuaranteePrice',
          );

          foreach ($fields as $key => $value) {
            echo form_label($key).form_input($value);
          }

        ?>
          </div>
        </div>

      </div>

    <!-- Attribute -->

      <div class="tabs-panel" id="Attribute">
        <h4>รายระเอียด Attribute</h4>

        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>คุณลักษณะ</th>
              <th>รายละเอียด</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td><input type="text" name="AttrName" placeholder="คุณลักษณะ"></td>
              <td><input type="text" name="AttrDesc" placeholder="รายละเอียด"></td>
              <td><a href="#">Create</a></td>
            </tr>
          </tbody>
        </table>

      </div>

    </div>


  </div>
</div>