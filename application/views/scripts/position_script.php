<script type="text/javascript">
	$(document).ready(function(){

	// Autocomplete

		//หาหัวหน้า
		$("input[name='position_manager']").autocomplete({
			source: function(request, response) {
				$.ajax({
					url: "<?php echo site_url().'/HR/position/lookup_manager'; ?>",
					data: {
						lookup:	$("input[name='position_manager']").val()
					},
					dataType: "json",
					type: "POST",
					success: function (data) {
		                response($.map(data,function (value) {
		                    return {
								'label': value.position_name,
								'value': value.position_name
		                    };
		            	}))


		                	console.log(data);
		            }
				});
			},
			minLength: 3
		});

	});

// Google Chart

	google.charts.load('current', {packages:["orgchart"]});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Name');
		data.addColumn('string', 'Under');

		// For each orgchart box, provide the name, manager, and tooltip to show.
		<?php 
				$this->db->SELECT('*');
				$this->db->FROM('hr_position');
				$this->db->where('active','Y');
				$query = $this->db->get()->result();

				echo 'data.addRows([';

				foreach ($query as $row) {
					echo "[{v:'".$row->position_name."',f:'<big><strong>".$row->position_name."</strong></big><p>".$row->dept_id."</p>'},
					'".$row->position_manager."'],";
				}
				echo ']);';
		?>
		
		// Create the chart.
		var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
		// Draw the chart, setting the allowHtml option to true for the tooltips.
		var options = {
		  allowHtml:true
		};
		chart.draw(data,options);

	}
</script>
<style type="text/css">
	#chart_div table {
		border-collapse: separate;
	}
	#chart_div tr {
		background-color: white;
	}
	#chart_div td {
		-webkit-box-shadow: none;
  		-moz-box-shadow: none;
  		box-shadow: none;
	}
</style>