<?php include_once('views/_head.php') ?>

<?php include_once('views/_header.php') ?>

	<div class="section login">
		<div class="container">
			<h1 class="section-title">Request password reset</h1>

			<?php include_once('views/_messages.php'); ?>

			<div class="card card-form">
				<form action="" method="post" class="needs-validation" novalidate>
					<div class="form-input">
						<label for="request-reset-email" class="form-label">Email</label>
						<div class="input-group has-validation">
							<input type="email" class="form-control <?php echo isset($baseFunctions->rep['errors']['email'])?$baseFunctions->rep['errors']['email']:''; ?>" id="request-reset-email" name="request-reset-email" value="<?php echo isset($baseFunctions->rep['email'])?$baseFunctions->rep['email']:''; ?>" placeholder="E-mail" required>
							<div class="invalid-feedback">
								Please fill in your email address.
							</div>
						</div>
					</div>

					<div class="form-input submit">
						<input type="hidden" name="source" value="<?php echo $baseFunctions->action; ?>">
						<input type="submit" name="acc_password_request_reset" class="btn btn-primary w-100" value="Reset password">
					</div>
				</form>
			</div>
		</div>
	</div>

<?php include_once('views/_footer.php') ?>