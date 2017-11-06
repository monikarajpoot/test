<!-- Main Footer -->
<footer class="main-footer no-print">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        MPN
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017-2018 <a href="#"><?php echo SITE_NAME; ?></a></strong> All rights reserved.
</footer>
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.1.4 -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo ADMIN_THEME_PATH; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo ADMIN_THEME_PATH; ?>dist/js/app.min.js" type="text/javascript"></script>
<!--Text Slider-->
<script src="<?php echo ADMIN_THEME_PATH; ?>bootstrap/js/text_slider.js" type="text/javascript"></script>
<!--End Text Slider-->
<?php if ($this->uri->segment(1) == 'leave' || $this->uri->segment(2) == 'addleave' || $this->uri->segment(2) == 'add_leave') { ?>
    <!--- Leave Javascript -->
    <script src="<?php echo base_url(); ?>themes/leave.js" type="text/javascript"></script>
    <!-- END Leave Javascript-->
<?php } ?>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="<?php //echo ADMIN_THEME_PATH; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>-->
<script type="text/javascript" src="<?php echo ADMIN_THEME_PATH; ?>common_js/jquery-blink.js" type="text/javascript"></script>

<script src="<?php echo ADMIN_THEME_PATH; ?>bootstrap/js/multiselect_checkbox.js" type="text/javascript"></script>
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>

<link href="<?php echo ADMIN_THEME_PATH; ?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>	
<script type="text/javascript">
    $(function () {
        $('.date_picker').datepicker();
    });
    //auto focus search filed
    $(document).ready(function () {
        $(".input-sm").focus();
    });
    $(document).ready(function () {
        var myVar = setInterval(function(){ myTimer() }, 1000);
        function myTimer() {
            var d = new Date();
            var t = d.toLocaleTimeString();
            document.getElementById("counter").innerHTML = t;
        }
    });
    $(document).ready(function () {
        $('#leave_tbl, #dataTable').dataTable();
        $('.dataTable').dataTable();
        $('.blink').blink();
        $('.blink_fast').blink({
            delay: 300
        });
    });
    $(function () {
        //$("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
	
	 $(function () {
        //$("#example1").dataTable();
        $('#example3').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true
        });
    });

    $(function () {
        $("#admin_users_list").dataTable();
        $(document).ready(function () {
            $('#leave_employee').dataTable({
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/swf/copy_csv_xls_pdf.swf"
                }
            });

        });
        $('#admin_users_list').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });

</script>
</body>
</html>
