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
                    <form action="<?php echo base_url();?>manage_admin/manage_location/add_area" id="form_area" method="post">
                        <div class="row">
                            <input type="hidden" value="" name="a_id" id="a_id" />
                            <div class="col-xs-1"></div>
                            <div class="col-xs-4">
                                <label for="exampleInputPassword1">Area Name</label>
                                <input type="text" class="form-control" placeholder="Area Name" name="a_name" id="a_name" required=""/>
                            </div>
                            <div class="col-xs-3">
                                <label for="exampleInputPassword1">Choose Relevant City </label>
                                <select class="form-control" id="a_countryid" name="a_countryid" required=""/>
                                <option>Select</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <div class="btn-group">
                            <span id="update_area_btn">
                            <button type="submit" onclick="return confirm('Please confirm first..!')" name="submit_add" value="add_area" class="btn btn-primary" style="margin-top: 25px;">Add</button></span>
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
                            <th>Sno.</th>
                            <th>Area Name</th>
                            <th>City Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($get_state as $key => $state) { ?>
                            <tr>
                                <td><?php  echo $i;?></td>
                                <td><?php  echo $state['pstatest_name'];?></td>
                                <td><?php  echo $state['pcounty_name'];?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-twitter edit_area" value="<?php  echo $state['pstatet_id'];?>" data-statename="<?php  echo $state['pstatest_name'];?>" data-countryid="<?php  echo $state['pcountry_id'];?>" ><i class="fa fa-fw fa-edit"></i> EDIT</button>
                                        <a onclick="return confirm('Are you sure you want to delete..!')" href="<?php echo base_url();?>manage_admin/manage_location/area_delete_id/<?php  echo $state['pstatet_id'];?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-close"></i> DELETE</a>
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
    $(document).ready(function() {
        var HTTP_PATH='<?php echo base_url(); ?>';
        var select_city_id = '<?php echo @$get_user[0]['user_city_id'] ? $get_user[0]['user_city_id'] : ''; ?>';
        //  console.log('ar');
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "manage_admin/get_country",
            datatype: "json",
            async: false,
            success: function(data) {
                var r_data = JSON.parse(data);
                // console.log('ar');
                var otpt = '<option value="">Select City</option>';
                $.each(r_data, function( index, value ) {
                    otpt+= '<option value="'+value.pcounty_id+'" >'+value.pcounty_name+'</option>';
                });
                $("#a_countryid").html(otpt);
            }
        });
    });

    $(".edit_area").click(function(){
        var stateid = $(this).val();
        var countryid = $(this).data('countryid');
        var statename = $(this).data('statename');
        var btn_2 = '<button type="submit" name="update_area" value="update_area" class="btn btn-primary" style="margin-top: 25px;">Update</button><a href="" class="btn btn-danger" style="margin-top: 25px;">Cancle</a>';

        var res = confirm('Update area :- '+statename)
        if(res) {
            $('html,body').animate({scrollTop:0},'slow');
            $('#form_area').attr('action', '<?php echo base_url();?>manage_admin/manage_location/area_update_id');
            $("#a_id").prop('required', true);
            $('#a_id').val(stateid);
            $('#a_name').val(statename);
            $("#a_countryid").val(countryid);
            $("#update_area_btn").html(btn_2);
            $("#working_area").html('Update Area');
        }
    });

</script>

    