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
                       <li class="breadcrumb-item"><a href="<?php echo base_url('leaves_emp/leave_form/'.$this->session->user_id); ?>" type="button" class="btn btn-success">Request New Leave</button></a></li>
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
                                <th>Start date</th>
                                <th>End date</th>
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
                                    <td><?php echo $value->leave_date_start; ?></td>
                                    <td><?php echo $value->leave_date_end; ?></td>
                                    <td><span class="salary"><?php 
                                                                    if($value->leave_status == '1') {
                                                                        echo "<span style='color: green;'> Approved </span>"; 
                                                                    } elseif($value->leave_status == '0')  { 
                                                                        echo "<span style='color: red;'> Rejected </span>"; 
                                                                    } elseif($value->leave_status == '2')  { 
                                                                        echo "<span style='color: orange;'> Waiting Approval </span>"; 
                                                                    } else {
                                                                        echo "<span style='color: silver; font-style:italic;'> Finished </span>"; 
                                                                    }
                                                            ?>
                                    </span></td>

                                    <td>

                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#Modal2" onclick="getLeave('<?php echo $value->leave_id; ?>')">Edit</button>
										<button type="button" class="btn btn-danger delete" onclick="remover('<?php echo $value->leave_id; ?>')">Delete</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Update Leave</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('leaves_emp/leave_update'); ?>" method="post">
                    
                    <div class="form-group row">
                        <label for="position_name" class="col-sm-3 text-right control-label col-form-label">Employee Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detail_employee_name" name="emp_name" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->employee_name; } ?>">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="position_name" class="col-sm-3 text-right control-label col-form-label">Leave Start</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detail_leave_start" name="leave_date_start" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->leave_date_start; } ?>">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="position_name" class="col-sm-3 text-right control-label col-form-label">Leave End</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detail_leave_end" name="leave_date_end" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->leave_date_end; } ?>">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="position_name" class="col-sm-3 text-right control-label col-form-label">Reason</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="detail_leave_reason" name="leave_message" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->leave_message; } ?>"></textarea>
                        </div>
                    </div>

                    <input type="hidden" id="id_employee" name="employee_id">
					<input type="hidden" id="id_leave" name="id">
					<input type="hidden" id="leave_status" name="leave_status">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
             </form>
        </div>
    </div>
</div>


<script src="<?php echo base_url(); ?>assets/assets/extra-libs/DataTables/datatables.min.js"></script>


<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();

    function getLeave(id) {
        
        $.get( "<?php echo base_url();?>leaves_emp/get_detail/"+id).done(function( data ) {
            var leaveData = JSON.parse(data);

            //leave detail
            $('#detail_employee_name').val(leaveData.employee_name);
            $('#detail_leave_start').val(leaveData.leave_date_start);
            $('#detail_leave_end').val(leaveData.leave_date_end);
            $('#detail_leave_reason').val(leaveData.leave_message);
			$('#id_employee').val(leaveData.leave_employee);
			$('#id_leave').val(leaveData.leave_id);
			$('#leave_status').val(leaveData.leave_status);
            
            //reject
            $('#reject_id_leave').val(leaveData.leave_id);

            //reject
            $('.approve_button').val(leaveData.leave_id);

            var rejectButton = "<button type='button' class='btn btn-danger'  data-dismiss='modal' data-toggle='modal' data-target='#RejectionReason'>Reject</button>";
            var approveButton = "";
            
            if(leaveData.leave_status != 0)  {
                $('.reject_button').html(rejectButton);
                $('.approve_button').hide();
            } else {
                $('.approve_button').show();
            }
          //  console.log(leaveData);

        });

    }
	
	function remover(id) {
        if (confirm("Are you sure?")) {
            
            $.post( "<?php echo base_url();?>leaves_emp/delete/"+id).done(function( data ) {
                window.location.reload();
            });

        }
        return false;

    }

    // function setApproved(id) {

        // $.post( "<?php echo base_url();?>leaves/leave_approval", { leave_status: "1", id: id}).done(function( data ) {
            // window.location.reload();
        // });
    // }


</script>
