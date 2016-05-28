<?php
  if(!isset($data)){
    echo form_open('/product/add');
  }else{
    echo form_open('/product/edit/');
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

<!-- Tab -->

    <ul class="tabs" data-tabs id="partner-tabs">
      <li class="tabs-title is-active"><a href="#info" aria-selected="true">Info</a></li>
      <li class="tabs-title"><a href="#Price">Price Detail</a></li>
      <li class="tabs-title"><a href="#Attribute">Attribute</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="partner-tabs">

    <!-- Info -->
      <div class="tabs-panel is-active" id="info">
        <div class="row">
          <div class="large-6 columns">

        <?php
          
          if(isset($data)){
            //Assign Variable
            $product_id = $data[0]->product_id;
            $product_unit = $data[0]->product_unit;


            echo form_label('product code').form_input('product_id',$product_id);
            echo form_label('หน่วยนับ').form_input('product_unit',$product_unit);
          }else{
            echo form_label('product code').form_input('product_id');
            echo form_label('หน่วยนับ').form_input('product_unit');
          }
        ?>

          </div>
          <div class="large-6 columns">

        <?php
          
          if(isset($data)){
            //Assign Variable
            $product_name = $data[0]->product_name;
            $product_weight = $data[0]->product_weight;


            echo form_label('ชื่อสินค้า').form_input('product_name',$product_name);
            echo form_label('น้ำหนักต่อชิ้น').form_input('product_weight',$product_weight);
          }else{
            echo form_label('ชื่อสินค้า').form_input('product_name');
            echo form_label('น้ำหนักต่อชิ้น').form_input('product_weight');
          }
        ?>
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

          if(isset($data)){
            //Assign Variable
            $product_type = $data[0]->product_type;

            echo form_dropdown('product_type',$options,$product_type);
          }else{

            echo form_dropdown('product_type',$options);

          }

        ?>

          </div>
        </div>

        <div class="row">
          <div class="large-12 columns">

        <?php

          if(isset($data)){
            //Assign Variable
            $product_Desc = $data[0]->product_Desc;

            echo form_label('รายละเอียด').form_textarea('product_Desc',$product_Desc);
          }else{
            echo form_label('รายละเอียด').form_textarea('product_Desc');
          }

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

          if(isset($data)){
            //Assign Variable
            $product_Desc           = $data[0]->product_Desc;
            $product_cost           = $data[0]->product_cost;
            $product_1stSalePrice   = $data[0]->product_1stSalePrice;
            $product_2ndSalePrice   = $data[0]->product_2ndSalePrice;
            $product_d_RentalPrice  = $data[0]->product_d_RentalPrice;
            $product_GuaranteePrice = $data[0]->product_GuaranteePrice;

            echo form_label('ต้นทุน').form_input('product_cost',$product_cost);
            echo form_label('ราคาขายมือ1').form_input('product_1stSalePrice',$product_1stSalePrice);
            echo form_label('ราคาขายมือ2').form_input('product_2ndSalePrice',$product_2ndSalePrice);
            echo form_label('ราคาเช่ารายวัน').form_input('product_d_RentalPrice',$product_d_RentalPrice);
            echo form_label('ราคาค้ำประกัน').form_input('product_GuaranteePrice',$product_GuaranteePrice);
          }else{
            echo form_label('ต้นทุน').form_input('product_cost');
            echo form_label('ราคาขายมือ1').form_input('product_1stSalePrice');
            echo form_label('ราคาขายมือ2').form_input('product_2ndSalePrice');
            echo form_label('ราคาเช่ารายวัน').form_input('product_d_RentalPrice');
            echo form_label('ราคาค้ำประกัน').form_input('product_GuaranteePrice');
          }

        ?>
          </div>
        </div>

      </div>

    <!-- Attribute -->

      <div class="tabs-panel" id="Attribute">
        <h4>รายระเอียด Attribute</h4>
        <hr />
        <a href="#" id="Add_Product_row" class="button">Add row</a>

        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>คุณลักษณะ</th>
              <th>รายละเอียด</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="Product_detail">
            <?php
              $i=0;
              
              if(isset($data2)){
                $count = count($data2);
                foreach ($data2 as $row) {
                  $i++;
                  echo '
                    <tr>
                      <td>'.$i.'</td>
                      <td><input type="text" id="product_AttrName" name="product_AttrName[]" value="'.$row->product_AttrName.'" placeholder="คุณลักษณะ"></td>
                      <td><input type="text" id="product_AttrDesc" name="product_AttrDesc[]" value="'.$row->product_AttrDesc.'"  placeholder="รายละเอียด"></td>
                      <td><a onClick="$(this).closest(\'tr\').remove();">Delete</a></td>
                    </tr>
                  ';
                }
              }else{
                $i++;
                echo '
                  <tr>
                    <td>'.$i.'</td>
                    <td><input type="text" id="product_AttrName" name="product_AttrName[]" placeholder="คุณลักษณะ"></td>
                    <td><input type="text" id="product_AttrDesc" name="product_AttrName[]" placeholder="รายละเอียด"></td>
                    <td><a class="Del_Product_row">Delete</a></td>
                  </tr>
                ';
              }
            ?>
          </tbody>
        </table>

      </div>

    </div>


  </div>
</div>