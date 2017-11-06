<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small><?php echo 'Admin'; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Admin</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner"> 
                    <?php  $total_usr=get_row("select count(*) as total_usr from pm_users where puser_status=1"); ?>
                    <h3><?php echo $total_usr['total_usr']; ?></h3>
                    <p>No of Sub Admin</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo base_url('admin')?>/user_list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <?php  $total_news=get_row("select count(*) as total_news from pm_news_master "); ?>
                    <h3><?php echo $total_news['total_news']; ?></h3>
                    <p>Number of News</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url('admin')?>/news_list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <?php  $total_category=get_row("select count(*) as total_category from pm_news_category "); ?>
                    <h3><?php echo $total_category['total_category']; ?></h3>
                    <p>Number of News Category</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url('admin')?>/news/category" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <?php  $total_ads=get_row("select count(*) as total_ads from pm_advertisment "); ?>
                    <h3><?php echo $total_ads['total_ads']; ?></h3>
                    <p>Number of Advertisments</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo base_url('admin')?>/ads_list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div><!-- /.row -->
    <!-- Main row -->
    <!-- TABLE: LATEST ORDERS -->
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest News Updates</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>News ID</th>
                                <th>News Title</th>                                
                                <th>Category</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php @$get_top10 = array(0);
							$get_top10 = get_news_post('get_latest_post',' limit 10'); 
						if(count(@$get_top10)>0){ $ix=1;
                            foreach (@$get_top10 as $key => $nval) { ?>
                            <tr>
                                <td><a href="<?php echo base_url('admin'); ?>/manage_order/<?php echo $nval['id'];?>"><?php echo $ix;?></a></td>
                                <td><?php echo $nval['title'];?></td>
                                <td><?php echo $nval['menu_name'];?></td>
                                <td><?php echo ($nval['created_date'])? date('d M Y',strtotime($nval['created_date'])) : 'N/A';?></td>
                            </tr>
							
						<?php $ix++; }}else{ ?>
							<tr><td colspan="3"> No record found</td></tr>
						<?php }?>
                            </tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <!--<a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>-->
                    <a href="<?php echo base_url('admin'); ?>/news_list" class="btn btn-sm btn-default btn-flat pull-right">View All News</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
        <!-- PRODUCT LIST -->
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Recently Added Advertisements</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
					<?php $product5 = array();
					$product5=get_rows("SELECT * FROM pm_advertisment ORDER BY id DESC limit 6");
					foreach($product5 as $product1){ ?>
                        <li class="item">
                            <div class="product-img">							
							<?php if($product1['imagepath'] == ''){ ?>
                                    <img src="dist/img/default-50x50.gif" alt="Product Image"/>
                                <?php } else { ?>
                                <image title="Show Last Image" style="width: 50px;height: 50px;" src="<?php echo base_url()."/".$product1['imagepath'] ; ?>" />
                            <?php } ?>
                            </div>
                            <div class="product-info">
                                <a href="javascript::;" class="product-title">
                                    <?php echo $product1['title'] ; ?>
								</a>
								<span class="product-description">									
									<?php echo 'Position Name:'.$product1['ads_position'] ; ?>
								</span>
                            </div>
                        </li><!-- /.item --> 
					<?php } ?>						
                    </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="<?php echo base_url('admin'); ?>/ads_list" class="uppercase">View All Advertisements.</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->