/*

	--CONTROLLER--
	
	ใส่บรรทัดนี้ใน controller
		$data['Province_all'] = $this->Province->province(); //Province Plugin

	--VIEWS--

	ใส่ <script src="<?php echo asset_url().'js/js_get_th.js'; ?>"></script> ลงบนหัวของไฟล์ใน folder views/scripts/...php

      <div class="row">
          <div class="large-6 columns">

        <?php

          $i = 0;
          foreach($Province_all as $key){
            $Province_list[$Province_all[$i]['Province_ID']] = $Province_all[$i]['Province_NAME'];

            $i++;
          }

          $subDist_list = array(
            'blank' => 'กรุณาเลือกแขวง/ตำบล'
            );

          if(isset($data)){
            //Assign Variable
            $add1 = $data[0]->add1;
            $SubDist = $data[0]->SubDist;
            $Province = $data[0]->Province;

            $SubDist_opt = array(
                'id' => 'SubDist',
                'sel' => $SubDist, // Used for get id value in js
              );

            echo form_label('ที่อยู่')
                .form_input('add1',$add1);
            echo form_label('แขวง/ตำบล')
                .form_dropdown('SubDist',$subDist_list,$SubDist,$SubDist_opt);
            echo form_label('จังหวัด')
                .form_dropdown('Province',$Province_list,$Province,'id="Province"');
          }else{
            echo form_label('ที่อยู่')
                .form_input('add1');
            echo form_label('แขวง/ตำบล')
                .form_dropdown('SubDist',$subDist_list,'','id="SubDist"');
            echo form_label('จังหวัด')
                .form_dropdown('Province',$Province_list,'','id="Province"');
          }
        ?>
          </div>
          <div class="large-6 columns">

        <?php
          
          $Dist_list = array(
            'blank' => 'กรุณาเลือกเขต/อำเภอ'
            );

          if(isset($data)){
            //Assign Variable
            $add2 = $data[0]->add2;
            $Dist = $data[0]->Dist;
            $Postal = array(
              'type'  => 'number',
              'name'  => 'Postal',
              'value' =>  $data[0]->Postal,
              'data-parsley-length' => '[5, 5]'
            );

            $Dist_opt = array(
                'id' => 'Dist',
                'sel' => $Dist,
              );

            echo form_label('ที่อยู่2')
                .form_input('add2',$add2);
            echo form_label('เขต/อำเภอ')
                .form_dropdown('Dist',$Dist_list,'',$Dist_opt);
            echo form_label('รหัสไปรษณีย์')
                .form_input($Postal);
          }else{
            $Postal = array(
              'type'  => 'number',
              'name'  => 'Postal',
              'value' =>  '00000',
              'data-parsley-length' => '[5, 5]'
            );
            echo form_label('ที่อยู่2')
                .form_input('add2');
            echo form_label('เขต/อำเภอ')
                .form_dropdown('Dist',$Dist_list,'','id="Dist"');
            echo form_label('รหัสไปรษณีย์')
                .form_input($Postal);
          }
        ?>

          </div>                                                                     
        </div>

*/
var distSelected = $('#Dist').attr('sel');
var SubDistSelected = $('#SubDist').attr('sel');

	$.ajax({
		url: "http://localhost/cm/index.php/settings/get_th/Dist",
		data: {
			Province : $('#Province').val()
		},
		dataType: "json",
		type: "POST",
		success: function (data) {
			console.log(data);

			// $('#Dist').find('option').remove().end();
			$.each(data,function(key,value){
				$('#Dist').append('<option value="'+value.Dist_ID+'">'+value.Dist_NAME+'</option>');
			});

			$('#Dist').val(distSelected);

		},
		error: function (request, status, error) {
			console.log(request);
			console.log(status);
			console.log(error);
		}
	});

	$.ajax({

		url: "http://localhost/cm/index.php/settings/get_th/SubDist",
		data: {
			Dist : $('#Dist').attr('sel')
		},
		dataType: "json",
		type: "POST",
		success: function (data) {
			console.log(data);

			// $('#SubDist').find('option').remove().end();
			$.each(data,function(key,value){
				$('#SubDist').append('<option value="'+value.SubDist_ID+'">'+value.SubDist_NAME+'</option>');
			});

			$('#SubDist').val(SubDistSelected);
		},
		error: function (request, status, error) {
			console.log(request);
			console.log(status);
			console.log(error);
		}

	});

//District Filter

$('#Province').on('change',function(){

	$.ajax({

		url: "http://localhost/cm/index.php/settings/get_th/Dist",
		data: {
			Province : $('#Province').val()
		},
		dataType: "json",
		type: "POST",
		success: function (data) {
			console.log(data);

			$('#Dist').find('option').remove().end();
			$.each(data,function(key,value){
				$('#Dist').append('<option value="'+value.Dist_ID+'">'+value.Dist_NAME+'</option>');
			});

		},
		error: function (request, status, error) {
			console.log(request);
			console.log(status);
			console.log(error);
		}

	});
});

//SubDistrict Filter
$('#Dist').on('change',function(){

	$.ajax({

		url: "http://localhost/cm/index.php/settings/get_th/SubDist",
		data: {
			Dist : $('#Dist').val()
		},
		dataType: "json",
		type: "POST",
		success: function (data) {
			console.log(data);

			$('#SubDist').find('option').remove().end();
			$.each(data,function(key,value){
				$('#SubDist').append('<option value="'+value.SubDist_ID+'">'+value.SubDist_NAME+'</option>');
			});

		},
		error: function (request, status, error) {
			console.log(request);
			console.log(status);
			console.log(error);
		}

	});

});