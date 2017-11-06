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
                    <form action="<?php echo base_url();?>manage_admin/manage_location/add_country" id="form_city" method="post">
                        <div class="row">
                            <input type="hidden" value="" name="c_id" id="c_id" />
                            <div class="col-xs-1">                            </div>
                            <div class="col-xs-4">
                                <label for="exampleInputPassword1">Country Name</label>
                                <input type="text" class="form-control" placeholder="Country Name" name="c_name" id="c_name" required="" />
                            </div>
                            <div class="col-xs-3">
                                <label for="exampleInputPassword1">Country Short Name</label>
                                <input type="text" class="form-control" placeholder="Country Short Name" name="c_s_nm" id="c_s_nm" required=""/>
                            </div>
                            <div class="col-xs-4">
                                <div class="btn-group">
                                      <span id="update_city_btn">
                                      <button type="submit" onclick="return confirm('Please confirm first..!')" name="submit_add" value="add_country" class="btn btn-primary" style="margin-top: 25px;">Submit</button></span>
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
                            <th>Country Name</th>
                            <th>Country Short Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($get_city as $key => $city) { ?>
                            <tr>
                                <td><?php  echo $i;?></td>
                                <td><?php  echo $city['pcounty_name'];?></td>
                                <td><?php  echo $city['pcounty_sortname'];?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-twitter edit_city" value="<?php  echo $city['pcounty_id'];?>" data-countryname="<?php  echo $city['pcounty_name'];?>" data-countrysort="<?php  echo $city['pcounty_sortname'];?>" ><i class="fa fa-fw fa-edit"></i> EDIT</button>
                                        <a onclick="return confirm('Are you sure you want to delete..!')" href="<?php echo base_url();?>manage_admin/manage_location/country_delete_id/<?php  echo $city['pcounty_id'];?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-close"></i> DELETE</a>
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
    $(".edit_city").click(function(){
        var cityid = $(this).val();
        var countryname = $(this).data('countryname');
        var countrysort = $(this).data('countrysort');
        var btn_2 = '<button type="submit" name="update_country" value="update_country" class="btn btn-primary" style="margin-top: 25px;">Update</button><a href="" class="btn btn-danger" style="margin-top: 25px;">Cancle</a>';
        var res = confirm('Update City :- '+countryname)
        if(res) {
            $('html,body').animate({scrollTop:0},'slow');
            $('#form_city').attr('action', '<?php echo base_url();?>manage_admin/manage_location/country_update_id');
            $("#c_id").prop('required', true);
            $('#c_id').val(cityid);
            $('#c_name').val(countryname);
            $("#c_s_nm").val(countrysort);
            $("#update_city_btn").html(btn_2);
            $("#working_city").html('Update Area');
        }
    });

</script>