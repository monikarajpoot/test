
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!--<small>Optional description</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">News Detail</li>
        <li class="active"><?php echo $title_tab;?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row" ng-controller="myCtrl">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div class="box-tools pull-right">
                        <a href="javascript:history.go(-1)" class="btn btn-sm btn-warning">Go Back</a>
                    </div>
                </div><!-- /.box-header -->
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <div class="col-xs-4"> <?php //pre($product_detail); ?>
            <div class="box box-success">
                <div class="box-body">
                   <img src="<?php echo base_url().$product_detail['imagepath'];?>" width="100%"/>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <div class="col-xs-8">
            <div class="box box-success">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title">Details</h3></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <lable><h4 class="box-title">News Category Name </h4></lable>
                    <?php echo ucfirst($product_detail['cat_name']);?>
                    <hr/>
                    <lable><h4 class="box-title">Description</h4></lable>
                    <?php echo $product_detail['description'];?>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <!-- Main row -->
</section><!-- /.content -->
