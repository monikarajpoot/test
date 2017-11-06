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
                    <form action="<?php echo base_url();?>manage_admin/manage_location/add_location" id="form_location" method="post">
                        <div class="row">
                            <input type="hidden" value="" name="l_id" id="l_id" />
                            <div class="col-xs-3">
                                <label for="exampleInputPassword1">Choose Relevant City </label>
                                <select class="form-control" id="l_cityid" name="l_cityid" required=""/>
                                <option>Select</option>
                                </select>
                            </div>

                            <div class="col-xs-3">
                                <label for="exampleInputPassword1">Choose Relevant Area </label>
                                <select class="form-control" id="l_area" name="l_area" required=""/>
                                <option>Select</option>
                                </select>
                            </div>

                            <div class="col-xs-3">
                                <label for="exampleInputPassword1">Location Name</label>
                                <input type="text" class="form-control" placeholder="Area Name" name="l_name" id="l_name" required=""/>
                            </div>

                            <div class="col-xs-3">
                                <div class="btn-group">
                            <span id="update_area_btn">
                            <button type="submit" onclick="return confirm('Please confirm first..!')" name="submit_add" value="add_location" class="btn btn-primary" style="margin-top: 25px;">Add</button></span>
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
                            <th>District Name</th>
                            <th>State Name</th>
                            <th>Country Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($get_district as $key => $district) { ?>
                            <tr>
                                <td><?php  echo $i;?></td>
                                <td><?php  echo $district['pdistrict_name'];?></td>
                                <td><?php  echo $district['pstatest_name'];?></td>
                                <td><?php  echo $district['pcounty_name'];?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-twitter edit_location" value="<?php  echo $district['pdistrict_id'];?>" data-districtname="<?php  echo $district['pdistrict_name'];?>" data-stateid="<?php  echo $district['pstatet_id'];?>" data-countryid="<?php  echo $district['pcounty_id'];?>" ><i class="fa fa-fw fa-edit"></i> EDIT</button>
                                        <a onclick="return confirm('Are you sure you want to delete..!')" href="<?php echo base_url();?>manage_admin/manage_location/location_delete_id/<?php  echo $district['pdistrict_id'];?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-close"></i> DELETE</a>
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
        var u_city_id = $(this).val();
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "manage_admin/get_area_bycity",
            datatype: "json",
            async: false,
        //    data: {city_id: u_city_id},
            success: function(data) {
                var r_data = JSON.parse(data);
                //alert(r_data);
                var otpt = '<option value="">Select Area</option>';
                $.each(r_data, function( index, value ) {
                    // console.log(value);
                    otpt+= '<option value="'+value.area_id+'">'+value.area_name+'</option>';
                });
                $("#l_area").html(otpt);
            }
        });
    });

    $("#l_cityid").change(function() {
        var HTTP_PATH='<?php echo base_url(); ?>';
        var u_city_id = $(this).val();
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "manage_admin/get_area_bycity",
            datatype: "json",
            async: false,
            data: {city_id: u_city_id},
            success: function(data) {
                var r_data = JSON.parse(data);
                //alert(r_data);
                var otpt = '<option value="">Select Area</option>';
                $.each(r_data, function( index, value ) {
                    // console.log(value);
                    otpt+= '<option value="'+value.area_id+'">'+value.area_name+'</option>';
                });
                $("#l_area").html(otpt);
            }
        });
    });

    $(".edit_location").click(function(){

        var HTTP_PATH='<?php echo base_url(); ?>';
        var cityid = $(this).data('cityid');

        $.ajax({
            type: "POST",
            url: HTTP_PATH + "manage_admin/get_area_bycity",
            datatype: "json",
            async: false,
              data: {city_id: cityid},
            success: function(data) {
                var r_data = JSON.parse(data);
                var otpt = '<option value="">Select Area</option>';
                $.each(r_data, function( index, value ) {
                    otpt+= '<option value="'+value.area_id+'">'+value.area_name+'</option>';
                });
                $("#l_area").html(otpt);
            }
        });

        var locationid = $(this).val();
        var areaid = $(this).data('areaid');
        var locationname = $(this).data('locationname');

        var btn_2 = '<button type="submit" name="update_location" value="update_location" class="btn btn-primary" style="margin-top: 25px;">Update</button><a href="" class="btn btn-danger" style="margin-top: 25px;">Cancle</a>';

        var res = confirm('Update Location :- '+locationname)
        if(res) {
            $('html,body').animate({scrollTop:0},'slow');
            $('#form_location').attr('action', '<?php echo base_url();?>manage_admin/manage_location/area_location_id');
            $("#l_id").prop('required', true);
            $('#l_id').val(locationid);
            $('#l_name').val(locationname);
            $("#l_area").val(areaid);
            $("#l_cityid").val(cityid);
            $("#update_area_btn").html(btn_2);
            $("#working_area").html('Update Area');
        }

    });

</script>

    