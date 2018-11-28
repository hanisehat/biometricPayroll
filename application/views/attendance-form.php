<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/libs/select2/dist/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/libs/bootstrap-datetimepicker/dist/css/bootstrap-datetimepicker.min.css">


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
                    <?php  echo form_open_multipart(base_url().'attendances/update_attendance', array('id'=>'form-price', 'class'=>'form-horizontal', 'name'=>'form_attendance', 'method'=>'post')) ?>
                        <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
                        <div class="card-body">
                            <h4 class="card-title">Personal Info</h4>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Employee ID</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="attendance_name" name="attendance_name" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->attendance_employee; } ?>" >
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Check in</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="check-in" name="attendance_in" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->attendance_in; } ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Check Out</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="check-out" name="attendance_out" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->attendance_out; } ?>">
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="<?php echo base_url(); ?>assets/assets/libs/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/libs/bootstrap-datetimepicker/dist/js/bootstrap-datetimepicker.min.js"></script>
<script>

    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();
    $(".select2").select2();
	
	$(function (){
		$('#check-in').datetimepicker();
		$('#check-out').datetimepicker();
	});

/*	jQuery('.mydatepicker').datepicker();
    jQuery('#check-in').datepicker({
        autoclose: true,
        todayHighlight: true,
		locale: 'ru'
    });
	jQuery('#check-out').datepicker({
        autoclose: true,
        todayHighlight: true,
		locale: 'ru'
    }); */

</script>
