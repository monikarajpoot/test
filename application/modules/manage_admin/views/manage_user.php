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
					<a href="<?php echo base_url('admin');?>/user_list" class="btn btn-primary" title="View List" style="float:right;margin-right:12px;"><i class="fa fa-fw fa-list-ul"></i> <?php echo $user_role_tab; ?> List</a>
					
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
            <?php echo form_error();?>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body">
                        <input type="hidden" name="uploaded_image" id="uploaded_image"  value="<?php echo (@$get_user[0]['pro_image']) ? $get_user[0]['pro_image'] : '' ; ?>" class="form-control">
                        <input type="hidden" name="u_id" id="u_id"  value="<?php echo (@$get_user[0]['id']) ? $get_user[0]['id'] : '' ; ?>" class="form-control">
						 <input type="hidden" name="users[puser_role_id]" id="puser_role_id"  value="<?php echo (@$get_user[0]['puser_role_id']) ? $get_user[0]['puser_role_id'] : $add_user_role ; ?>" class="form-control">
                             <div class="form-group">
                            <label for="file_uo_number">Full Name</label>
                            <input type="text" name="users[puser_fullname]" id="u_name"  value="<?php echo (@$get_user[0]['user_name']) ? $get_user[0]['user_name'] : $this->input->post('puser_fullname') ; ?>" class="form-control" required="">
                                 <?php echo form_error('puser_fullname');?>
                        </div>
	
						<div class="form-group">
                            <label for="file_uo_number">Email</label>
                            <input type="email" name="users[puser_email]" id="puser_email"  value="<?php echo (@$get_user[0]['user_email']) ? $get_user[0]['user_email'] : $this->input->post('u_email') ; ?>" class="form-control" required="">
                            <?php echo form_error('u_email');?>
                        </div>
						
						<div class="form-group">
                            <label for="file_uo_number">Mobile</label>
                            <input type="text" name="users[puser_mobile1]" id="puser_mobile1"  value="<?php echo (@$get_user[0]['user_phone']) ? $get_user[0]['user_phone'] : $this->input->post('u_email') ; ?>" class="form-control" required="" maxlength="15">
                            <?php echo form_error('puser_mobile1');?>
                        </div>
						<div class="form-group">
                            <label for="file_uo_number">Password <?php echo (@$get_user[0]['puser_password'])?'<span style="color:red;font-size:11px">(If you dont want change paasword, then leave it blank)</span>':' '; ?></label>
                            <input type="password" name="users[puser_password]" id="puser_password"  value="" maxlength="15" class="form-control" <?php echo (@$get_user[0]['puser_password'])?'':'required=""'; ?>>
                            <?php echo form_error('puser_password');?>
                        </div>
				
                    </div>
                </div>			
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body">	
                        <div class="form-group">
                            <label for="file_uo_number">Status</label>
                            <select  class="form-control" name="users[puser_status]" id="puser_status" required="">
                                <option value="1" <?php if (@$get_user[0]['user_status']  == '1') {echo 'selected';} ?>>Active</option>
                                <option value="0" <?php if (@$get_user[0]['user_status']  == '0') {echo 'selected';} ?>>In-Active</option>
                            </select>
						</div>		
						<div class="form-group">
                            <label for="file_uo_number">Permision</label>
                            <input type="checkbox" <?php if (@$get_user[0]['puser_add_news']  == '1') {echo 'checked';} ?>  name="users[puser_add_news]" value="1" />Add News &nbsp; 
                            <input type="checkbox" <?php if (@$get_user[0]['puser_edit_news']  == '1') {echo 'checked';} ?> name="users[puser_edit_news]" value="1" />Edit News &nbsp; 
							<input type="checkbox" <?php if (@$get_user[0]['puser_delete_news']  == '1') {echo 'checked';} ?> name="users[puser_delete_news]" value="1" />Delete News 
						</div>
							
                        <div class="box-footer text-center">
                            <button class="btn btn-primary margin" id="submit_insert" name="<?php echo (@$get_user[0]['id']) ? 'submit_update' : 'submit_insert' ; ?>" value="<?php echo (@$get_user[0]['id']) ? 'update_data' : 'insert_data' ; ?>" onclick="return confirm('Please confirm first..!')" type="submit"><?php echo (@$get_user[0]['id']) ? 'Update' : 'Submit' ; ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div><!-- /.box -->
</section><!-- /.content -->
<!-- jQuery 2.1.4 -->
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
    $(document).ready(function() {
        var HTTP_PATH='<?php echo base_url(); ?>';
        var select_state_id = '<?php echo @$get_user[0]['puser_pro_state'] ? $get_user[0]['puser_pro_state'] : ''; ?>';
      //  console.log('ar');
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "manage_admin/get_state_by_country",
            datatype: "json",
            async: false,
            success: function(data) {
                var r_data = JSON.parse(data);
               // console.log('ar');
                var otpt = '<option value="">Select State</option>';
                $.each(r_data, function( index, value ) {
                    var select = '';
                    if(select_state_id == value.pstatet_id){
                        var select = 'selected';
                    }
                    otpt+= '<option value="'+value.pstatet_id+'" '+select+'>'+value.pstatest_name+'</option>';
                });
                $("#puser_pro_state").html(otpt);
            }
        });
    });
<?php if($this->uri->segment(3) != ''){ ?>
    $(document).ready(function() {
        var HTTP_PATH='<?php echo base_url(); ?>';
        var u_dist_id = '<?php echo @$get_user[0]['puser_pro_district'] ? $get_user[0]['puser_pro_district'] : ''; ?>';
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "manage_admin/get_district_by_state_stope",
            datatype: "json",
            async: false,            
            success: function(data) {
                var r_data = JSON.parse(data);
                //alert(r_data);
                var otpt = '<option value="">Select District</option>';
                $.each(r_data, function( index, value ) {
                    var select = '';
                    if(u_dist_id == value.pdistrict_id){
                        var select = 'selected';
                    }
                    otpt+= '<option value="'+value.pdistrict_id+'" '+select+'>'+value.pdistrict_name+'</option>';
                });
                $("#puser_pro_district").html(otpt);
            }
        });
    });
<?php } ?>

    $("#puser_pro_country").change(function() {
        var HTTP_PATH='<?php echo base_url(); ?>';
        var country_id = $(this).val();
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "manage_admin/get_state_by_country",
            datatype: "json",
            async: false,
            data: {country_id: country_id},
            success: function(data) {
                var r_data = JSON.parse(data);
                //alert(r_data);
                var otpt = '<option value="">Select State</option>';
                $.each(r_data, function( index, value ) {
                    // console.log(value);
                    otpt+= '<option value="'+value.pstatet_id+'">'+value.pstatest_name+'</option>';
                });
                $("#puser_pro_state").html(otpt);
            }
        });
    });
	
	$("#puser_pro_state").change(function() {
        var HTTP_PATH='<?php echo base_url(); ?>';
        var state_id = $(this).val();
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "manage_admin/get_district_by_state",
            datatype: "json",
            async: false,
            data: {state_id: state_id},
            success: function(data) {
                var r_data = JSON.parse(data);
                //alert(r_data);
                var otpt = '<option value="">Select District</option>';
                $.each(r_data, function( index, value ) {
                    // console.log(value);
                    otpt+= '<option value="'+value.pdistrict_id+'">'+value.pdistrict_name+'</option>';
                });
                $("#puser_pro_district").html(otpt);
            }
        });
    });
</script>
