
      </div>
    </div>
   </div>
  </body>
</html>

    <script src="<?php echo asset_url().'bower/jquery/dist/jquery.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/jquery-ui/jquery-ui.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/foundation-sites/dist/foundation.min.js'; ?>"></script>
    <script src="<?php echo asset_url().'bower/foundation-sites/js/foundation.accordion.js'; ?>"></script>
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
	</script>