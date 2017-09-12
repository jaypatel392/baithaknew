	<!-- banner -->
	<div class="banner banner2 vendor_banner">
		<div class="col-md-6 w3ls_mobiles_grid_right_left">
						<div class="w3ls_mobiles_grid_right_grid1 text-center">
							<img src="<?php echo base_url().$vendor_about[0]->vendor_profile_img;?>" alt=" " class="img-circle img-responsive"/>
							<?php $user_contact  = explode('/',$vendor_about[0]->user_phone); ?>
							<h2><?php echo $vendor_about[0]->user_name;?></h2>
							<h4>Joined : <?php echo $vendor_about[0]->user_updated_date;?><br>Contact : <?php echo $user_contact[0];?></h4>
						</div>
					</div>
					<div class="col-md-6 w3ls_mobiles_grid_right_left">
						<div class="w3ls_mobiles_grid_right_grid1">
							<img src="<?php echo base_url().$vendor_about[0]->vendor_banner_img;?>" alt=" " class="img-responsive" />
							
						</div>
					</div>
	</div> 
	
	<!-- mobiles -->
	<div class="mobiles">
		<div class="container">
			<div class="w3ls_mobiles_grids">
				<div class="col-md-4 w3ls_mobiles_grid_left">
				<div class="w3ls_mobiles_grid_left_grid">
						<h3>Pages</h3>
						<div class="w3ls_mobiles_grid_left_grid_sub">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								<ul class="panel_bottom">
									<li><a href="<?php echo base_url();?>VendorDetails">All Products</a></li>
									<li><a href="<?php echo base_url();?>VendorDetails/aboutUs">About Us</a></li>
									<li><a style="color: black;" href="<?php echo base_url();?>VendorDetails/gallery">Gallery</a></li>
									<li><a href="<?php echo base_url();?>VendorDetails/reviews">Reviews</a></li>
									
								</ul>
							</div>
						</div>
					</div>
					<div class="w3ls_mobiles_grid_left_grid">

						<h3>Categories</h3>

						<div class="w3ls_mobiles_grid_left_grid_sub">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<?php 
							$i = 1;
							foreach ($categories as $cat_val) 
							{
								if($i == 1)
								{
								?>
								<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
								  <h4 class="panel-title asd">
									<a class="pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i class="glyphicon glyphicon-minus" aria-hidden="true"></i><?php echo $cat_val->category_name; ?>
									</a>
								  </h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								  <div class="panel-body panel_text">
									<ul>
									<?php
									$subCategories = $this->vendor_model->getSubCategories($cat_val->category_id);
										if(!empty($subCategories))
										{
											foreach ($subCategories as  $subCategory) 
											{ ?>
										
												<li><a href="products.html"><?php echo $subCategory->category_name;?></a></li>
										<?php
											}
										}
										?>
									</ul>
								  </div>
								</div>
							  </div>
										
								<?php
								}
								else
								{
								?>
								<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="heading<?php echo $i;?>">
								  <h4 class="panel-title asd">
									<a class="pa_italic collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>" aria-expanded="false" aria-controls="collapse<?php echo $i;?>">
									  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i class="glyphicon glyphicon-minus" aria-hidden="true"></i><?php echo $cat_val->category_name; ?>
									</a>
								  </h4>
								</div>
								<div id="collapse<?php echo $i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i;?>">
								   <div class="panel-body panel_text">
									<ul>
									<?php
									$subCategories = $this->vendor_model->getSubCategories($cat_val->category_id);
										if(!empty($subCategories))
										{
											foreach ($subCategories as  $subCategory) 
											{ ?>
										
												<li><a href="products.html"><?php echo $subCategory->category_name;?></a></li>
										<?php
											}
										}
										?>
									</ul>
								  </div>
								</div>
							  </div>
							
								<?php
								}
								$i++;
							}
							?>
							</div>						
						</div>
					</div>
				</div>
					<div class="col-md-8 w3ls_mobiles_grid_right">

					<?php
					$i =1; 
					foreach ($vendor_gallery as $vi_val) 
					{
					 if($i%2 == 0)
					 	{
					 		echo "<div class='row'>";
					 	}
					?>

					<div class="col-md-6 w3ls_mobiles_grid_right_left">
						<div class="w3ls_mobiles_grid_right_grid1">
							<img src="<?php echo base_url().$vi_val->vendor_img_name; ?>" alt=" " class="img-responsive" />
						
						</div>
					</div>
					<?php
					 if($i%2 == 0)
					 	{
					 		echo "</div>";
					 	}
					
					 	$i++;
				}
					?>
					
					<div class="clearfix"> </div>
					<br>
				</div>
				   </div>
				</div>
			</div>
		</div>
	</div>  
	<!-- Related Products -->
	<div class="w3l_related_products">
		<div class="container">
			<h3>Related Products</h3>			
				
		</div>
	</div>
	<!-- //Related Products -->