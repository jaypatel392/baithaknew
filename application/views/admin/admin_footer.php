	<!-- jQuery UI 1.10.3 -->
	<script src="<?php echo base_url();?>webroot/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url();?>webroot/admin/js/bootstrap.min.js" type="text/javascript"></script>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<!--<script src="<?php echo base_url();?>webroot/admin/js/plugins/morris/morris.min.js" type="text/javascript"></script>-->	
	<!-- AdminLTE App -->
	<script src="<?php echo base_url();?>webroot/admin/js/AdminLTE/app.js" type="text/javascript"></script>	
	<!-- bootbox.min.js -->	
	<script src="<?php echo base_url();?>webroot/admin/js/bootbox.min.js" type="text/javascript"></script>
	<!-- Data Table -->
	<script src="<?php echo base_url();?>webroot/admin/js/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>webroot/admin/js/datatables/dataTables.bootstrap.min.js"></script>
	<!-- date time picker -->
	<script type="text/javascript" src="<?php echo base_url(); ?>webroot/admin/js/cal/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>webroot/admin/js/cal/bootstrap-datetimepicker.min.js"></script>
	<script>
	$(function () {
		
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			 "scrollX": true
		});
	});
	</script>
	<!-- Common for all -->
	<script type="text/javascript">
		/****************************** Error Massage Auto Hide***********************************/
		$("#msg_div").fadeOut(10000);			
	</script>

	<!--added by kpl-->		
	<script type="text/javascript" src="<?php echo base_url();?>webroot/admin/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({
			selector: "textarea#help_page_description,#legal_page_description",
			//you can add multiple plugins here from plugin folder
			plugins :"advlist autolink link image lists charmap print preview code fullscreen textcolor table media",
			tools: "inserttable",	
			relative_urls: false,
			toolbar: [ "undo redo | styleselect | bold italic | link image | bullist numlist outdent indent | alignleft aligncenter alignright alignjustify  forecolor backcolor", ]
		});
	</script>
	<!--//added by kpl-->
    </body>
</html>