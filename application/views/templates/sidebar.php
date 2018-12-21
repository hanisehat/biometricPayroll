<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('dashboard'); ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('payments'); ?>" aria-expanded="false"><i class=" fas fa-hand-holding-usd"></i><span class="hide-menu">Payments</span></a></li>

                <?php // if ($this->session->priority < 4) { ?> 
                
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('leaves'); ?>" aria-expanded="false"><i class="mdi mdi-beach"></i><span class="hide-menu">Leaves</span></a></li>

                <?php // } ?>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('claims'); ?>" aria-expanded="false"><i class="fas fa-recycle"></i><span class="hide-menu">Reimbursement</span></a></li>

                <?php // } ?>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('employees'); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employees</span></a></li>
				
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-calendar-alt"></i><span class="hide-menu">Attendance</span></a>
						<ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?php echo base_url('full_attendances'); ?>" class="sidebar-link"><i class="far fa-calendar-alt"></i><span class="hide-menu">	Full Time	</span></a></li>
                        <li class="sidebar-item"><a href="<?php echo base_url('part_attendances'); ?>" class="sidebar-link"><i class="far fa-calendar-alt"></i><span class="hide-menu">	Part Time	</span></a></li>
                    </ul>
				</li>
				
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class='fas fa-donate'></i><span class="hide-menu">Salary</span></a>
						<ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?php echo base_url('salaries_full'); ?>" class="sidebar-link"><i class="fas fa-hand-holding-usd"></i><span class="hide-menu">	Full Time	</span></a></li>
                        <li class="sidebar-item"><a href="<?php echo base_url('salaries_part'); ?>" class="sidebar-link"><i class="fas fa-hand-holding-usd"></i><span class="hide-menu">	Part Time	</span></a></li>
                    </ul>
				</li>
				
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('bonuses'); ?>" aria-expanded="false"><i class="fa fa-plus"></i><span class="hide-menu">Bonus</span></a></li>
				
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('reports'); ?>" aria-expanded="false"><i class="fa fa-print"></i><span class="hide-menu">Report</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-database"></i><span class="hide-menu">Data Manage </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?php echo base_url('positions'); ?>" class="sidebar-link"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu"> Job Positions </span></a></li>
                        <li class="sidebar-item"><a href="<?php echo base_url('allowances'); ?>" class="sidebar-link"><i class="fas fa-heartbeat"></i><span class="hide-menu">  Allowances </span></a></li>
                        <li class="sidebar-item"><a href="<?php echo base_url('users'); ?>" class="sidebar-link"><i class="fas fa-key"></i><span class="hide-menu"> User Admin </span></a></li>
                    </ul>
                </li>
			
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>