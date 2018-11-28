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
                <?php  echo form_open_multipart(base_url().'users/update_user', array('id'=>'form-price', 'class'=>'form-horizontal', 'name'=>'form_user', 'method'=>'post')) ?>
                        <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
                    <div class="card-body">
                        <h4 class="card-title">Personal Info</h4>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="username" name="username" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->username; } ?>" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->name; } ?>">
                            </div>
                        </div>
                        
						<?php if (is_numeric($this->uri->segment(3))) { ?>
                            
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                <div class="col-sm-3"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal2" >Update Password</button></div>
                            </div>
                            
                            <?php } else { ?>

                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>

                            <?php } ?>

						
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email"  name="email" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->email; } ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Role</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="role" name="role" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->role; } ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 text-right control-label col-form-label">Status</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="status" name="status" value="<?php if(is_numeric($this->uri->segment(3))) { echo $value->status; } ?>">
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

<!-- Modal -->
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('users/update_password'); ?>" method="post">
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 text-right control-label col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="update_position_name" placeholder="" name="password">
                        </div>
                    </div>
                    <input type="hidden" id="id_update_position" name="id" value="<?php echo $this->uri->segment(3); ?>">
               
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


<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();
</script>
