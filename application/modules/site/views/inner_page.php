	<div class="cp-contactus cp-category-page2">
		<div class="container">			 
			<div class="row">	
				<?php if($page_desc['pm_menu_id']==49){?>
					<div class="col-md-8">
						<div class="cp-contact-form">
							<form class="material">
								<ul>
									<li class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
										<input type="text" class="form-control" placeholder="Name">
									</li>
									<li class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
										<input type="email" class="form-control" placeholder="Email">
									</li>
									<li class="input-group"> <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
										<input type="text" class="form-control" placeholder="Subject">
									</li>
									<li class="input-group"> <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
										<textarea class="form-control" placeholder="Message"></textarea>
									</li>
									<li>
										<button type="submit" class="btn btn-submit waves-effect waves-button">Submit <i class="fa fa-angle-right"></i></button>
									</li>
								</ul>
							</form>
						</div>
					</div>
					<?php echo $page_desc['pm_page_detail']; ?>
				<?php }else { ?>
				<div class="col-md-8">
					<div class="cp-single-post">
						<div class="cp-post-content">
						<h3><?php echo $title;?></h3>
							<p><?php echo $page_desc['pm_page_detail']; ?></p>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if($page_desc['pm_menu_id']==49){ }else{?>
					<?php $this->load->view('left_sidebar'); ?>	
				<?php } ?>
			</div>
		</div>
	</div>