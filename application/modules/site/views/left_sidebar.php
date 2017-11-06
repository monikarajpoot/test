<div class="col-md-4">
	<div class="sidebar side-bar right-sidebar">	
		<?php  $ads_list_right_top= get_row("select * from pm_advertisment where ads_position='right_top' and status=1"); ?>									
		<?php if(!empty($ads_list_right_top) && $ads_list_right_top['imagepath']){ ?>
		<div class="widget advertisement">
			<div class="ad-holder"><img src="<?php echo base_url().$ads_list_right_top['imagepath'];?>" alt="No Ads"></div>
		</div>
		<?php } ?>
		<div class="widget sidebar-featured-post">
			<h3 class="side-title">Featured Posts Widget</h3>
			<?php $featured_post = get_news_post('get_feature_post',' limit 10'); ?>
			<div class="cp-sidebar-content">
				<div class="side-featured-slider owl-carousel owl-theme">
				<?php if(count($featured_post)>0){ ?>
					<?php foreach($featured_post as $fnwsky=>$fnwsval){ ?>
						<div class="item"><img src="<?php echo base_url().$fnwsval['imagepath']; ?>" style="height:225px;" alt="No Image">	
							<div class="cp-post-content">
								<div class="catname">
									<a href="<?php echo base_url().'category/'.$fnwsval['menu_id'];?>" class="catname-btn btn-orange waves-effect waves-button">
										<?php echo $fnwsval['menu_name']; ?>
									</a>
								</div>
								<h3 title="<?php echo $fnwsval['title']; ?>">
									<a href="<?php echo base_url().'detail/'.$fnwsval['menu_id'];?>">
										<?php  $ftrd_nws_title = word_limiter($fnwsval['title'],6); echo $ftrd_nws_title;?>
									</a>
								</h3>
							</div>
						</div>	
					<?php }?>
				<?php }?>
				</div>
			</div>
		</div> 
		<?php  $ads_list_right_middle= get_row("select * from pm_advertisment where ads_position='right_middle' and status=1"); ?>									
		<?php if(!empty($ads_list_right_middle) && $ads_list_right_middle['imagepath']){ ?>
		<div class="widget advertisement">
			<div class="ad-holder"><img src="<?php echo base_url().$ads_list_right_middle['imagepath'];?>" alt="No Ads"></div>
		</div>
		<?php } ?>					  
		<div class="widget latest-posts">
			<h3 class="side-title">Latest Posts</h3>
			<div class="cp-sidebar-content">
				<?php $latest_post = get_news_post('get_latest_post',' limit 5'); ?>
				<ul class="small-grid">
					<?php if(count($latest_post)>0){ ?>
					<?php foreach($latest_post as $lnwsky=>$ltnwsvl){ ?>
						<li>
							<div class="small-post">
								<div class="cp-thumb">	
									<?php if($ltnwsvl['imagepath']){ ?>
									<img alt="" src="<?php echo base_url().$ltnwsvl['imagepath'];?>">
									<?php } ?>
								</div>
								<div class="cp-post-content">
								<h3 title="<?php echo $ltnwsvl['title']; ?>"><a href="<?php echo base_url().'detail/'.$ltnwsvl['id'];?>"><?php $ltst_nws_title = word_limiter($ltnwsvl['title'],6); echo $ltst_nws_title;?></a></h3>
								<ul class="cp-post-tools">
								<li><i class="icon-1"></i><?php echo date('M d, Y',strtotime($ltnwsvl['created_date'])); ?></li>
								<li><i class="icon-3"></i> <a class="purple-text " href="<?php echo base_url();?>category/<?php echo $ltnwsvl['menu_id']?>"><?php echo $ltnwsvl['menu_name']; ?></a></li>
								</ul>
								</div>
							</div>
						</li>
					<?php } }else{ echo '<li> No Latest Post here.</li>';} ?>	
						
				</ul>
			</div>
		</div>							  
		<div class="widget sidebar-video">
			<h3 class="side-title">Video Widget</h3>
			<div class="cp-sidebar-content">
			<iframe src="http://www.livetv24x7.com/embed/ndtvindia/"></iframe>
			</div>
		</div>
		
		<?php  $ads_list_right_bottom= get_row("select * from pm_advertisment where ads_position='right_bottom' and status=1"); ?>									
		<?php if(!empty($ads_list_right_bottom) && $ads_list_right_bottom['imagepath']){ ?>
		<div class="widget advertisement">
			<div class="ad-holder"><img src="<?php echo base_url().$ads_list_right_bottom['imagepath'];?>" alt="No Ads"></div>
		</div>
		<?php } ?>						
		<?php $news_rows = get_rows("SELECT cat.menu_id,cat.menu_name, COUNT(news.menu_child_id)AS total_news FROM pm_news_category AS cat 
						LEFT JOIN  pm_news_master AS news ON news.menu_child_id=cat.menu_id
						WHERE cat.status='1' AND is_catogoy_or_menu=1
						GROUP BY cat.menu_id"); 
			if(count($news_rows)>0){
		?>
		<div class="widget categories">
			<h3 class="side-title">Categories</h3>
			<div class="cp-sidebar-content">
				<ul class="cat-holder">
					<?php if(count($news_rows)>0) { foreach ($news_rows as $key => $value) { ?>									
						<li><a href="<?php echo base_url().'category/'.$value['menu_id'];?>"><?php echo $value['menu_name'];?></a> <i class="count"><?php echo $value['total_news'];?></i></li>								
					<?php } } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<div class="widget facebook-widget">
			<h3 class="side-title">Facebook</h3>
			<div class="cp-sidebar-content">
				<div id="fb-root"></div>
				<div class="fb-page" data-href="https://www.facebook.com/crunchpress.themes" data-height="300px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"></div>
			</div>
		</div>
		<div class="widget tags-widget">
			<h3 class="side-title">Tags</h3>
			<div class="cp-sidebar-content"> 							
				<?php if(count($news_rows)>0) { foreach ($news_rows as $key => $value) { ?>
					<a href="<?php echo base_url().'category/'.$value['menu_id'];?>"><?php echo $value['menu_name'];?></a> 								
				<?php } } ?>

			</div>
		</div>							 
	</div>
</div>