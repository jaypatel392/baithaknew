<div class="breadcrumb_dress">
		<div class="container">
			<ul>
				<li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
				<li>Mail Us</li>
			</ul>
		</div>
	</div>
	<!-- //breadcrumbs --> 
	<!-- mail -->
	<div class="mail">
		<div class="container">
			<h3>Mail Us</h3>
			<div class="agile_mail_grids">
				<div class="col-md-5 contact-left">
					<h4>Address</h4>
					<p>est eligendi optio cumque nihil impedit quo minus id quod maxime
						<span>26 56D Rescue,US</span></p>
					<ul>
						<li>Free Phone :+1 078 4589 2456</li>
						<li>Telephone :+1 078 4589 2456</li>
						<li>Fax :+1 078 4589 2456</li>
						<li><a href="mailto:info@example.com">info@example.com</a></li>
					</ul>
				</div>
				<div class="col-md-7 contact-left">
				<?php if($this->session->flashdata('mail_sent')){

					echo $this->session->flashdata('mail_sent');
				} ?>
					<h4>Contact Form</h4>
					<form action="" method="post">
						<input type="text" name="name" placeholder="Your Name" required="">
						<input type="email" name="email" placeholder="Your Email" required="">
						<input type="text" name="mobile" placeholder="Telephone No" required="">
						<textarea name="message" placeholder="Message..." required=""></textarea>
						<input type="submit" value="Submit" name="sendMail" >
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>

			
		</div>
	</div>
	<!-- //mail -->
<!-- newsletter -->
	