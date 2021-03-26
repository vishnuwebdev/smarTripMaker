<script type="text/javascript"
	src="<?php echo site_url(); ?>assets/vendor/plugins/datatables/media/js/jquery.dataTables.js"></script>
<!-- Datatables Tabletools addon -->
<script type="text/javascript"
	src="<?php echo site_url(); ?>assets/vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<!-- Datatables Editor addon - READ LICENSING NOT MIT  -->
<script type="text/javascript"
	src="<?php echo site_url(); ?>assets/vendor/plugins/datatables/extensions/Editor/js/dataTables.editor.js"></script>

<!-- Datatables Bootstrap Modifications  -->
<script type="text/javascript"
	src="<?php echo site_url(); ?>assets/vendor/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script type="text/javascript"
	src="<?php echo site_url(); ?>assets/vendor/plugins/datatables/extensions/Editor/js/editor.bootstrap.js"></script>
<script>
$('.bp_table').dataTable({
    "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
    "bPaginate": false,
    "autoWidth": false,
    "ordering": false
});
</script>