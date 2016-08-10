
      </div>
    </div>
   </div>
  </body>
</html>
    <script type="text/javascript">
		$(document).foundation();
     
  $(function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'dd/mm/yy'
      });
  });

      // Alert Popup
    $('.delitem').click(function (){
       var answer = confirm("คุณต้องการลบหรือไม่?");
          if (answer) {
             return true;
          }else{
             return false;
          }
    });

  var timestamp = moment();
    $('.timestamp').val(timestamp.format('DD/MM/YYYY hh:mm'));
	</script>

  