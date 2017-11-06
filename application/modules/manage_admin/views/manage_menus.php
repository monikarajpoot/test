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
                    <div style="float:left"><h3 class="box-title" id="update_menu1"><?php echo $title_tab;?></h3></div>
                </div><!-- /.box-header -->
                <div class="box-body">
				<form action="<?php echo base_url();?>manage_admin/add_menus" id="for_menu" method="post">
                        <div class="row">
                            <input type="hidden" value="" name="menu_id" id="menu_id" />
                            <div class="col-xs-3">
                                <label for="exampleInputPassword1">Menu Name</label>
                                <input type="text" class="form-control" placeholder="Menu Name" name="menu_name" id="menu_name" required="" />
                            </div>
                            <div class="col-xs-3">
                                <label for="exampleInputPassword1">Menu Parent</label>
                                <select class="form-control"  name="m_parent_id" id="m_parent_id" >
								<option value="">Choose</option>	
                                <option value="0">-- For Parent Menu -- </option>						
								 <?php foreach($get_menu as $key => $menu) { ?>
								 <option value="<?php echo $menu['menu_id'] ?>"> <?php echo ucwords($menu['menu_name']); ?></option>
								 <?php } ?>
								
								</select>
							 </div>
							
							<!--<div class="col-xs-3">
                                <label for="exampleInputPassword1">Menu Link</label>
                                <input type="text" class="form-control" placeholder="Menu Link" name="menu_link" id="menu_link" required=""/>
                            </div>-->
                            <div class="col-xs-3">
                                <div class="btn-group">
                                      <span id="update_city_btn">
                                      <button type="submit" onclick="return confirm('Please confirm first..!')" name="submit_add" value="add_menu" class="btn btn-primary" style="margin-top: 25px;">Submit</button></span>
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
                    <table id="example36" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Menu Name</th>
                            <th>Menu parent</th>
                            <th>link</th>
                            <!--<th>Menu Category</th>-->
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(empty($get_menu)){ ?>
                         <tr>
                             <td colspan="6"> No record found.</td>
                         </tr>
                        <?php } else { ?>
                        <?php $i=1; foreach($get_menu as $key => $menu) { ?>
                            <tr>
                                <td><?php  echo $i;?></td>
                                <td><?php  echo ucfirst($menu['menu_name']);?></td>
                                <td><?php  echo ucfirst($menu['parent_nm']);?></td>
                                <td><?php  echo $menu['link'];?></td>
                                <!--<td><?php  echo $menu['menu_category'];?></td>-->
                                <td>
								<?php if($menu['status'] == 1){ echo "Active"; }else { echo "In-Active" ; } ?>
								</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-twitter edit_menu" value="<?php  echo $menu['menu_id'];?>" data-menu_name="<?php  echo $menu['menu_name'];?>" data-parent_id="<?php  echo $menu['parent_id'];?>" data-link="<?php  echo $menu['link'];?>" ><i class="fa fa-fw fa-edit"></i> EDIT</button>
                                        <a onclick="return confirm('Are you sure you want to delete..!')" href="<?php echo base_url();?>manage_admin/menu_delete_id/<?php  echo $menu['menu_id'];?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-close"></i> DELETE</a>
                                    </div>
                                </td>
                            </tr>
						<?php $i++; } } ?>
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
    $(".edit_menu").click(function(){
        var menuid = $(this).val();
        var menu_name = $(this).data('menu_name');
        var parent_id = $(this).data('parent_id');
        var link = $(this).data('link');
        var btn_2 = '<button type="submit" name="update_menu" value="update_menu" class="btn btn-primary" style="margin-top: 25px;">Update</button><a href="" class="btn btn-danger" style="margin-top: 25px;">Cancle</a>';
        var res = confirm('Update Menu :- '+menu_name)
        if(res) {
			$('#for_menu').attr('action', '<?php echo base_url();?>manage_admin/update_menus');
            $('html,body').animate({scrollTop:0},'slow');
            $("#menu_id").prop('required', true);
            $('#menu_id').val(menuid);
            $('#menu_name').val(menu_name);
            $("#m_parent_id").val(parent_id);
            $("#menu_link").val(link);
            $("#update_city_btn").html(btn_2);
            $("#update_menu1").html('Update Menu');
        }
    });

</script>