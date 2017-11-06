<aside class="main-sidebar hidden-print">
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo ADMIN_THEME_PATH; ?>dist/img/avatar5.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php pre($user_permision); echo ucfirst($this->session->userdata('admin_name')); ?></p>
                <!-- Status -->
                <a href="<?php echo base_url('admin');?>/dashboard"><i class="fa fa-circle text-success"></i>Welcome - <?php echo ($this->session->userdata('user_role')==7)?'Super Admin':'Sub Admin' ?> Panel</a>

            </div>
        </div>
        <!-- /.search form -->
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header bg-aqua">Main Menu <span id="counter"></span></li>
            <li>
                <a href="<?php echo base_url('admin');?>/dashboard" title="Eshtablishment create file"><i class="fa fa-users"></i> <span>Dashboard</span></a>
            </li>          
			<!--<li class="treeview" >
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Manage News</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open">

					<li class="treeview" >
						<a href="<?php //echo base_url('admin'); ?>/medicine/category">
							<i class="fa fa-list-alt"></i>
							<span>List of News Category</span>							
						</a>						
					</li>					
					<li>
						<a href="<?php //echo base_url('admin');?>/news_list" title="NEWS Management"><i class="fa fa-list-alt"></i> <span>Manage News</span></a>
					</li>
                </ul>
            </li>-->
            <li class="treeview active" >
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Manage News</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open">
                    <li class="treeview" >
                        <a href="<?php echo base_url('admin'); ?>/news/category">
                            <i class="fa fa-list-alt"></i>
                            <span>Manage Category</span>
                        </a>
                    </li>
                    <li class="treeview" >
                        <a href="<?php echo base_url('admin'); ?>/add_news">
                            <i class="fa fa-list-alt"></i>
                            <span>Add News</span>
                        </a>
                    </li>
					<li class="treeview" >
                        <a href="<?php echo base_url('admin'); ?>/news_list">
                            <i class="fa fa-list-alt"></i>
                            <span>View All News</span>
                        </a>
                    </li>					
                </ul>
            </li>
			<?php
				if(isset($add_user_role) && $add_user_role!=''){ 
					$offline_css="menu-open"; 
					$is_active="active";
					$stylcss=' style="display: block;"'; 
				}else{  $stylcss=""; $is_active="";$offline_css='';} ?>
			<li class="treeview active<?php echo $is_active; ?>" >
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Manage User</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open" >                   
					
						
					<?php $user_role_list= get_user_roles(array(8)); ?>
					<?php if(count($user_role_list)>0){ 
							foreach($user_role_list as $roles){ ?>
					<li>
						<a href="<?php echo base_url('admin'); ?>/add_user/<?php echo $roles['puser_role_id']; ?>"><i class="fa fa-file-text-o"></i><?php echo $roles['puser_role_name'] ?></a>
					</li>
					<?php }}else{ echo 'No roles found';} ?>						
						
					
                </ul>
            </li><li class="treeview active" >
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Manage Test Paper</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open">
                    <li class="treeview" >
                        <a href="<?php echo base_url('admin'); ?>/ads_list">
                            <i class="fa fa-list-alt"></i>
                            <span>All Test Paper</span>
                        </a>
                    </li>
                    <li class="treeview" >
                       <a href="<?php echo base_url('admin'); ?>/add_ads">
                            <i class="fa fa-list-alt"></i>
                            <span>Add Test Paper</span>
                        </a>
                    </li>									
                </ul>
            </li>
			 <li class="treeview active" >
                <a href="#">
                    <i class="fa fa-list-alt"></i>
                    <span>Manage Advertisements</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open">
                    <li class="treeview" >
                        <a href="<?php echo base_url('admin'); ?>/ads_list">
                            <i class="fa fa-list-alt"></i>
                            <span>All Advertisement</span>
                        </a>
                    </li>
                    <li class="treeview" >
                       <a href="<?php echo base_url('admin'); ?>/add_ads">
                            <i class="fa fa-list-alt"></i>
                            <span>Add Advertisement</span>
                        </a>
                    </li>									
                </ul>
            </li>
			 <li>
				<a href="<?php echo base_url('admin');?>/manage_page/41"><i class="fa fa-file-text-o"></i>Aboutus</a>
			</li>
			<li class="treeview" >
				<a href="#">
					<i class="fa fa-file-o"></i>
					<span>Manage Page</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu menu-open">
					<?php $pages = get_rows("SELECT `menu_id`,`menu_name` from `pm_news_category`  where is_catogoy_or_menu=2 and status='1'"); ?>
					<?php foreach($pages as $pgky=>$pgval){ ?>
						<li>
							<a href="<?php echo base_url('admin'); ?>/manage_page/<?php echo $pgval['menu_id'];?>"><i class="fa fa-file-text-o"></i><?php echo $pgval['menu_name'];  ?></a>
						</li>
					<?php } ?>
					
				</ul>
			</li>
		</ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>