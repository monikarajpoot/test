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
                    <div style="float:left"><h3 class="box-title" id="working_city"><?php echo $title_tab;?></h3></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo base_url(); ?>manage_admin/food_belongs_category_insert" id="form_food_type" method="post">
                        <div class="row">
                            <input type="hidden" value="" name="cat_id" id="cat_id" />
                            <div class="col-xs-3">
                                <label for="exampleInputPassword1">Food Title</label>
                                <input type="text" class="form-control" placeholder="Name" name="cat_title" id="cat_title" required="" />
                            </div>
                            <div class="col-xs-2">
                                <label for="exampleInputPassword1">STATUS</label>
                                <select id="cat_status" name="cat_status" class="form-control" required="">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <div class="btn-group">
                                      <span id="update_city_btn">
                               <button type="submit" onclick="return confirm('Please confirm first..!')" name="submit_add" value="add_city" class="btn btn-primary" style="margin-top: 25px;">Submit</button></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                </div><!-- /.box-header -->
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
                            <th>Sno.</th>
                            <th>Food Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($food_type as $key => $type) { ?>
                            <tr>
                                <td><?php  echo $i;?></td>
                                <td><?php  echo $type['category_title'];?></td>
                                <td><?php  echo @$type['category_status'] == 1 ? 'Active' : 'In-Active';?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-twitter edit_type" value="<?php  echo $type['category_id'];?>" data-typename="<?php  echo $type['category_title'];?>" data-status="<?php  echo $type['category_status'];?>" ><i class="fa fa-fw fa-edit"></i> EDIT</button>
                                        <a onclick="return confirm('Are you sure you want to delete..!')" href="<?php echo base_url();?>manage_admin/food_belongs_category_delete/<?php  echo $type['category_id'];?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-close"></i> DELETE</a>
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
    $(".edit_type").click(function(){
        var typeid = $(this).val();
        var typename = $(this).data('typename');
        var status = $(this).data('status');
        var btn_2 = '<button type="submit" name="update_cat" value="update_cat" class="btn btn-primary" style="margin-top: 25px;">Update</button><a href="" class="btn btn-danger" style="margin-top: 25px;">Cancle</a>';
        var res = confirm('Update Food Type :- '+typename)
        if(res) {
            $('html,body').animate({scrollTop:0},'slow');
            $('#form_food_type').attr('action', '<?php echo base_url();?>manage_admin/food_belongs_category_update');
            $("#cat_id").prop('required', true);
            $('#cat_id').val(typeid);
            $('#cat_title').val(typename);
            $("#cat_status").val(status);
            $("#update_city_btn").html(btn_2);
            $("#working_city").html('Update Food Type');
        }
    });

</script>