<?php if(!empty($food_lists)): foreach($food_lists as $menu_list): ?>   
	<div class="col-sm-4 col-lg-4 col-md-4">
		<form id="frm_menu_id<?php echo $menu_list['menu_id'];?>" method="post" action="<?php echo base_url();?>ecart/addtocart_ajax">
		<div class="thumbnail">
			<div class="hover01 column">
			<figure><img src="<?php echo base_url().$menu_list['imgpath']; ?>" class="img-responsive" alt=""></figure>
			</div>
			<div class="caption">
				<h4 class="pull-right" style="float:right"><?php  echo 'Rs. '.$menu_list['menu_price']; ?></h4>
				<h4 style="margin-bottom:5px;"><a href="#"><?php  echo ucfirst($menu_list['menu_name']); ?></a></h4>
				<p>
					<?php  echo ucfirst($menu_list['menu_name']); ?>
					<input type="hidden" name="menu_id" value="<?php echo $menu_list['menu_id'];?>"/>
				</p>
			</div>
			<div class="bs-example">
			<a href="#" data-toggle="popover" title="First Product" data-content="<?php  echo ucfirst($menu_list['menu_discription']); ?>"><img src="<?php echo SITE_THEME_PATH ?>images/icon.png" class="img-responsive" alt=""></a>
			</div>
			<div class="ratings">
				<button type="submit" id="<?php echo $menu_list['menu_id'];?>" class="btn btn-default grubit" style="float:right">GRAB IT</button>
				<p>
					<span class="glyphicon"><input type="number" min="0" name="menu_qty" class="text" value="1" style="float:right;height: 28px;margin-top: 0px;width: 60px;"></span>										
				</p>
			</div><div class="clearfix"></div>
		</div>
		</form>		
	</div>								
<?php endforeach;?>		
		<nav>
		  <ul class="pager">
			<!--<li><a href="#">Previous</a></li>-->
			<!--<li><a href="#">Next</a></li>-->
			<?php //echo $this->ajax_pagination->create_links(); ?>
		  </ul>
		</nav>
<?php else: ?>
<div class="alert alert-danger"><a data-dismiss="alert" class="close">×</a>No record found to be displayed here.</div>
<?php endif; ?>
<div class="clearfix"></div>
<?php echo $this->ajax_pagination->create_links(); 
//exit(); ?>
<script>
$(".grubit").click(function(){
			 var grubid = $(this).attr('id');
			//alert('welcome'+grubid);return false;
			/*add to cartsss*/
			$('#frm_menu_id'+grubid).ajaxForm({ 
				beforeSubmit:  showloading,
				// dataType identifies the expected content type of the server response 
				dataType:  'json', 	 
				// success identifies the function to invoke when the server response 
				// has been received 
				success: function(data){
						if(data['totalprice']!=''){		
							$('.simpleCart_totaljs').text(data['totalprice']);
						}
					   if(data['totalcartitem']!=''){		
							$('#simpleCart_quantity').text(data['totalcartitem']);
						}
					 }
			});
						
        });
</script>