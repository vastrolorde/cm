          <thead>
            <tr>
              <th>date</th>
              <th>in</th>
              <th>out</th>
              <th>Diff</th>
              <th>type</th>
              <th>reason</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php
            foreach ($lve as $key) {

              echo '
              <tr>
                <td><input class="datepicker" name="lve_date" id="lve_date" type="text" value="'.$key["lve_date"].'" readonly></td>
                <td><input class="time"       name="lve_in"   id="lve_in"   type="text" value="'.$key["lve_in"].'" readonly></td>
                <td><input class="time"       name="lve_out"  id="lve_out"  type="text" value="'.$key["lve_out"].'" readonly></td>
                <td><input                    name="diff"     id="diff"     type="text" value="'.$key["lve_diff"].'" disabled></td>
                <td>'.$key["lve_type"].'</td>
                <td>'.$key["lve_reason"].'</td>
                <td><a href="#" class="edit" id="'.$key["id"].'">Edit</a> | <a href="#" class="delete" id="'.$key["id"].'">Delete</a></td>
              </tr>
              ';
            }
          ?>
          </tbody>