<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $this->lang->line('district') ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <!--<div style="float:right">
                    <a href="<?php /*echo base_url('admin');*/?>/manage_user">
                      <button class="btn btn-primary"><i class="fa fa-fw fa-user-plus"></i> ADD</button>
                    </a>
                    </div>-->
                </div><!-- /.box-header -->
                <?php if($this->session->flashdata('update') || $this->session->flashdata('insert') || $this->session->flashdata('error') ){ ?>  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>
                        <?php  echo $this->session->flashdata('update');
                        //   echo $this->session->flashdata('delete');
                        echo $this->session->flashdata('insert');
                        echo $this->session->flashdata('error');?>
                    </strong><br>
                </div>
                <?php }?>
                <table id="example3" class="table table-bordered"> <!--table-striped-->
                    <thead>
                    <tr>
                        <th>Sno.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>                       
                        <th>Add News</th>
						<th>Edit News</th>
						<th>Delete News</th>
						<th>Status</th>
						<th>Date</th>
						<th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ($get_user as $key => $user) { ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php  echo $user['user_name'];?></td>
                            <td><?php  echo $user['user_email'];?></td>
                            <td><?php  echo $user['user_phone'];?></td>							                            
                            <td><?php  echo ($user['is_news_add'])?'Yes':'No';?></td>
                            <td><?php  echo ($user['is_news_edit'])?'Yes':'No';?></td>
                            <td><?php  echo ($user['is_news_dlt'])?'Yes':'No';?></td>
                            <td><?php  if($user['user_status']==1){$status='Active';}else{$status='In-Active';} echo ''.$status;?></td>
                            <td><?php  echo date('d-M-Y',strtotime($user['user_register_date']));?></td>
                            <td>
								<div class="btn-group">
                                    <a href="<?php echo base_url('admin');?>/edit/<?php echo $user['puser_role_id'];?>/<?php echo $user['id'];?>" class="btn btn-sm btn-twitter" title="Edit User"><i class="fa fa-fw fa-edit"></i> </a>
                                    <a onclick="return confirm('Are you sure you want to delete..!')" href="<?php echo base_url();?>manage_admin/user_delete_id/<?php echo $user['id'];?>" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-fw fa-user-times"></i> </a>									
                                </div>
							</td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <!-- Main row -->
</section><!-- /.content -->
    