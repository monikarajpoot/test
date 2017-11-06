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
                    <a href="<?php echo base_url('admin');?>/menu" class="btn btn-primary" title="View List" style="float:right"><i class="fa fa-fw fa-list-ul"></i> Menu List </a>
                </div>
            </div><!-- /.box-header -->
        </div>
        <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
            $msg = $this->session->flashdata('message') ? 'success' : 'danger';
            ?>
            <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>
                    <?php  echo $this->session->flashdata('message');
                    echo $this->session->flashdata('error'); ?>
                </strong><br>
            </div>
        <?php }?>
        <!-- general form elements -->
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action=""  enctype="multipart/form-data">
            <?php echo form_error(); ?>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body">
                        <input type="hidden" name="m_id" id="m_id"  value="<?php echo (@$get_product[0]['menu_id']) ? $get_product[0]['menu_id'] : '' ; ?>" class="form-control">

                        <div class="form-group">
                            <label for="file_uo_number">Menu Name *</label>
                            <input type="text" name="m_name" id="m_name"  value="<?php echo (@$get_product[0]['menu_name']) ? $get_product[0]['menu_name'] : $this->input->post('m_name') ; ?>" class="form-control" required="">
                            <?php echo form_error('m_name');?>
                        </div>

                        <div class="form-group">
                            <label for="file_subject">Menu Description *</label>
                            <textarea class="form-control"  name="m_discription" placeholder="discription" required=""><?php echo (@$get_product[0]['menu_discription']) ? $get_product[0]['menu_discription'] : $this->input->post('m_discription') ; ?></textarea>
                            <?php echo form_error('m_discription');?>
                        </div>

                        <div class="form-group">
                            <label for="file_uo_number">Menu Price *</label>
                            <input type="text" name="m_price" id="m_price"  value="<?php echo (@$get_product[0]['menu_price']) ? $get_product[0]['menu_price'] : $this->input->post('m_price') ; ?>" class="form-control" required="">
                            <?php echo form_error('m_price');?>
                        </div>

                        <div class="form-group">
                            <label for="file_subject">Menu Category *</label><br/>
                            <?php $menu_category1 = get_list(FOOD_BELONGS_CATEGORY,'category_id',null,'ASC'); ?>
                            <select  class="form-control" name="m_cate" id="m_cate" required=""> 
                                <option value="">Select</option>
                                <?php foreach($menu_category1 as $m_type) {?>
                                <option value="<?php echo $m_type['category_id'] ;?>" <?php if (@$get_product[0]['menu_category']  == $m_type['category_id']) {echo 'selected';} ?>><?php echo $m_type['category_title'] ;?></option>
                                <?php } ?></select>
                        </div>


                        <div class="form-group">
                            <?php if(isset($get_product[0]['cat'])) { $cat_id = explode(',',$get_product[0]['cat']); }else { $cat_id = array('0');} ; ?>
                            <label for="file_subject">Menu Type *</label><br/>
                            <?php $menu_type2 = get_list(FOOD_TIME_CATEGORY,'id',null,'ASC'); ?>
                            <?php foreach($menu_type2 as $m_cat) {?>
                   <input type="checkbox" name="m_types[]" value="<?php echo $m_cat['id'] ?>" <?php if(in_array($m_cat['id'],$cat_id)){ echo "checked";} ?>/> <?php echo $m_cat['ftc_name'] ?>
                            <?php } ?>
                            </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-3">
                                    <label for="file_uo_number">City *</label>
                                    <select required  class="form-control" id="m_city" name="m_city">
                                        <option value="">Select City</option>
                                    </select>
                                </div>

                                <div class="col-xs-4">
                                    <label for="file_uo_number">Area *</label>
                                    <select required class="form-control" id="m_area" name="m_area">
                                        <option value="">Select Area</option>
                                    </select>
                                </div>

                                <div class="col-xs-4">
                                    <label for="file_uo_number">Location *</label>
                                    <select required  class="form-control" id="m_location_id" name="m_location_id">
                                        <option value="">Select Location</option>
                                    </select>
                                </div>


                                <div class="col-xs-1">
                                    <button type="button" id="reset_location" class="btn btn-xs btn-primary" title="Reset Location"><i class="fa fa-repeat"></i></button>
                                </div>
                            </div>
                            <br/>
							<?php if($get_product[0]['cityareaname'] != ''){ ?>
								<input disabled type="text" id="m_area_text"  placeholder="Select multiple area" value="<?php echo (@$get_product[0]['cityareaname']) ? $get_product[0]['cityareaname'] : '' ; ?>" class="form-control" />
							<?php } ?>
                            
							<input disabled type="text" name="m_location" id="m_location" placeholder="Select multiple location" value="<?php echo (@$get_product[0]['arealocation']) ? $get_product[0]['arealocation'] : '' ; ?>" class="form-control" />
                            <input type="hidden" name="m_location_hidden" id="m_location_hidden" value="<?php echo (@$get_product[0]['mng_area_location']) ? $get_product[0]['mng_area_location'] : '' ; ?>" placeholder="Select multiple location" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="file_uo_number"><span class="dispaly_type_nm"></span> Status</label>
                            <select  class="form-control" name="m_status" id="m_status" required="">
                                <option value="1" <?php if (@$get_product[0]['menu_status']  == '1') {echo 'selected';} ?>>Active</option>
                                <option value="0" <?php if (@$get_product[0]['menu_status']  == '0') {echo 'selected';} ?>>In-Active</option>
                            </select>
                        </div>

                        <div class="box-footer text-center">
                            <button class="btn btn-primary margin" id="submit_insert" name="<?php echo (@$get_product[0]['menu_id']) ? 'submit_update' : 'submit_insert' ; ?>" value="<?php echo (@$get_product[0]['menu_id']) ? 'update_data' : 'insert_data' ; ?>" onclick="return confirm('Please confirm first..!')" type="submit"><?php echo (@$get_product[0]['menu_id']) ? 'Update' : 'ADD' ; ?></button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body">

                        <div class="form-group">
                            1 File Max size : 2 MB
                            <div style="float: right"><button type="button" id="add_multi_btn" class="btn btn-sm" ><i class='fa fa-fw fa-plus'></i> ADD more doc</button>
                                <button type="button" id="remove1" class="btn btn-sm remove1"><i class="fa fa-fw fa-remove"></i> Remove doc</button></div>
                            <span id="dis_file_size"></span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="uploadImage0" type="file" name="product_upload[]" onchange="PreviewImage(0);"/>
                                    <hr/>
                                </div>
                            </div>
                            <div class="row" id="add_multi_choose"></div>
                        </div>

                        <?php
                        if(isset($get_product[0]['menu_id'])){
                        $path =  get_imagepath_byid($get_product[0]['menu_id']);
                        foreach($path as $arr_path) { ?>
                            <div class="col-md-4" align="center"><image src="<?php echo base_url().'/'.$arr_path['image_path']; ?>" style="width: 100px;height: 100px;"/><br/>
                                <a onclick="return confirm('Are you sure you want to delete..!')" href="<?php echo base_url();?>manage_admin/manage_product_menu/image_delete_id/<?php echo $arr_path['image_id'];?>"> <i class="fa fa-close"></i> Remove</a>

                                <hr/></div>
                        <?php  } unset($path); } ?>

                    </div>
                </div>
            </div>
        </form>

    </div><!-- /.box -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    function PreviewImage(no) {
        // var file_type = document.getElementById("uploadImage"+no).files[0].type;
        var  file_size1 = document.getElementById("uploadImage"+no).files[0].size/ 1048576;

        if(file_size1 <= '2') { // && file_type == 'application/jpg'

        }
        else{
            alert('Your file should be PFD format and only choose smaller then 2 mb size');
            $('#uploadImage'+no).val('');
        }
    }

    $(document).ready(function(){
        var incr = 1;
        var x = 0;
        $('#add_multi_btn').on('click', function() {
            if(incr <= 4) {

                $('#add_multi_choose').append('<div class="rem'+incr+'"><div class="col-md-12"><input id="uploadImage' + incr + '" type="file" name="product_upload[]" onchange="PreviewImage(' + incr + ');" required/><hr/></div></div>');
                x++;
                incr++;
            }
        });
        $('#remove1').click(function () {
            if(x == 0){
                $('#uploadImage0').val('');
            }
            if(x >= 1 && incr >=  1) {
                $(".rem" + x).remove();
                x--;
                incr--;
            }
        });
    });
    $(document).ready(function() {
        var HTTP_PATH='<?php echo base_url(); ?>';
        var select_city_id = '<?php echo @$get_user[0]['user_city_id'] ? $get_user[0]['user_city_id'] : ''; ?>';
        //  console.log('ar');
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "manage_admin/get_city",
            datatype: "json",
            async: false,
            success: function(data) {
                var r_data = JSON.parse(data);
                //alert(data);
                var otpt = '<option value="">Select City</option>';
                $.each(r_data, function( index, value ) {
                    var select = '';
                    if(select_city_id == value.city_id){
                        var select = 'selected';
                    }
                    otpt+= '<option value="'+value.city_id+'" '+select+'>'+value.city_name+'</option>';
                });
                $("#m_city").html(otpt);
            }
        });
    });

    <?php if($this->uri->segment(3) == ''){ ?>
    $(document).ready(function() {
        var HTTP_PATH='<?php echo base_url(); ?>';
        var u_city_id = '<?php echo @$get_user[0]['user_city_id'] ? $get_user[0]['user_city_id'] : ''; ?>';
        var u_area_id = '<?php echo @$get_user[0]['user_area_id'] ? $get_user[0]['user_area_id'] : ''; ?>';
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
                    var select = '';
                    if(u_area_id == value.area_id){
                        var select = 'selected';
                    }
                    otpt+= '<option value="'+value.area_id+'" '+select+'>'+value.area_name+'</option>';
                });
                $("#m_area").html(otpt);
            }
        });
    });
    <?php } ?>

    $("#m_city").change(function() {
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
                $("#m_area").html(otpt);
            }
        });
    });

    $("#reset_location").click(function() {
        $('#m_location').val('');
        $("#m_location_hidden").val('');
    });


    $("#m_location_id").change(function() {
        var m_area_id = $("#m_location_id option:selected").val();
        var area_nm =  $("#m_location_id option:selected").text();
        if(m_area_id != ''){
            var m_location_join = $('#m_location').val();
            if(m_location_join != ''){
                var m_location_join = ','+$('#m_location').val();
            }
            var m_location_join_hidden = $('#m_location_hidden').val();
            if(m_location_join_hidden != ''){
                var m_location_join_hidden = ','+$('#m_location_hidden').val();
            }

            $('#m_location').val(area_nm+m_location_join);
            $("#m_location_hidden").val(m_area_id+m_location_join_hidden);
        }
    });

    $("#m_area").change(function() {
        var HTTP_PATH='<?php echo base_url(); ?>';
        var u_areaid_id = $(this).val();

            $.ajax({
                type: "POST",
                url: HTTP_PATH + "manage_admin/get_location_byarea",
                datatype: "json",
                async: false,
                data: {location_area_id: u_areaid_id},
                success: function (data) {
                    var r_data = JSON.parse(data);
                    //alert(r_data);
                    var otpt = '<option value="">Select location</option>';
                    $.each(r_data, function (index, value) {
                        // console.log(value);
                        otpt += '<option value="' + value.location_id + '">' + value.location_name + '</option>';
                    });
                    $("#m_location_id").html(otpt);
                    $("#m_location").val('');
                    $("#m_location_hidden").val('');
                    $("#m_location_hidden").val('');
                    $("#m_area_text").remove();

                }
            });
    });

</script>