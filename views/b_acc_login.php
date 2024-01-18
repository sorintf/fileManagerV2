<?php include_once('views/_head.php') ?>

<?php include_once('views/_header.php') ?>

	<div class="section login">
		<div class="container">
			<h1 class="section-title">Login</h1>

			<?php include_once('views/_messages.php'); ?>

			<div class="card card-form bg-transparent">
				<form action="" method="post" class="needs-validation" novalidate>
					<div class="form-input">
						<label for="login-username" class="form-label">Email</label>
						<div class="input-group has-validation">
							<input type="text" class="form-control <?php echo isset($baseFunctions->rep['errors']['username'])?$baseFunctions->rep['errors']['username']:''; ?>" id="login-username" name="login-username" value="<?php echo isset($baseFunctions->rep['username'])?$baseFunctions->rep['username']:''; ?>" placeholder="Email" required>
							<div class="invalid-feedback">
								Please fill in your username.
							</div>
						</div>
					</div>

					<div class="form-input">
						<label for="login-password" class="form-label">Password</label>
						<div class="input-group has-validation">
							<input type="password" class="form-control <?php echo isset($baseFunctions->rep['errors']['password'])?$baseFunctions->rep['errors']['password']:''; ?>" id="login-password" name="login-password" value="" placeholder="Password" required>
							<div class="invalid-feedback">
								Please fill in a your password.
							</div>
						</div>

						<div class="forgot-password">
							<a href="<?php echo $baseFunctions->buildUrl(array('view'=>"b_acc_password_request_reset")); ?>" class="form-link">Forgot password?</a>
						</div>
					</div>

					<div class="form-input submit">
						<input type="hidden" name="source" value="<?php echo $baseFunctions->action; ?>">
						<input type="submit" name="login" class="btn btn-outline-light w-100" value="Login">
					</div>
				</form>
			</div>
		</div>
	</div>

<?php include_once('views/_footer.php') ?>