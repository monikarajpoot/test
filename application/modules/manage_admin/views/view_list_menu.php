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
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">
                    <a href="<?php echo base_url('admin');?>/manage_menu">
                      <button class="btn btn-primary"><i class="fa fa-fw fa-user-plus"></i> ADD MENU</button>
                    </a>
                    </div>
                </div><!-- /.box-header -->
                <?php if($this->session->flashdata('update') || $this->session->flashdata('insert') || $this->session->flashdata('error') ){ ?>  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>
                        <?php  echo $this->session->flashdata('update');
                        //   echo $this->session->flashdata('delete');
                        echo $this->session->flashdata('insert');
                        echo $this->session->flashdata('error');?>
                    </strong><br>
                </div>
                <?php }
				?>
                <table id="example3" class="table table-bordered"> <!--table-striped-->
                    <thead>
                    <tr>
                        <th>Sno.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Category</th>
						<th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;foreach ($get_menu as $key => $menu) { ?>
                        <tr>
                            <td><?php  echo $i;?></td>
                            <td><?php  echo $menu['menu_name'];?></td>
                            <td><?php
                                $path = '';
                                $arr_path = '';
                                $path =  get_imagepath_byid($menu['menu_id']);
                                foreach($path as $arr_path) {
                                     $arr_path['image_path'];
                                }
                                if($arr_path == ''){ ?>
NO IMAGE
                                <?php } else { ?>
                                <image title="Show Last Image" style="border-radius: 50%;width: 100px;height: 100px;" src="<?php echo base_url()."/".$arr_path['image_path'] ; ?>" />
                            <?php } ?>
							</td>
                            <td><?php  echo $menu['menu_discription'];?></td>
                            <td><?php $cat_array = explode(',',$menu['catnm']);
                                $cat_array_id = explode(',',$menu['cat']);
								if(!empty($menu['catnm']) && $cat_array_id!= ''){
                                $i = 0;
                                foreach($cat_array as $arr) {
                                    echo $arr ?>
									<!--<a onclick="return confirm('Are you sure you want to delete..!')" href="<?php // echo base_url() ; ?>manage_admin/manage_product_menu/procuct_cat_delete/<?php // echo $cat_array_id[$i]; ?>?p_id=<?php // echo $menu['menu_id'];?>" class="text-red"><i class="fa fa-fw fa-close"></i></a>-->
                                    <?php   echo "<br/>";
								$i++;  } unset($cat_array,$cat_array_id); } ?>
                            </td>
                            <td>
							<?php
							if($menu['mng_area_location'] != '' && $menu['area'] != ''){ 
							$query = $this->db->query("SELECT group_concat(ci_location.location_name) as l_location , ci_area.area_name , location_area_id FROM `ci_location` left join ci_area on ci_area.area_id = ci_location.location_area_id WHERE `location_id` IN (".$menu['mng_area_location'].") AND `location_area_id` IN (".$menu['area'].") GROUP BY location_area_id");
								$row_loc = $query->result_array();
                                foreach($row_loc as $row_loc1){
									echo  "<u><b>".$row_loc1['area_name']."</b></u>"; ?>
									<a onclick="return confirm('Are you sure you want to delete..!')" href="<?php echo base_url() ; ?>manage_admin/manage_product_menu/product_area_delete/<?php echo $row_loc1['location_area_id']; ?>?p_id=<?php echo $menu['menu_id'];?>" class="text-red"><i class="fa fa-fw fa-close"></i></a>
								<?php	echo  "<br/>";
									echo  $row_loc1['l_location'];
									echo  "<br/>";
								}	
							}else{
								echo "No Selection";
							}								
								?>
							
                                <?php
                               /* $area_array = explode(',',$menu['cityareaname']);
								@$area_array_id = explode(',',$menu['area']);
								if(!empty($menu['cityareaname'])  && $area_array != ''){
								$i = 0;
                                foreach($area_array as $array) {
                                    echo $array */ ?>
									<!--<a onclick="return confirm('Are you sure you want to delete..!')" href="<?php // echo base_url() ; ?>manage_admin/manage_product_menu/product_area_delete/<?php // echo $area_array_id[$i]; ?>?p_id=<?php // echo $menu['menu_id'];?>" class="text-red"><i class="fa fa-fw fa-close"></i></a>-->
								<?php /* echo "<br/>";  $i++; }  unset($area_array,$area_array_id); }
								echo @$menu['arealocation'] ? $menu['arealocation'] : '' ;
								
								*/ ?>
                            </td>
                            <td><?php
                                  $menu_t = $menu_cat = get_list(FOOD_BELONGS_CATEGORY,'category_id',array('category_id' => $menu['menu_category']),'ASC');
                                  echo @$menu_t[0]['category_title'] ? $menu_t[0]['category_title'] : ''; ?>
                            </td>
							<td><?php  echo $menu['menu_price'] ;?></td>
                            <td><?php  echo $menu['menu_status'] == '1' ? 'Active' : 'Inactive';?></td>
                            <td>
                             <div class="btn-group">
                                <a href="<?php echo base_url('admin');?>/manage_menu/<?php echo $menu['menu_id'];?>" class="btn btn-sm btn-twitter"><i class="fa fa-fw fa-edit"></i> EDIT</a>
                                <a onclick="return confirm('Are you sure you want to delete..!')" href="<?php echo base_url();?>manage_admin/manage_product_menu/menu_delete_id/<?php echo $menu['menu_id'];?>" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-close"></i> DELETE</a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <!-- Main row -->
</section><!-- /.content -->
    