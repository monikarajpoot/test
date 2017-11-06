<script src="<?php echo SITE_THEME_PATH ?>js/angular.min.js"></script>

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
    <div class="row" ng-controller="myCtrl">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <a href="<?php echo base_url('admin'); ?>/product_list" class="btn btn-primary" title="View List" style="float:right"><i class="fa fa-fw fa-list-ul"></i>View All Product</a>
                </div>
            </div><!-- /.box-header -->
        </div>
        <!-- general form elements -->
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action=""  enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                        $msg = $this->session->flashdata('message') ? 'success' : 'danger'; ?>
                        <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>
                                <?php  echo $this->session->flashdata('message');
                                echo $this->session->flashdata('error'); ?>
                            </strong><br>
                        </div>
                    </div>
                    <?php }?>

                    <div class="box-body">
                        <div class="col-md-8" id="example3">
                            <input type="hidden" name="pt_hidden_id" id="pt_hidden_id"  ng-model="myFile.pt_hidden_id">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Select Product Category : </label>
                                <select class="form-control"  name="pt_child_id" id="pt_child_id"  ng-model="myFile.pt_child_id" ng-change="setval()" required>
                                    <option value="">Choose</option>
                                    <?php foreach ($get_menu as $key => $menu) { ?>
										<?php if($menu['parent_id']!='0'){ ?>
											<option value="<?php echo $menu['menu_id'] ?>" > <?php echo ucwords($menu['menu_name']); ?></option>
										<?php } ?>
									<?php } ?>
                                </select>
                                <input type="hidden" name="pt_parent_id" id="pt_parent_id"  ng-model="myFile.pt_parent_id">
                            </div>


                            <div class="form-group">
                                <label for="file_uo_number">Title : </label>
                                <input type="text" name="pt_title" id="pt_title"  class="form-control" ng-model="myFile.pt_title" required>
                            </div>

                            <div class="form-group">
                                <label for="file_uo_number">Images : </label>
                                <input type="file" name="pt_image" id="pt_image" file-model="myFile.pt_image" required>
                            </div>

                            <div class="form-group">
                                <label for="file_uo_number">Descreption : </label>
                                <textarea id="pt_description" name="pt_description" rows="10" cols="80" ng-model="myFile.pt_description" required>
                                </textarea>
                            </div>


                            <div class="form-group">
                                <label for="file_uo_number">Status : </label>
                                <select name="pt_status" id="pt_status" class="form-control" ng-int="myFile.pt_status" ng-model="myFile.pt_status" >
                                    <option value="1">Active</option>
                                    <option value="0">Not-Active</option>
                                </select>
                            </div>

                            <div class="box-footer">
                                <?php  if(isset($pt_detail) && $pt_detail != '') { ?>
                                    <button ng-click="modify_uploadFile()" class="btn btn-primary margin" id="submit_update" name="submit_update" value="submit_update" type="submit">UPDATE</button>

                                <?php }else{ ?>
                                    <button ng-click="uploadFile()" class="btn btn-primary margin" id="submit_insert" name="submit_insert" value="submit_insert" type="submit">SUBMIT</button>
                                <?php  } ?>
                            </div>
                        </div>
                        <?php  if(isset($pt_detail) && $pt_detail != '') { ?>
                            <div class="col-md-4">
                                <img src="<?php echo base_url(); ?>{{ myFile.pt_image }}" \>
                            </div>
                        <?php  } ?>
                    </div>
        </form>
    </div><!-- /.box -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace('pt_description');
    });
</script>
<script>
    var myApp = angular.module('main-App', []);

    myApp.directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;
                element.bind('change', function(){
                    scope.$apply(function(){
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }]);

    myApp.service('fileUpload', ['$http', function ($http,$location) {
        this.uploadFileToUrl = function(file, uploadUrl , redirect){
            var fd = new FormData();
			var res =confirm("Please confirm first..!");
			if(res==false){ return false;}
            fd.append('pt_hidden_id', file.pt_hidden_id);
            fd.append('pt_child_id', file.pt_child_id);
            fd.append('pt_parent_id', file.pt_parent_id);
            fd.append('pt_title', file.pt_title);
            fd.append('pt_image', file.pt_image);
            fd.append('pt_description', file.pt_description);
            fd.append('pt_status', file.pt_status);
            $http.post(uploadUrl, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            }).success(function(responce){
				window.location.href = redirect;
            })
                .error(function(){
                });
        }
    }]);

    myApp.controller('myCtrl', ['$scope', 'fileUpload', function($scope, fileUpload){
        $scope.uploadFile = function(){
            var file = {};
            file.pt_child_id = $scope.myFile.pt_child_id;
            file.pt_parent_id = $scope.myFile.pt_parent_id;
            file.pt_title = $scope.myFile.pt_title;
            file.pt_image = $scope.myFile.pt_image;
            file.pt_status = $scope.myFile.pt_status;
            file.pt_description = CKEDITOR.instances.pt_description.getData();
            var uploadUrl = '<?php echo base_url().'manage_admin/manage_product/add_product_type'; ?>';
            var redirect = '<?php echo base_url().'admin/product_list'; ?>';
            fileUpload.uploadFileToUrl(file,uploadUrl,redirect);
        };

        $scope.setval = function(){
            var menu1s = <?php echo json_encode($get_menu); ?>;
            $scope.myFile.pt_parent_id =  null;
            angular.forEach(menu1s, function(menu1, key) {
                if(menu1.menu_id == $scope.myFile.pt_child_id){
                    $scope.myFile.pt_parent_id =   menu1.parent_id;
                }
            });
        };

        $scope.modify_uploadFile = function(){
            var file = {};
            file.pt_hidden_id = $scope.myFile.pt_hidden_id;
            file.pt_child_id = $scope.myFile.pt_child_id;
            file.pt_parent_id = $scope.myFile.pt_parent_id;
            file.pt_title = $scope.myFile.pt_title;
            file.pt_image = $scope.myFile.pt_image;
            file.pt_status = $scope.myFile.pt_status;
            file.pt_description = CKEDITOR.instances.pt_description.getData();
            var redirect = '<?php echo base_url().'admin/product_list'; ?>';
            var uploadUrl = '<?php echo base_url().'manage_admin/manage_product/update_product_type'; ?>';
            fileUpload.uploadFileToUrl(file,uploadUrl,redirect);
        };

        var pt_detail = <?php echo json_encode(@$pt_detail['id'] ? $pt_detail : ''); ?>;
        if(pt_detail != ''){
            $scope.myFile = {} ;
            $scope.myFile.pt_hidden_id = pt_detail.id ;
            $scope.myFile.pt_child_id = pt_detail.menu_child_id ;
            $scope.myFile.pt_parent_id = pt_detail.menu_parantId;
            $scope.myFile.pt_title = pt_detail.title;
            $scope.myFile.pt_image = pt_detail.imagepath;
            $scope.myFile.pt_status = pt_detail.status;
            $scope.myFile.pt_description = pt_detail.description;
        }
    }]);

</script>
