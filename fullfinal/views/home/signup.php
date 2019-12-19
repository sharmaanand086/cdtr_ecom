	<!-- Content -->
		<div id="pageContent">
			<div class="container offset-14">
				<h1 class="block-title large">Create an Account</h1>
	 			
				<div class="row">
					<div class="col-sm-8 col-sm-push-2 col-lg-6 col-lg-push-3">.
						<?php echo validation_errors(); ?>
	 				<?php echo checkFlash(); ?>
						<div class="login-form-box">

							<h2 class="text-uppercase">Personal Information</h2>
							<form action="<?php echo site_url('Signup/newUser'); ?>" method="post">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
										<span class="icon icon-person_outline"></span>
										</span>
										<input type="text" id="LoginFormName1" name="fname" class="form-control" placeholder="First Name">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
										<span class="icon icon-person_outline"></span>
										</span>
										<input type="text" id="LoginFormName2" class="form-control" name="lname" placeholder="Last Name">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
										<span class="icon icon-email"></span>
										</span>
										<input type="email" name="email" id="LoginEmail" class="form-control" placeholder="E-mail">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">
										<span class="icon icon-lock_outline"></span>
										</span>
										<input type="password" id="LoginFormPass1" class="form-control" name="password" placeholder="Password">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="button-block">
											<button type="submit" class="btn">CREATE AN ACCOUNT</button>
										</div>
									</div>
									<div class="col-md-12">
										<div class="additional-links-01">or <a href="#">Return to Store</a></div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>