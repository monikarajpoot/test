<!-- Section: home -->
<controller ng-controller="home_page_controller" class="ng-scope">
	<div class="container">
		<div class="row"> 
			<div class="col-md-8"> 
				<div class="cp-news-grid-style-2 m20">
					<?php 	$news_category_list=array();  
							$news_category_array=array();  
							$news_cat_list= get_news_with_category('home_sequence',null,null); ?>	
					<?php 	//pre($news_cat_list);							
							foreach($news_cat_list as $newky=>$newcat){
								$category_list[$newcat['menu_id']]=$newcat['menu_name'];
								
							}							
							$uniq_category_list = array_unique($category_list);
							$ind=0;
							foreach($uniq_category_list as $nky=>$nval){
									$news_category_array[$ind]=array($nky,$nval);									
									$ind++;
							}
					?>
					<div class="section-title orange-border">
					<h2><?php echo $news_category_array[0][1]; ?></h2>
					<small><?php echo $news_category_array[0][1]; ?> की ताज़ा ख़बर</small> 
					</div>
					<div class="row">
						<?php $news_list_1= get_news_with_category($news_category_array[0][0],' limit 7 ',null); ?>	
						<?php //pre($news_list_1); ?>
						<div class="col-md-12">
							<div class="cp-fullwidth-news-post-excerpt">
								<?php if($news_list_1[0]['imagepath']){?>
									<div class="cp-thumb"><img src="<?php echo base_url().$news_list_1[0]['imagepath'];?>" alt="No Image"></div>
								<?php } ?>	
								<div class="cp-post-content">
									<h3 title="<?php echo $news_list_1[0]['title']; ?>"><a href="<?php echo base_url();?>detail/<?php echo $news_list_1[0]['id']?>">
											<?php $new110_title= word_limiter($news_list_1[0]['title'],7); echo $new110_title;?>
										</a>
									</h3>
									<ul class="cp-post-tools">
										<li><i class="icon-1"></i><?php echo date('M d, Y',strtotime($news_list_1[0]['created_date'])); ?></li>
										<li><i class="icon-2"></i><?php echo $news_list_1[0]['puser_fullname'] ?></li>
										<li><i class="icon-3"></i> <?php echo $news_list_1[0]['menu_name'] ?></li>
									</ul>
									<p><?php $new110_desc= word_limiter($news_list_1[0]['description'],40); echo $new110_desc;  ?></p>
								</div>
							</div>
						</div>
						<ul class="small-grid">
							<?php for($nws1=1;$nws1<count($news_list_1);$nws1++){ ?>
								<li class="col-md-6 col-sm-6">
									<div class="small-post">
									<div class="cp-thumb">
										<?php if($news_list_1[$nws1]['imagepath']){?>
											<img style="width:83px;height:83px;" src="<?php echo base_url().$news_list_1[$nws1]['imagepath'];?>" alt="No Image">
										<?php } ?>	
									</div>
									<div class="cp-post-content">
										<h3 title="<?php echo $news_list_1[$nws1]['title'];?>"><a href="<?php echo base_url();?>detail/<?php echo $news_list_1[$nws1]['id']?>">
												<?php $new11_title= word_limiter($news_list_1[$nws1]['title'],7); echo $new11_title; ?>
											</a>
										</h3>
										<ul class="cp-post-tools">
											<li><i class="icon-1"></i><?php echo date('M d, Y',strtotime($news_list_1[$nws1]['created_date'])); ?></li>
											<li><i class="icon-2"></i><?php echo $news_list_1[$nws1]['puser_fullname'] ?></li>
										</ul>
									</div>
									</div>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="cp-news-grid-style-4 m50">
						<div class="section-title pink-border">
							<h2><?php echo $news_category_array[1][1]; ?></h2><small><?php echo $news_category_array[1][1]; ?> की ताज़ा ख़बर</small> 
						</div>
						<?php $news_list_2= get_news_with_category($news_category_array[1][0],' limit 5 ',null); ?>	
						<?php //pre($news_list_2); ?>
						<div class="row">
							<div class="col-md-12">
								<div class="cp-fullwidth-news-post-excerpt">
									<?php if($news_list_2[0]['imagepath']){?>
									<div class="cp-thumb"><img src="<?php echo base_url().$news_list_2[0]['imagepath'];?>" alt="No Image"></div>
									<?php } ?>
									<div class="cp-post-content">
										<div class="cp-post-rating"><a href="#"><i class="icon-9"></i> <i class="icon-9"></i> <i class="icon-9"></i> <i class="icon-9"></i> <i class="icon-10"></i></a></div>
										<h3 title="<?php echo $news_list_2[0]['title']; ?>"><a href="<?php echo base_url();?>detail/<?php echo $news_list_2[0]['id']?>">
											<?php $new22_title= word_limiter($news_list_2[0]['title'],7); echo $new22_title; ?>
											</a>
										</h3>
										<ul class="cp-post-tools">
											<li><i class="icon-1"></i><?php echo date('M d, Y',strtotime($news_list_2[0]['created_date'])); ?></li>
											<li><i class="icon-2"></i><?php echo $news_list_2[0]['puser_fullname']; ?></li>
											<li><i class="icon-3"></i> <?php echo $news_list_2[0]['menu_name']; ?></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-9">
								<div class="row">
									<ul class="grid">
										<?php for($nws2=1;$nws2<count($news_list_2);$nws2++){ ?>
											<li class="col-md-6 col-sm-6">
												<div class="cp-post">
													<div class="cp-thumb"><img style="width:263px;height:284px;"  src="<?php echo base_url().$news_list_2[$nws2]['imagepath'];?>" alt="No Image"></div>
													<div class="cp-post-content">
														<div class="cp-post-rating"><a href="#"><i class="icon-9"></i> <i class="icon-9"></i> <i class="icon-9"></i> <i class="icon-9"></i> <i class="icon-10"></i></a></div>
														<h3 title="<?php echo $news_list_2[$nws2]['title']; ?>">
															<a href="<?php echo base_url();?>detail/<?php echo $news_list_2[$nws2]['id']?>">
																<?php $new2_title= word_limiter($news_list_2[$nws2]['title'],5); echo $new2_title; ?>															
															</a>
														</h3>
														<ul class="cp-post-tools">
															<li><i class="icon-1"></i><?php echo date('M d, Y',strtotime($news_list_2[$nws2]['created_date'])); ?></li>
															<li><i class="icon-2"></i><?php echo $news_list_2[$nws2]['puser_fullname']; ?></li>
														</ul>
													</div>
												</div>
											</li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<?php  $ads_list_left_top= get_row("select * from pm_advertisment where ads_position='left_top' and status=1"); ?>									
							<?php if(!empty($ads_list_left_top) && $ads_list_left_top['imagepath']){ ?>
							<div class="col-md-3">
								<div class="v-ad"><img src="<?php echo base_url().$ads_list_left_top['imagepath'];?>" alt="No Ads"></div>
							</div>
							<?php } ?>
							
						</div>
				</div>

				<div class="cp-news-grid-style-1">
					<div class="section-title blue-border">
						<h2>ख़बर</h2><small>ताज़ा ख़बर</small> 
					</div>
					<div class="row">
						<ul class="grid">
						<?php for($k=2;$k<=5;$k++){ ?>		
							<?php $news_list_3= get_news_with_category($news_category_array[$k][0],' limit 1 ',null); ?>	
							<?php //pre($news_list_3); ?>
							<li class="col-md-6 col-sm-6">								
								<div class="cp-news-post-excerpt">
									<?php if($news_list_2[0]['imagepath']){?>
										<div class="cp-thumb"><img  style="width:360px;height:220px;" src="<?php echo base_url().$news_list_3[0]['imagepath'];?>" alt="No Image"></div>
									<?php } ?>									
									<div class="cp-post-content">
										<div class="catname"><a class="catname-btn btn-purple waves-effect waves-button" href="<?php echo base_url();?>category/<?php echo $news_list_3[0]['menu_id'];?>"> <?php echo $news_list_3[0]['menu_name']; ?></a></div>
										<h3 title="<?php echo $news_list_3[0]['title']; ?>"><a href="<?php echo base_url();?>detail/<?php echo $news_list_3[0]['id']?>" ><?php $new3_title= word_limiter($news_list_3[0]['title'],10);  echo $new3_title; ?></a></h3>
										<ul class="cp-post-tools">
											<li><i class="icon-1"></i><?php echo date('M d, Y',strtotime($news_list_3[0]['created_date'])); ?></li>
											<li><i class="icon-2"></i><?php echo $news_list_3[0]['puser_fullname']; ?></li>
										</ul>
									</div>
								</div>
							</li>						
						<?php } ?>
						</ul>
					</div>
				</div> 
				<?php  $ads_list_left_middle= get_row("select * from pm_advertisment where ads_position='left_middle' and status=1"); ?>									
				<?php if(!empty($ads_list_left_middle) && $ads_list_left_middle['imagepath']){ ?>
					<div class="col-md-8">
						<div class="cp-advertisement waves-effect"><img src="<?php echo base_url().$ads_list_left_middle['imagepath'];?>" alt="No Ads"></div>
					</div> 
				<?php } ?>
				<div class="cp-news-grid-style-3 m20">
					<div class="section-title purple-border">
						<h2><?php echo $news_category_array[6][1]; ?></h2><small><?php echo $news_category_array[6][1]; ?> की ताज़ा ख़बर</small> 
					</div>
					<div class="grid-holder">
						<?php $news_list_4= get_news_with_category($news_category_array[6][0],' limit 6 ',null); ?>	
						<?php //pre($news_list_4); ?>
						<div class="row">
							<ul class="cp-load-newsgrid">
								<?php foreach($news_list_4 as $new4ky=>$new4vl){ ?>							
									<li class="col-md-4 col-sm-4 cp-news-post">
										<div class="cp-thumb">
											<?php if($new4vl['imagepath']){ ?>
												<img style="width:210px;height:155px;" src="<?php echo base_url().$new4vl['imagepath']; ?>" alt="No Image">
											<?php } ?>
										</div>
										<h3  title="<?php echo $new4vl['title']; ?>"><a href="<?php echo base_url();?>detail/<?php echo $new4vl['id']?>">
												<?php  $new4_title= word_limiter($new4vl['title'],10);  echo $new4_title; ?>											
											</a>
										</h3>
									</li>
								<?php } ?>								
							</ul>
							<div class="load-more loadmore-holder"> <a href="<?php echo base_url(); ?>news/<?php echo $new4vl['menu_id']; ?>" class="loadmore waves-effect waves-button">Read More <i class="icon-8"></i></a> </div>
						</div>
					</div>
				</div>
			 
				<div class="cp-news-grid-style-5 m20">
					<div class="section-title orange-border">
						<h2><?php echo $news_category_array[7][1]; ?></h2><small><?php echo $news_category_array[7][1]; ?> की ताज़ा ख़बर </small> 
					</div>
					<div>		
						<?php $news_list_7= get_news_with_category($news_category_array[7][0],' limit 4 ',null); ?>	
						<?php //pre($news_list_7); ?>
						<?php foreach($news_list_7 as $news7ky=>$news7vl){ ?>
							<div class="cp-news-list">
								<ul class="row">
									<li class="col-md-6 col-sm-6">
										<div class="cp-thumb">
											<?php if($news7vl['imagepath']){?>
												<img style="width:375px;height:260px;" src="<?php echo base_url().$news7vl['imagepath']?>" alt="No image">
											<?php } ?>
										</div>
									</li>
									<li class="col-md-6 col-sm-6">
										<div class="cp-post-content">
											<h3 title="<?php echo $news7vl['title'];?>"><a href="<?php echo base_url();?>detail/<?php echo $news7vl['id']?>" ><?php $title_7 = word_limiter($news7vl['title'],10); echo $title_7 ; ?></a></h3>
											<ul class="cp-post-tools">
												<li><i class="icon-1"></i><?php echo date('M d, Y',strtotime($news7vl['created_date'])); ?></li>
												<li><i class="icon-2"></i> <?php echo $news7vl['puser_fullname']; ?></li>
												<li><a href="#"><i class="icon-9"></i> <i class="icon-9"></i> <i class="icon-9"></i> <i class="icon-9"></i> <i class="icon-10"></i></a></li>
											</ul>
											<p><?php $desct_7 = word_limiter($news7vl['description'],35); echo $desct_7; ?></p>
										</div>
									</li>
								</ul>
							</div>
						<?php } ?>
					</div>
				</div>
				<?php  $ads_list_footer= get_row("select * from pm_advertisment where ads_position='footer' and status=1"); ?>									
				<?php if(!empty($ads_list_footer) && $ads_list_footer['imagepath']){ ?>
				<div class="col-md-8">
					<div class="cp-advertisement waves-effect"><img src="<?php echo base_url().$ads_list_footer['imagepath'];?>" alt="No Ads"></div>
				</div> 
				<?php }?>	
			</div>
			<?php $this->load->view('left_sidebar'); ?>
		</div>
	</div>
</controller>  