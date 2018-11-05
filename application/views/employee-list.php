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
                       <li class="breadcrumb-item"><a href="<?php echo base_url('employees/employee_form'); ?>" type="button" class="btn btn-success">Add New Employee</button></a></li>
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
                                <th>Name</th>
                                <th>Position</th>
                                <th>Birth</th>
                                <th>Start date</th>
                                <th>Salary</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =1;  foreach ($joined_values as $value) { ?>
                                
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->employee_name; ?></td>
                                    <td><?php echo $value->position_name; ?></td>
                                    <td><?php echo date("F j, Y", strtotime($value->employee_birth)); ?></td>
                                    <td><?php echo $value->employee_birth; ?></td>
                                    <td><span class="salary"><?php echo $value->employee_salary; ?></span></td>
                                    <td><span class="salary"><?php 
																if($value->employee_status == '1') echo "<span style='color: green;'> Active </span>"; 
																else {echo "<span style='color: red;'> Not Active </span>"; }
                                                            ?>
                                    </span></td>

                                    <td><span class="salary"><a href="<?php echo base_url('/employees/employee_form/').$value->employee_id; ?>">

                                        <button type="button" class="btn btn-warning">Edit</button></a></span>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Delete</button>
                                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(70px, -204px, 0px);">
                                            <?php 
												if($value->employee_status == "0"){ ?>
												<a class="dropdown-item" href="#" onclick="activate('<?php echo $value->employee_id; ?>')">Active</a>
											<?php } ?>
											<?php 
												if($value->employee_status == "1"){ ?>
												<a class="dropdown-item" href="#" onclick="deactivate('<?php echo $value->employee_id; ?>')">Deactive</a>
											<?php } ?>
												
                                                <a class="dropdown-item" href="#" class="delete" onclick="remover('<?php echo $value->employee_id; ?>')">Permanently Delete</a>
                                            </div>
                                        </div>

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
    $('.salary').currency({ region: "IDR", decimals: 0, thousands: "." }); 


   
	
	// $(".activate_emp").click(function(id){
 //        if (confirm("Are you sure?")) {
            
 //            $.post( "<?php echo base_url();?>employees/activation/1/"+id).done(function( data ) {
 //                window.location.reload();
 //            });

 //        }
 //        return false;
	// });
	
	// $(".deactivate_emp").click(function(id){
 //        if (confirm("Are you sure?")) {
            
 //            $.post( "<?php echo base_url();?>employees/activation/0/"+id).done(function( data ) {
 //                window.location.reload();
 //            });

 //        }
 //        return false;
	// });

    function activate(id) {
        if (confirm("Are you sure?")) {
            
            $.post( "<?php echo base_url();?>employees/activation/1/"+id).done(function( data ) {
                window.location.reload();
            });

        }
        return false;

    }
	
	
 function deactivate(id) {
        if (confirm("Are you sure?")) {
            
            $.post( "<?php echo base_url();?>employees/activation/0/"+id).done(function( data ) {
                window.location.reload();
            });

        }
        return false;

    }

    function remover(id) {
        if (confirm("Are you sure?")) {
            
            $.post( "<?php echo base_url();?>employees/delete/"+id).done(function( data ) {
                window.location.reload();
            });

        }
        return false;

    }

</script>
