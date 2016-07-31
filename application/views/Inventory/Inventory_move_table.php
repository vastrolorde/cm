              <?php
                echo '
              <thead>
                <tr>
                  <th>รหัสสินค้า</th>
                  <th width="30%">รายการสินค้า</th>
                  <th width="10%">นน. ต่อชิ้น</th>
                  <th width="10%">จำนวน</th>
                  <th>นน. รวม</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>';
                $grand_total = 0;

                foreach($invent_tr as $row)
                {
                  $total_weight = $row->product_weight*$row->amount;
              
                  echo '
                  <tbody>
                    <tr>
                      <td>'.$row->product_id.'</td>
                      <td>'.$row->product_name.'</td>
                      <td>'.$row->product_weight.'</td>
                      <td><input type="number" name="amount" value="'.$row->amount.'" readonly /></td>
                      <td class="total_weight">'.$total_weight.'</td>
                      <td><a href="#" class="edit" id="'.$row->id.'">Edit</a> |<a href="#" class="DeltransactionRow" id="'.$row->id.'">Delete</a></td>
                    </tr>
                  ';

                  $grand_total += $total_weight;
                }

                echo '</tbody>';

                echo '
                  <tfoot>
                    <tr>
                      <td colspan="4" class="text-right">น้ำหนักรวม</td>
                      <td>'.$grand_total.'</td>
                      <td>kg</td>
                    </tr>
                  </tfoot>
                  ';
              ?>