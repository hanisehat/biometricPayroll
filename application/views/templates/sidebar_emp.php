<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('dashboard_emp'); ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('leaves_emp'); ?>" aria-expanded="false"><i class="mdi mdi-beach"></i><span class="hide-menu">Leaves</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('claims_emp'); ?>" aria-expanded="false"><i class="fas fa-recycle"></i><span class="hide-menu">Reimbursement</span></a></li>
				
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('attendances_emp'); ?>" aria-expanded="false"><i class="fa fa-calendar-alt"></i><span class="hide-menu">Attendance</span></a></li>
				
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-database"></i><span class="hide-menu">Payroll </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="<?php echo base_url('payrolls'); ?>" class="sidebar-link"><i class="fas fa-donate"></i><span class="hide-menu"> Salary </span></a></li>
                        <li class="sidebar-item"><a href="<?php echo base_url('bonuses_emp'); ?>" class="sidebar-link"><i class="fa fa-plus"></i><span class="hide-menu">  Bonus </span></a></li>
                    </ul>
                </li>

                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>