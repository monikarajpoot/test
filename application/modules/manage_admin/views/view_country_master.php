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
                    <div style="float:left"><h3 class="box-title" id="working_area"><?php echo $title_tab;?></h3></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo base_url();?>manage_admin/manage_medicine/manage_category" id="form_location" method="post">
                        <div class="row">
                            <input type="hidden" value="" name="pm_medicine_use_type_id" id="cate_id" />
                            <div class="col-xs-3">
                                <label for="exampleInputPassword1">Category Name</label>
                                <input type="text" class="form-control" placeholder="Category Name" name="pm_medicine_use_type_title" id="cate_title" required=""/>
                            </div>
                            <div class="col-xs-3">
                                <div class="btn-group">
                            <span id="update_area_btn">
                            <button type="submit" onclick="return confirm('Please confirm first..!')" name="submit_add" value="add_category" class="btn btn-primary btn_modify" style="margin-top: 25px;">Add</button></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <?php if($this->session->flashdata('update') || $this->session->flashdata('insert') || $this->session->flashdata('delete') ){ ?>  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>
                        <?php  echo $this->session->flashdata('update');
                        echo $this->session->flashdata('delete');
                        echo $this->session->flashdata('insert'); ?>
                    </strong><br>
                </div>
                <?php }?>
                <div class="box-body">
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SN.</th>
                            <th>Category Name</th>                            
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($get_category as $key => $category) { ?>
                            <tr>
                                <td><?php  echo $i;?></td>
                                <td><?php  echo $category['pm_medicine_use_type_title'];?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-twitter edit_category" value="<?php  echo $category['pm_medicine_use_type_id'];?>" data-catename="<?php  echo $category['pm_medicine_use_type_title'];?>"  data-catid="<?php  echo $category['pm_medicine_use_type_id'];?>" ><i class="fa fa-fw fa-edit"></i>EDIT</button>
                                        <a onclick="return confirm('Are you sure you want to delete..!')" href="<?php echo base_url();?>manage_admin/manage_medicine/delete_category/<?php  echo $category['pm_medicine_use_type_id'];?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-close"></i> DELETE</a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <!-- Main row -->
</section><!-- /.content -->
<!-- jQuery 2.1.4 -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">   
    $(".edit_category").click(function(){
        var HTTP_PATH='<?php echo base_url(); ?>';
        var catid = $(this).data('catid');        
        var catename = $(this).data('catename');        
        var btn_2 = '<button type="submit" name="update_location" value="update_location" class="btn btn-primary" style="margin-top: 25px;">Update</button><a href="" class="btn btn-danger" style="margin-top: 25px;">Cancle</a>';
        var res = confirm('Update Category :- '+catename);
        if(res) {
            $('html,body').animate({scrollTop:0},'slow');
            $('#form_location').attr('action', '<?php echo base_url();?>manage_admin/manage_medicine/manage_category');
            $("#l_id").prop('required', true);            
            $('#cate_title').val(catename);            
            $("#cate_id").val(catid);
            $("#update_area_btn").html(btn_2);
            $("#working_area").html('Update Medicine Category');
        }
    });
	$(".btn_modify").click(function(){
        $("#form_location").reset();
    });
	
</script> 