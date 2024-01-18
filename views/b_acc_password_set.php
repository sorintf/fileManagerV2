<?php include_once('views/_head.php') ?>

<?php include_once('views/_header.php') ?>

	<div class="section login">
		<div class="container">
			<h1 class="section-title">Seteaza noua parola</h1>

			<?php include_once('views/_messages.php'); ?>

			<div class="card card-form">
				<form action="" method="post" class="needs-validation" novalidate>

					<div class="form-input">
						<label for="pwch-passwordn" class="form-label">New Password</label>
						<div class="input-group has-validation">
							<input type="password" class="form-control <?php echo isset($baseFunctions->rep['errors']['password'])?$baseFunctions->rep['errors']['password']:''; ?>" id="pwch-passwordn" name="pwch-passwordn" value="" placeholder="Password" required>
							<div class="invalid-feedback">
								Please fill in a password.
							</div>
						</div>
					</div>

					<div class="form-input">
						<label for="pwch-passwordr" class="form-label">Repeat Password</label>
						<div class="input-group has-validation">
							<input type="password" class="form-control <?php echo isset($baseFunctions->rep['errors']['password'])?$baseFunctions->rep['errors']['password']:''; ?>" id="pwch-passwordr" name="pwch-passwordr" value="" placeholder="Password" required>
							<div class="invalid-feedback">
								Please fill in a password.
							</div>
						</div>
					</div>

					<div class="form-input submit">
						<input type="hidden" name="source" value="<?php echo $baseFunctions->action; ?>">
						<input type="submit" name="acc_password_set" class="btn btn-primary w-100" value="Set new password">
					</div>
				</form>
			</div>
		</div>
	</div>

<?php include_once('views/_footer.php') ?>