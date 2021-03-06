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
                    <?php  echo form_open_multipart(base_url().'claims/claim_detail', array('id'=>'form-price', 'class'=>'form-horizontal', 'name'=>'form_claim', 'method'=>'post')) ?>
                        <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
                        <div class="card-body">
                            <h4 class="card-title">Personal Info</h4>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Employee ID</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="c_user" name="c_user" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->claim_user; } ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Claim Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="c_title" name="c_title" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->claim_title; } ?>" disabled>
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Claim Date</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy" name="c_date" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->claim_date; } ?>" disabled>
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Picture</label>
                                <div class="col-sm-9">
                                    <img id="claim_pic" alt="claim_pic" height="100px" class="img-responsive radius" src="<?php if(is_numeric($this->uri->segment(3))) { echo base_url($value->claim_picture);} ?>">
                                    
                                </div>
                            </div>
							<div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="desc" name="desc" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->claim_description; } ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="button" class="btn btn-info" onClick="return redirect('<?php echo base_url();?>claims');">Close</button>
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
	
</script>
