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
                                <th>Claim Title</th>
                                <th>Date</th>
                                <th>Picture</th>
                                <th>Description</th>
                                <th>Status</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =1;  foreach ($joined_values as $value) { ?>
                                
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->employee_name; ?></td>
                                    <td><?php echo $value->claim_title; ?></td>
                                    <td><?php echo date("F j, Y", strtotime($value->claim_date)); ?></td>
									<td><img height="100px" src="<?php echo $value->claim_picture; ?>"></td>
                                    <td><?php echo $value->claim_description; ?></td>
									<td><span class="salary"><?php 
                                                                    if($value->claim_status == '1') {
                                                                        echo "<span style='color: green;'> Approved </span>"; 
                                                                    } elseif($value->claim_status == '0')  { 
                                                                        echo "<span style='color: red;'> Rejected </span>"; 
                                                                    } elseif($value->claim_status == '2')  { 
                                                                        echo "<span style='color: orange;'> Waiting Approval </span>"; 
                                                                    } else {
                                                                        echo "<span style='color: silver; font-style:italic;'> Finished </span>"; 
                                                                    }
                                                            ?>
                                    </span></td>
									<td>
										<a href="<?php echo base_url('claims/claim_detail/').$value->claim_id; ?>" type="button" class="btn btn-info">View Detail</button></a>
									
										<?php if($value->claim_status != 1 ) { ?>
                                                
                                                <button type="button" class="btn btn-success" onclick="setApproved('<?php echo $value->claim_id; ?>')">Approve</button>

                                        <?php } ?>
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
<div class="modal fade" id="RejectionReason" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rejection Reason </h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('claims/claim_approval'); ?>" method="post">
                    
                    <div class="form-group row">
                        <label for="position_name" class="col-sm-3 text-right control-label col-form-label">Reason</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="detail_claim_message" name="rejection_reason"></textarea>
                        </div>
                    </div>

                    <input type="hidden" id="reject_id_claim" name="id" value="">
                    <input type="hidden" id="claim_status" name="claim_status" value=0>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Reject</button>
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
            
            $.post( "<?php echo base_url();?>claims/delete/"+id).done(function( data ) {
                window.location.reload();
            });

        }
        return false;

    }
	
	function setApproved(id) {

        $.post( "<?php echo base_url();?>claims/claim_approval", { claim_status: "1", id: id}).done(function( data ) {
            window.location.reload();
        });
    }

</script>
