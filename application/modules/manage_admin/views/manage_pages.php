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
                    <a href="<?php echo base_url();?><?php echo (@$get_page[0]['page_name'] && $get_page[0]['page_name'] !='home') ? $get_page[0]['page_name'] : '' ; ?>"" class="btn btn-primary" target="_balnk" title="View List" style="float:right"><i class="fa fa-fw fa-list-ul"></i> View Page</a>
                </div>
            </div><!-- /.box-header -->
        </div>
        <!-- general form elements -->
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action=""  enctype="multipart/form-data">
            <?php echo form_error();?>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                        $msg = $this->session->flashdata('message') ? 'success' : 'danger'; ?>
                        <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>
                                <?php  echo $this->session->flashdata('message');
                                echo $this->session->flashdata('error'); ?>
                            </strong><br>
                        </div>
                    </div>
                    <?php }?>
					<?php// pre($get_page); ?>
                    <div class="box-body">
                        <input type="text" name="pm_menu_id" id="pm_menu_id"  value="<?php echo (@$menuId) ? $menuId : '' ; ?>" class="form-control">
                        <input type="hidden" name="p_id" id="p_id"  value="<?php echo (@$get_page[0]['pm_page_id']) ? $get_page[0]['pm_page_id'] : '' ; ?>" class="form-control">
                        <div class="form-group">
                            <label for="file_uo_number">Title</label>
                            <input type="text" name="p_title" id="p_title"  value="<?php echo (@$get_page[0]['pm_page_title']) ? $get_page[0]['pm_page_title'] : $this->input->post('p_title') ; ?>" class="form-control" required="">
                            <?php echo form_error('p_title');?>
                        </div>

                        <div class="form-group">
                            <label for="file_subject">Content</label>
                            <textarea class="form-control" id="editor1" name="p_content" placeholder="Description" required="" rows="10"><?php echo (@$get_page[0]['pm_page_detail']) ? $get_page[0]['pm_page_detail'] : $this->input->post('p_content') ; ?></textarea>
                            <?php echo form_error('p_content');?>
                        </div>

                        <div class="box-footer text-center">
                            <button class="btn btn-primary margin" id="submit_insert" name="submit_update" value="update_page" onclick="return confirm('Please confirm first..!')" type="submit">SUBMIT</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div><!-- /.box -->
</section><!-- /.content -->



<!-- jQuery 2.1.4 -->
<script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>