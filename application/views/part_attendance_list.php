<style type="text/css">
    #zero_config_filter {
        float: right !important;
    }
</style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title"><?php echo $title; ?></h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="<?php echo base_url('part_attendances/attendance_form'); ?>" type="button" class="btn btn-success">Add New Attendance</button></a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales Cards  -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
								<th>Name</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =1;  foreach ($joined_values as $value) { ?>
                                
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->attendance_timestamp; ?></td>
                                    <td><?php echo $value->employee_name; ?></td>
                                    <td><?php echo date("F j, Y H:i:s", strtotime($value->attendance_in)); ?></td>
                                    <td><?php echo date("F j, Y H:i:s", strtotime($value->attendance_out)); ?></td>

                                    <td><span class="salary"><a href="<?php echo base_url('/part_attendances/attendance_form/'.$value->attendance_id); ?>">
                                        <button type="button" class="btn btn-warning">Edit</button></a></span>
										<button type="button" class="btn btn-danger delete" onclick="remover('<?php echo $value->attendance_id; ?>')">Delete</button>
                                    </td>
                                </tr>

                            <?php $i++; } ?>
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
		</div>
        <!-- Column -->
 	</div>
</div>

<script src="<?php echo base_url(); ?>assets/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/libs/jquery.currency/jquery.currency.js"></script>


<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();
   

    function remover(id) {
        if (confirm("Are you sure?")) {
            
            $.post( "<?php echo base_url();?>part_attendances/delete/"+id).done(function( data ) {
                window.location.reload();
            });

        }
        return false;

    }

</script>
