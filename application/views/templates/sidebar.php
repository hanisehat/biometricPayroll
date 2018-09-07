<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('dashboard'); ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('claims'); ?>" aria-expanded="false"><i class=" fas fa-hand-holding-usd"></i><span class="hide-menu">Claims</span></a></li>

                <?php // if ($this->session->priority < 4) { ?> 
                
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('leaves'); ?>" aria-expanded="false"><i class="mdi mdi-beach"></i><span class="hide-menu">Leaves</span></a></li>

                <?php // } ?>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('employees'); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employees</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-database"></i><span class="hide-menu">Data Manage </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?php echo base_url('positions'); ?>" class="sidebar-link"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu"> Job Positions </span></a></li>
                        <li class="sidebar-item"><a href="<?php echo base_url('positions'); ?>" class="sidebar-link"><i class="fas fa-heartbeat"></i><span class="hide-menu"> Basic Allowances </span></a></li>
                        <li class="sidebar-item"><a href="<?php echo base_url('users'); ?>" class="sidebar-link"><i class="fas fa-key"></i><span class="hide-menu"> User Admin </span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>