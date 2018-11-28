<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/libs/select2/dist/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<style type="text/css">
    #profile_pic {
        width: 100px;
    }
</style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title"><?php echo $title; ?></h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="<?php echo base_url($this->uri->segment(1)); ?>"><?php echo ucfirst($this->uri->segment(1)); ?> </a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
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
        <div class="col-md-8">
                <div class="card">
                    <?php  echo form_open_multipart(base_url().'employees/employee_detail', array('id'=>'form-price', 'class'=>'form-horizontal', 'name'=>'form_employee', 'method'=>'post')) ?>
                        <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
                        <div class="card-body">
                            <h4 class="card-title">Personal Info</h4>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="emp_name" name="emp_name" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->employee_name; } ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="emp_username" name="emp_username" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->employee_username; } ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="emp_address" name="emp_address" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->employee_address; } ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="emp_phone" name="emp_phone" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->employee_phone; } ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Birth Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" name="birth_date" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->employee_birth; } ?>" disabled>
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Start Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="datepicker-autoclose2" placeholder="mm/dd/yyyy" name="start_date" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->employee_start; } ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Picture</label>
                                <div class="col-sm-9">
                                    <img id="profile_pic" alt="profile_pic" class="img-responsive radius" src="<?php if(is_numeric($this->uri->segment(3))) { echo base_url($value->employee_picture);} ?>">
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">ID Card Scan</label>
                                <div class="col-sm-9">
                                    <img id="profile_pic" alt="profile_pic" class="img-responsive radius" src="<?php if(is_numeric($this->uri->segment(3))) { echo base_url($value->employee_idcard);} ?>">
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Academic Certificate</label>
                                <div class="col-sm-9">
                                    <img id="profile_pic" alt="profile_pic" class="img-responsive radius" src="<?php if(is_numeric($this->uri->segment(3))) { echo base_url($value->employee_certificate);} ?>">
                                	
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Position</label>
                                <div class="col-sm-9">
                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="emp_position" disabled>

                                        <?php foreach ($positions as $position) { ?>
                                            <option value="<?php echo $position->position_id;?> "> <?php echo $position->position_name; ?></option>
                                        <?php } ?>
                                            
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email1" class="col-sm-3 text-right control-label col-form-label">Salary</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="emp_salary" name="emp_salary" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->employee_salary; } ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="emp_status" name="emp_status" value="<?php if(is_numeric($this->uri->segment(3))) { if($value->employee_status == '1') echo "Active"; 
																else {echo "Not Active"; } } ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="button" class="btn btn-info" onClick="return redirect('<?php echo base_url();?>reports/index');">Close</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        <!-- Column -->
 	</div>
</div>

<script src="<?php echo base_url(); ?>assets/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/libs/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/libs/jquery.currency/jquery.currency.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>

    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();
    $(".select2").select2();
	
	function redirect(url){
		window.location.href = url;
		return false;
	}

   jQuery('.mydatepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
    });
	jQuery('#datepicker-autoclose2').datepicker({
        autoclose: true,
        todayHighlight: true,
    });

</script>
