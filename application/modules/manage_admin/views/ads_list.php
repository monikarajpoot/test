<script src="http://code.angularjs.org/1.2.0/angular.min.js"></script>
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
    <div class="row" ng-controller="myCtrl">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3>
                    </div>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url('admin')?>/add_ads" class="btn btn-primary">Add Advertisment</a>                    
                        <a href="javascript:history.go(-1)" class="btn btn-sm btn-warning">Go Back</a>
                    </div>
                </div><!-- /.box-header -->
<div id="success_delete"></div>

                <div class="box-body">

                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter">
                            <label>Search: <input type="text" class="form-control" ng-model="searchFish">
                            </label>
                        </div>
                    </div>
                    <table  class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SNo</th>
                            <th>Image</th>
                            <th>Advertisment Title</th>
                            <th>Position</th>
                            <th>Creating Date</th>
                            <th>Update Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                        <tr ng-if="all_products!='false'"  ng-repeat="all_product in all_products  | filter:searchFish">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="<?php echo base_url();?>{{ all_product.imagepath }}" width="50px" height="50px"/>
                            </td>
                            <td>{{all_product.title | capitalize }}</td>
                            <td>{{all_product.ads_position | capitalize}}</td>
                            <td>{{all_product.created_date | dateToISO}}</td>
                            <td>{{all_product.updated_date | dateToISO}}</td>
                            <td>
                                <div class="btn-group">                                    
                                    <a href="<?php echo base_url();?>admin/update_ads/{{all_product.id}}" class="btn btn-sm btn-twitter"></i> Update</a>
                                    <button type="button" class="btn btn-sm btn-twitter" ng-click="deleteproduct(all_product)" > Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr ng-if="all_products=='false'">
                            <td colspan="6"> No record found to be displayed here.</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <!-- Main row -->
</section><!-- /.content -->


<script>
    var myApp = angular.module('main-App', []);
	
	myApp.filter('dateToISO', function() {
	  return function(input) {
		input = new Date(input).toISOString();
		return input;
	  };
	});
	
	myApp.filter('htmlToPlaintext', function() {
	  return function(input){		
		  return  input ? String(input).replace(/<[^>]+>/gm, '') : '';		
	  };
	});	
	
	myApp.filter('capitalize', function() {
		return function(input) {
		  return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
		}
	});
	
	myApp.filter('strLimit', ['$filter', function($filter) {
	   return function(input, limit) {
		  if (! input) return;
		  if (input.length <= limit) {
			  return input;
		  }

		  return $filter('limitTo')(input, limit) + '...';
	   };
	}]);
	
    myApp.controller('myCtrl', function($scope, $http) {

        getData();
        function getData() {
            var HTTP_PATH2='<?php echo base_url().'manage_admin/manage_ads/get_ads_list'; ?>';
            $http.get(HTTP_PATH2).then(function(response) {
                $scope.all_products = response.data;
            });
        }

        // function to delete user data from the database
        $scope.deleteproduct = function(all_product){
			alert(all_product.id);
            var conf = confirm('Are you sure to delete the user?');
            if(conf === true){
                var HTTP_PATH='<?php echo base_url().'manage_admin/manage_ads/delete_ads'; ?>';
                var PATH = all_product.imagepath;
                var data = $.param({
                    'id': all_product.id,
                    'img_path': PATH
                });
                var config = {
                    headers : {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                };
                $http.post(HTTP_PATH,data,config).success(function(response){
                    if(response){
                        $('#success_delete').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong> Successfully Delete ..</strong> </div>');
                    }
                });
            }
            getData();
        };

    });

</script>
