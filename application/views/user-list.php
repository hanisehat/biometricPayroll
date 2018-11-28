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
                       <li class="breadcrumb-item"><a href="<?php echo base_url('users/new_user'); ?>" type="button" class="btn btn-success">Add New User</button></a></li>
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
                                <th>Username</th>
                                <th>Email</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =1;  foreach ($joined_values as $value) { ?>
                                
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->name; ?></td>
									<td><?php echo $value->username; ?></td>
                                    <td><?php echo $value->email; ?></td>
                                    <td>
										<a href="<?php echo base_url('/users/new_user/').$value->user_id; ?>">
                                        <button type="button" class="btn btn-warning">Edit</button></a>
										<button type="button" class="btn btn-danger delete" onclick="remover('<?php echo $value->user_id; ?>')">Delete</button>

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


<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();
	
	function remover(id) {
        if (confirm("Are you sure?")) {
            
            $.post( "<?php echo base_url();?>users/delete/"+id).done(function( data ) {
                window.location.reload();
            });

        }
        return false;

    }
</script>
