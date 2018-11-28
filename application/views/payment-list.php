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
                       <li class="breadcrumb-item"><button type="button" class="btn btn-success"  data-toggle="modal" data-target="#new_position">Add New Payment</button></li>
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
                                <th>Type of Payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =1;  foreach ($values as $value) { ?>
                                
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->payment_type; ?></td>

                                    <td><span class="salary">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Modal2" onclick="getValue('<?php echo $value->payment_id; ?>', '<?php echo $value->payment_type; ?>')">Edit</button></span>
                                        <button type="button" class="btn btn-danger delete" onclick="remover('<?php echo $value->payment_id; ?>')">Delete</button>
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

 <!-- Modal -->
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form action="<?php echo base_url('payments/add'); ?>" method="post">
	                <div class="form-group row">
	                    <label for="payment_type" class="col-sm-3 text-right control-label col-form-label">Payment Type</label>
	                    <div class="col-sm-9">
	                        <input type="text" class="form-control" id="update_payment_type" placeholder="Payment Type" name="payment_type">
	                    </div>
	                </div>
	                <input type="hidden" id="id_update_payment" name="id">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
             </form>
        </div>
    </div>
</div>

 <!-- Modal -->
<div class="modal fade" id="new_position" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<form action="<?php echo base_url('payments/add'); ?>" method="post">
	                <div class="form-group row">
	                    <label for="payment_type" class="col-sm-3 text-right control-label col-form-label">Payment Type</label>
	                    <div class="col-sm-9">
	                        <input type="text" class="form-control" id="payment_type" placeholder="Payment Type" name="payment_type">
	                    </div>
	                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            	</form>
        </div>
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
            
            $.post( "<?php echo base_url();?>payments/delete/"+id).done(function( data ) {
                window.location.reload();
            });

        }
        return false;

    }

    function getValue(id, data)
    {
    	$("#update_payment_type").val(data);
    	$("#id_update_payment").val(id);
    	
    }

</script>
