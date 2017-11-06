	<div class="cp-category-page2">
		<div class="container">			 
			<div class="row">		 
				<div class="col-md-8"> <?php //pre($news_detail); ?>					
					<div class="cp-single-post">					 
						<div class="cp-thumb"><img src="<?php echo base_url().$news_detail['imagepath'];?>" alt=""></div>
						<div class="cp-post-content">
							<h3><a href="#"><?php echo $news_detail['title'] ?></a></h3>
							<ul class="cp-post-tools">
							<li><i class="icon-1"></i><?php echo date('M d, Y',strtotime($news_detail['created_date'])); ?></li>
							<li><i class="icon-2"></i> <?php echo $news_detail['puser_fullname'] ?></li>
							<li><i class="icon-3"></i> <?php echo $news_detail['menu_name'] ?></li>
							</ul>
							<p><?php echo $news_detail['description'] ?></p>
						</div>					 
						<div class="cp-post-share-tags">
							<div class="row">
								<div class="col-md-6">
									<div class="sharethis-inline-share-buttons"></div>
								</div>
							<div class="col-md-6">
								<ul class="cp-post-tags">
									<li><span><i class="fa fa-tags"></i></span></li>
									<li><?php foreach($cat_random as $crndky=>$crndval){ ?>	
										<a href="<?php echo base_url().'category/'.$crndval['menu_id'];?>"><?php echo $crndval['menu_name'];?></a>
										<?php } ?>
									</li>
								</ul>
							</div>
							</div>
						</div>
					</div>
				</div>
				<?php $this->load->view('left_sidebar'); ?>		 
			</div>
		</div>
	</div>