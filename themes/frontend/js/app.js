	var app = angular.module('webNewsApp',['angularUtils.directives.dirPagination']);
	
	app.filter('strLimit', ['$filter', function($filter) {
		   return function(input, limit) {
			  if (! input) return;
			  if (input.length <= limit) {
				  return input;
			  }

			  return $filter('limitTo')(input, limit) + '...';
		   };
	}]);
	app.filter('dateToISO', function() {
	  return function(input) {
		input = new Date(input).toISOString();
		return input;
	  };
	});
	
	app.filter('htmlToPlaintext', function() {
	  return function(input){		
		  return  input ? String(input).replace(/<[^>]+>/gm, '') : '';		
	  };
	});	
	
	app.filter('capitalize', function() {
		return function(input) {
		  return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
		}
	});

	app.directive('fileModel', ['$parse', function ($parse)
	{
	return {
		        restrict: 'A',
		        link: function(scope, element, attrs) 
		        {
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
	
	app.service('fileUpload', ['$http', function ($http) {
   			this.uploadFileToUrl = function(param, uploadUrl){
	        var fd = new FormData();
			
	        fd.append('file',param.file);
	        fd.append('uname',param.uname);
	        fd.append('umobile',param.umobile);
	        fd.append('uemail',param.uemail);
	        fd.append('pres_description',param.pres_description);
	        $http.post(uploadUrl,fd, {
	            transformRequest: angular.identity,
	            headers: {'Content-Type': undefined}
	        })
	        .success(function(responce){
				console.log(responce);
				if(responce.status==true){	
					$("#pres_mesg_div").removeClass('alert-danger');
					$("#form_message").val('');
					$("#form_attachment").val('');
					$("#pres_mesg_div").show();
					$("#pres_mesg_div").addClass('alert-success');
					$("#pres_mesg_div").text(responce.message);
					//$scope.rtl_sql_status='success';
					//$scope.ret_suc_msg=responce.message;					
				}else{
					$("#pres_mesg_div").removeClass('alert-success');
					$("#pres_mesg_div").show();	
					$("#pres_mesg_div").addClass('alert-danger');
					$("#pres_mesg_div").html(responce.message);
				}
				$("#upload_presc").prop('disabled', false);
				$("#upload_presc").html('Send');
				setTimeout(function () { $("#pres_mesg_div").fadeOut('slow') }, 6000);
	        })
	        .error(function(){
	        });
    	}
	}]);
	app.controller('news_category_controller', function($scope, $http, $log) {
		/*Status*/
		$scope.rtl_sql_status="";
		$scope.ret_suc_msg="";
		/*Messages*/			
		$scope.limit= parseInt(10);
		$scope.offset= parseInt(0);
		$scope.newOfsset = parseInt(0) ;
		$scope.columnName = null;
		$scope.columnvalue = null;		
		$scope.issubstitued = false;
		$scope.sortType = null;
		$scope.reverse = false;			
		$scope.sitepaht=$scope.siteURL;	
			
		$scope.category_news_list = function(catId,limit,offset,columnName,columnvalue,task,order,orderBy) {
			var finalurl = $scope.siteURL+"news/category/"+catId+"/"+limit+"/"+offset+"/"+columnName+"/"+columnvalue+"/"+task+"/"+order+"/"+orderBy;
			$http.get(finalurl).success(function(response) {
				$scope.datas=response.result;				
				$scope.total1=response.total;
				$scope.showing = 'Showing ' + $scope.offset  + ' - ' +  $scope.limit + ' of ' + $scope.total1;

			});
		}

		$scope.pageChangeHandler = function(newPageNumber) {
			if(!$scope.issubstitued)	{						
				$scope.newOfsset = (newPageNumber - 1) * $scope.limit;
				$scope.offset=$scope.newOfsset;
				$scope.category_news_list($scope.catId,$scope.limit,$scope.newOfsset,$scope.columnName,$scope.columnvalue,$scope.task,$scope.sortType,$scope.reverse);
			}
		}
			
		$scope.showAll = function() {	
			$scope.issubstitued = false;			
			$scope.category_news_list($scope.catId,$scope.limit,$scope.newOfsset,null,null,$scope.task,$scope.sortType ,$scope.reverse);
		}
		
		$scope.sortby = function(type, isreverse){				
			$scope.sortType = type;
			$scope.reverse = isreverse;
			$scope.reverse = !$scope.reverse;
			if($scope.task=='treatment'){
				$scope.show_treatment_list($scope.catId,$scope.limit,$scope.offset,$scope.columnName,$scope.columnvalue,$scope.task,$scope.sortType,isreverse);
			}else{				
				$scope.category_news_list($scope.catId,$scope.limit,$scope.offset,$scope.columnName,$scope.columnvalue,$scope.task,$scope.sortType,isreverse);
			}
		}

		$scope.onLimitChnage = function(limit) {				
			$scope.limit = limit;
			var total = parseInt($scope.newOfsset) + parseInt($scope.limit);			
			$scope.category_news_list($scope.catId,$scope.limit,$scope.offset,$scope.columnName,$scope.columnvalue,$scope.task,$scope.sortType,$scope.reverse);
			//$scope.showing = 'Showing ' + $scope.newOfsset  + ' - ' +  total + ' of ' + $scope.total1;
		}

	});
	
	
	