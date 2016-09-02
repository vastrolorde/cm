<?php
echo '
<thead>
<tr>
  <th>รหัสสินค้า</th>
  <th width="10%">จำนวน</th>
  <th>ค่าเช่า</th>
  <th>รวมค่าเช่า</th>
  <th>ค้ำประกัน</th>
  <th>รวมค้ำประกัน</th>
  <th>Action</th>
</tr>
</thead>
<tbody>';
$grand_total = 0;
$daily_rental = 0;
$total_guarantee = 0;

foreach($rental_tr as $row)
{
  $duration = 1;
  $rental = $row->product_d_RentalPrice * $row->amount * $duration;
  $guarantee = $row->product_GuaranteePrice * $row->amount;

  echo '
  <tbody>
    <tr>
      <td><p>
        <span data-tooltip aria-haspopup="true" class="has-tip right" data-disable-hover="false" tabindex="1" title="'.$row->product_name.'" >'.$row->product_id.'</span>
          </p>
      </td>
      <td><input type="number" name="amount" id="amount" value="'.$row->amount.'" readonly /></td>
      <td>'.$row->product_d_RentalPrice.'</td>
      <td>'.$rental.'</td>
      <td>'.$row->product_GuaranteePrice.'</td>
      <td>'.$guarantee.'</td>
      <td><a href="#" class="edit" id="'.$row->id.'">Edit</a> |<a href="#" class="DeltransactionRow" id="'.$row->id.'">Delete</a></td>
    </tr>
  ';

  $daily_rental += $rental;
  $total_guarantee += $guarantee;
  $grand_total += $subtotal;
}

echo '</tbody>';

  $daily_rental_input = array(
      'type' => 'text',
      'name' => 'daily_rental',
      'value' => $daily_rental,
      'id' => 'daily_rental',
      'readonly' => 'true'
    );

  $total_guarantee_input = array(
      'type'     => 'text',
      'name'     => 'total_guarantee',
      'value'    => $total_guarantee,
      'id'       => 'total_guarantee',
      'readonly' => 'true'
    );

    $total_rental = array(
      'type'  => 'number',
      'name'  => 'total_rental',
      'id'    => 'total_rental'
    );

    $discount = array(
      'type'  => 'number',
      'name'  => 'discount',
      'id'    => 'discount'
    );

    $subtotal = array(
      'type'  => 'number',
      'name'  => 'subtotal',
      'id'    => 'subtotal',
      'readonly' => 'true'
    );
    
    $VATType = array(
      '0'    => '0%',
      '0.07' => '7%',
    );
    
    $VAT = array(
      'type'     => 'text',
      'name'     => 'VAT',
      'id'       => 'VAT',
      'readonly' => 'true'
    );

    $grandtotal = array(
      'type'     => 'text',
      'name'     => 'grandtotal',
      'id'       => 'grandtotal',
      'readonly' => 'true'
    );
    
    $label = array(
      'class' => "text-right middle"
    );

echo '
  <tfoot>
    <tr>
      <td colspan="3" class="text-right">รวมค่าเช่า/วัน</td>
      <td>'.form_input($daily_rental_input).'</td>
      <td class="text-right">รวมค้ำฯ/สัญญา</td>
      <td>'.form_input($total_guarantee_input).'</td>
      <td colspan="2"></td>
    </tr>

    <tr>
      <td colspan="3" class="text-right">รวมค่าเช่าตลอดระยะเวลาสัญญา</td>
      <td>'.form_input($total_rental).'</td>
      <td colspan="4"></td>
    </tr>
    <tr>
      <td colspan="3" class="text-right">ส่วนลด</td>
      <td>'.form_input($discount).'</td>
      <td colspan="4"></td>
    </tr>
    <tr>
      <td colspan="3" class="text-right">สุทธิก่อน VAT</td>
      <td>'.form_input($subtotal).'</td>
      <td colspan="4"></td>
    </tr>
    <tr>
      <td colspan="2" class="text-right">ภาษีมูลค่าเพิ่ม</td>
      <td>'.form_dropdown('VATType',$VATType,'','id="VATType"').'</td>
      <td>'.form_input($VAT).'</td>
      <td colspan="4"></td>
    </tr>
    <tr>
      <td colspan="3" class="text-right">สุทธิ</td>
      <td>'.form_input($grandtotal).'</td>
      <td colspan="4"></td>
    </tr>
  </tfoot>
  ';
?>