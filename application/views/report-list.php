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
                       <li class="breadcrumb-item"><a href="<?php echo base_url('reports/report_form/'.$this->session->user_id); ?>" type="button" class="btn btn-success">Add New Report</button></a></li>
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
								<th>Start Date</th>
                                <th>Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i =1;  foreach ($joined_values as $value) { ?>
                                
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value->employee_name; ?></td>
									<td><?php echo $value->employee_start; ?></td>
                                    <td><?php echo $value->employee_salary; ?></td>
                                    <td>

                                        <a href="<?php echo base_url('employees/employee_detail/').$value->employee_id; ?>" type="button" class="btn btn-info">View Detail</button></a>
										<button type="button" class="btn btn-danger delete" onclick="remover('<?php echo $value->report_id; ?>')">Delete</button>

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
                <h5 class="modal-title" id="exampleModalLabel">Report Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('report/report_view'); ?>" method="post">
                    
                    <div class="form-group row">
                        <label for="position_name" class="col-sm-3 text-right control-label col-form-label">Employee Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detail_employee_name" name="employee_name" disabled="disabled">
                        </div>
                    </div> 
					<div class="form-group row">
                        <label for="position_name" class="col-sm-3 text-right control-label col-form-label">Start Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detail_employee_start" name="employee_start" disabled="disabled">
                        </div>
                    </div>
					<div class="form-group row">
                        <label for="position_name" class="col-sm-3 text-right control-label col-form-label">Employee Salary</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="detail_employee_salary" name="employee_salary" disabled="disabled">
                        </div>
                    </div> 
                    

                    <input type="hidden" id="report_id" name="id" value="">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
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

    function getReport(id) {
        
        $.get( "<?php echo base_url();?>reports/get_detail/"+id).done(function( data ) {
            var reportData = JSON.parse(data);

            //report detail
            $('#detail_employee_name').val(reportData.employee_name);
			$('#detail_employee_salary').val(reportData.employee_salary);
			$('#detail_employee_start').val(reportData.employee_start);

        });

    }
	
	function remover(id) {
        if (confirm("Are you sure?")) {
            
            $.post( "<?php echo base_url();?>reports/delete/"+id).done(function( data ) {
                window.location.reload();
            });

        }
        return false;

    }


</script>
