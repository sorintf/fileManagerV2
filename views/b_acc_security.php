<?php include_once('views/_head.php') ?>

<?php include_once('views/_header.php') ?>

	<div class="section">
		<div class="container">
			<h1 class="section-title">Setări de siguranță</h1>

			<?php include_once('views/_messages.php'); ?>

			<div class="row">
				<?php include_once('views/_b_acc_nav.php'); ?>

				<div class="acc-main col-lg-10">
					<div class="card card-form">
						<p class="h3">Schimbă parola</p>
						<form action="" method="post" class="needs-validation" novalidate>

							<div class="form-input">
								<label for="pwch-passwordo" class="form-label">Old Password</label>
								<div class="input-group has-validation">
									<input type="password" class="form-control <?php echo isset($baseFunctions->rep['errors']['password'])?$baseFunctions->rep['errors']['password']:''; ?>" id="pwch-passwordo" name="pwch-passwordo" value="" placeholder="Password" required>
									<div class="invalid-feedback">
										Please fill in a password.
									</div>
								</div>
							</div>

							<div class="form-input">
								<label for="pwch-passwordn" class="form-label">New Password</label>
								<div class="input-group has-validation">
									<input type="password" class="form-control <?php echo isset($baseFunctions->rep['errors']['password'])?$baseFunctions->rep['errors']['password']:''; ?>" id="pwch-passwordn" name="pwch-passwordn" value="" placeholder="Password" required>
									<div class="invalid-feedback">
										Please fill in a password.
									</div>
								</div>
							</div>


							<div class="form-input submit">
								<input type="hidden" name="source" value="<?php echo $baseFunctions->action; ?>">
								<input type="submit" name="acc_password_change" class="btn btn-primary w-100" value="Modifică">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include_once('views/_footer.php') ?>