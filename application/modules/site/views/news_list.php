	<controller ng-controller="news_category_controller" class="ng-scope">	
		<div class="cp-category-page2">
			<div class="container" ng-init="catId='<?php echo $category_id;?>';task='category_news'; category_news_list(catId,limit,offset,columnName,columnvalue,task,sortType,reverse);">
				 <input type="hidden" ng-model="task"/>
				<div class="row">		 
					<div class="col-md-8">
						<h3><?php echo $title;?></h3>
						<div class="row">
							<div class="cp-news-grid-style-6">
								<ul class="grid">
									<li class="col-md-6 col-sm-6" dir-paginate="data in datas | filter:q | itemsPerPage:limit" total-items="total1">
										<div class="cp-post">
										<div class="cp-thumb"><img alt="No image" src="{{sitepaht}}{{data.imagepath}}" style="height:220px"></div>
										<div class="cp-post-content">
										<h3><a href="<?php echo base_url();?>detail/{{data.id}}" title="{{data.title}}">{{data.title | strLimit:32}}</a></h3>
										<ul class="cp-post-tools">
										<li><i class="icon-1"></i>{{data.created_date | dateToISO | date:'fullDate'}}</li>
										<li><i class="icon-2"></i>{{data.puser_fullname}} ({{data.menu_name}})</li>
										</ul>
										</div>
										</div>
									</li>
									
								</ul>
							</div>
						</div>	
						<div ng-if="!total1" style="color:red;padding-left:20;">No record found to be display here.</div>
						<div class="pagination-holder">
							 <div style="float:left;" ng-if="total1">{{ showing }}</div> <div style="float:right;"><dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url();?>dirPagination.tpl.html"> </dir-pagination-controls></div>
						</div>				
					</div>
					<?php $this->load->view('left_sidebar'); ?>		 
				</div>
				<div class="clearfix"></div><br/>
				<?php  $ads_list_footer= get_row("select * from pm_advertisment where ads_position='footer' and status=1"); ?>									
				<?php if(!empty($ads_list_footer) && $ads_list_footer['imagepath']){ ?>
				<div class="col-md-8">
					<div class="cp-advertisement waves-effect"><img src="<?php echo base_url().$ads_list_footer['imagepath'];?>" alt="No Ads"></div>
				</div> 
				<?php }?>
			</div>
		</div>
	</controller>  