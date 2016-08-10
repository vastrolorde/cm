<?php
  $attributes = array(
      'id' => 'validate_form'
    );

  if(!isset($data)){
    echo form_open('/product/add',$attributes);
  }else{
    echo form_open('/product/edit/'.$data[0]->product_id,$attributes);
  }

/*

'product_id'             =>  product code,
'product_unit'           =>  หน่วยนับ,
'product_name'           =>  ชื่อสินค้า,
'product_weight'         =>  น้ำหนักต่อชิ้น,
'product_type'           =>  ประเภท Product,
'product_family'           =>  family ของ Product,
'product_Desc'           =>  รายละเอียด,
'product_stock'          =>  จำนวนสินค้าใน Stock,
'product_safety'         =>  Safety Stock,
'product_cost'           =>  ต้นทุน,
'product_1stSalePrice'   =>  ราคาขายมือ1,
'product_2ndSalePrice'   =>  ราคาขายมือ2,
'product_d_RentalPrice'  =>  ราคาเช่ารายวัน,
'product_GuaranteePrice' =>  ราคาค้ำประกัน,
'product_Attr'           => คุณลักษณะสินค้า,
'product_stock_date'     => วันที่ตรวจนับสินค้า,


// Validate

// product_weight

*/

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


            echo form_label('product code *')
                .form_input('product_id',$product_id,'readonly data-parsley-required');
            echo form_label('หน่วยนับ *')
                .form_input('product_unit',$product_unit,'data-parsley-required');
          }else{
            echo form_label('product code *')
                .form_input('product_id','','data-parsley-required');
            echo form_label('หน่วยนับ *')
                .form_input('product_unit','','data-parsley-required');
          }
        ?>

          </div>
          <div class="large-6 columns">

        <?php

          $input_number = array(
              'type' => 'number',
              'name' => 'product_weight',
              'value' => (isset($data))? $data[0]->product_weight: 0,
              'class' => 'input-group-field'
            );

          if(isset($data)){
            //Assign Variable
            $product_name = $data[0]->product_name;
            $product_weight = $data[0]->product_weight;


            echo form_label('ชื่อสินค้า *')
                .form_input('product_name',$product_name,'data-parsley-required');
            echo form_label('น้ำหนักต่อชิ้น')
                .'<div class="input-group">'
                .form_input($input_number).'<span class="input-group-label">kg</span>
                  </div>';
          }else{
            echo form_label('ชื่อสินค้า *')
                .form_input('product_name','','data-parsley-required');
            echo form_label('น้ำหนักต่อชิ้น')
                .'<div class="input-group">'
                .form_input($input_number).'<span class="input-group-label">kg</span>
                  </div>
            ';
          }
        ?>
          </div>                                                                     
        </div>

<hr />

        <div class="row">
          <h5>รายละเอียด Product *</h5>
          <div class="large-6 columns">

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
            echo form_label('ประเภท Product *')
                .form_dropdown('product_type',$options,$product_type);
          }else{
            echo form_label('ประเภท Product *')
                .form_dropdown('product_type',$options);
          }

        ?>

          </div>
          <div class="large-6 columns">
        <?php
          if(isset($data)){
            //Assign Variable
            $product_family = $data[0]->product_family;

            echo form_label('Family ของ Product')
                .form_input('product_family',$product_family,'data-parsley-required');
          }else{
            echo form_label('Family ของ Product')
                .form_input('product_family','','data-parsley-required');
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

            echo form_label('รายละเอียด')
                .form_textarea('product_Desc',$product_Desc);
          }else{
            echo form_label('รายละเอียด')
                .form_textarea('product_Desc');
          }

        ?>

          </div>
        </div>

        <div class="row">
          <div class="large-6 columns">

        <?php

          $product_stock = array(
            'type' => 'number',
            'name' => 'product_stock',
            'value' => (isset($data))? $data[0]->product_stock: 0
          );
          $product_safety = array(
            'type' => 'number',
            'name' => 'product_safety',
            'value' => (isset($data))? $data[0]->product_safety: 0
          );

          if(isset($data)){
            echo form_label('จำนวนสินค้าใน Stock')
                .form_input($product_stock);
            echo form_label('Safety Stock')
                .form_input($product_safety);
          }else{
            echo form_label('จำนวนสินค้าใน Stock')
                .form_input($product_stock);
            echo form_label('Safety Stock')
                .form_input($product_safety);
          }

        ?>
          </div>

          <div class="large-6 columns">
        <?php

          $product_stock_date = array(
            'type' => 'text',
            'value' => (isset($data))? $data[0]->product_stock_date: '',
            'name' => 'product_stock_date',
            'class' =>  'datepicker'
          );

          if(isset($data)){

            echo form_label('วันที่ตรวจนับสินค้า')
                .form_input($product_stock_date);
          }else{
            echo form_label('วันที่ตรวจนับสินค้า')
                .form_input($product_stock_date);
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
              
              if(isset($data[0]->product_Attr)){

                $a = json_decode($data[0]->product_Attr);

                foreach ($a as $row) {
                  $i++;
                  echo '
                    <tr>
                      <td>'.$i.'</td>
                      <td><input type="text" id="product_AttrName" name="product_Attr['.$i.'][Name]" value="'.$row->Name.'" placeholder="คุณลักษณะ"></td>
                      <td><input type="text" id="product_AttrDesc" name="product_Attr['.$i.'][Desc]" value="'.$row->Desc.'"  placeholder="รายละเอียด"></td>
                      <td><a class="Del_Product_row">Delete</a></td>
                    </tr>
                  ';
                }
              }else{
                $i++;
                echo '
                  <tr>
                    <td>'.$i.'</td>
                    <td><input type="text" id="product_AttrName" name="product_Attr['.$i.'][Name]" placeholder="คุณลักษณะ"></td>
                    <td><input type="text" id="product_AttrDesc" name="product_Attr['.$i.'][Desc]" placeholder="รายละเอียด"></td>
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