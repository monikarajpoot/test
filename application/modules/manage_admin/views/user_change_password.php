<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $this->lang->line('active_page'); ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                </div>
            </div><!-- /.box-header -->
        </div>
        <div class="col-xs-12">

            <?php if ($this->session->flashdata('update')) {  ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php echo $this->session->flashdata('update'); ?></strong><br>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('error')) {  ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php echo $this->session->flashdata('error'); ?></strong><br>
                </div>
            <?php } ?>

        </div>
            <form method="post" action="<?php echo base_url();?>manage_admin/change_password" id="">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <input type="hidden" name="u_id" value="<?php echo $this->session->userdata('admin_id'); ?>" required="" >
                            <div class="form-group">
                                <lable for="password">Old Password</lable>
                                <input type="password" name="old_password" value="" required="" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <lable for="password">New Password</lable>
                                <input type="password" name="new_password" value="" required="" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <lable for="password">Re-type New Password</lable>
                                <input type="password" name="con_password" value="" required="" class="form-control"/>
                            </div>
                            <div class="box-footer text-center">
                                <input type="submit" value="Submit" class="btn btn-primary margin"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div><!-- /.box -->
</section><!-- /.content -->
