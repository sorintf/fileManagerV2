<?php include_once('views/_head.php') ?>

<?php include_once('views/_header.php') ?>

	<div class="section login">
		<div class="container">
			<h1 class="section-title">Register</h1>

			<?php include_once('views/_messages.php'); ?>

			<div class="card card-form">
				<form action="" method="post" class="needs-validation" novalidate>

					<div class="form-input">
						<label for="register-firstname" class="form-label">Prenume</label>
						<div class="input-group has-validation">
							<input type="text" class="form-control <?php echo isset($baseFunctions->rep['errors']['firstname'])?$baseFunctions->rep['errors']['firstname']:''; ?>" id="register-firstname" name="register-firstname" value="<?php echo isset($baseFunctions->rep['firstname'])?$baseFunctions->rep['firstname']:''; ?>" placeholder="Prenume" required>
							<div class="invalid-feedback">
								Please fill in your first name.
							</div>
						</div>
					</div>

					<div class="form-input">
						<label for="register-lastname" class="form-label">Nume</label>
						<div class="input-group has-validation">
							<input type="text" class="form-control <?php echo isset($baseFunctions->rep['errors']['lastname'])?$baseFunctions->rep['errors']['lastname']:''; ?>" id="register-lastname" name="register-lastname" value="<?php echo isset($baseFunctions->rep['lastname'])?$baseFunctions->rep['lastname']:''; ?>" placeholder="Nume" required>
							<div class="invalid-feedback">
								Please fill in your last name.
							</div>
						</div>
					</div>

					<div class="form-input">
						<label for="register-email" class="form-label">E-mail</label>
						<div class="input-group has-validation">
							<input type="email" class="form-control <?php echo isset($baseFunctions->rep['errors']['email'])?$baseFunctions->rep['errors']['email']:''; ?>" id="register-email" name="register-email" value="<?php echo isset($baseFunctions->rep['email'])?$baseFunctions->rep['email']:''; ?>" placeholder="E-mail" required>
							<div class="invalid-feedback">
								Please fill in your email address.
							</div>
						</div>
					</div>

					<div class="form-input">
						<label for="register-tel" class="form-label">Telefon</label>
						<div class="input-group has-validation">
							<input type="text" class="form-control <?php echo isset($baseFunctions->rep['errors']['tel'])?$baseFunctions->rep['errors']['tel']:''; ?>" id="register-tel" name="register-tel" value="<?php echo isset($baseFunctions->rep['tel'])?$baseFunctions->rep['tel']:''; ?>" placeholder="tel (ex: 07XXXXXXXX)" required>
							<div class="invalid-feedback">
								Please fill in your tel. number.
							</div>
						</div>
					</div>

					<div class="form-input">
						<label for="register-username" class="form-label">Username</label>
						<div class="input-group has-validation">
							<input type="text" class="form-control <?php echo isset($baseFunctions->rep['errors']['username'])?$baseFunctions->rep['errors']['username']:''; ?>" id="register-username" name="register-username" value="<?php echo isset($baseFunctions->rep['username'])?$baseFunctions->rep['username']:''; ?>" placeholder="Username" required>
							<div class="invalid-feedback">
								Please fill in your username.
							</div>
						</div>
					</div>

					<div class="form-input">
						<label for="register-password" class="form-label">Password</label>
						<div class="input-group has-validation">
							<input type="password" class="form-control <?php echo isset($baseFunctions->rep['errors']['password'])?$baseFunctions->rep['errors']['password']:''; ?>" id="register-password" name="register-password" value="" placeholder="Password" required>
							<div class="invalid-feedback">
								Please fill in a password.
							</div>
						</div>
					</div>

					<div class="form-input">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="da" id="register-acc_tc" name="register-acc_tc" required>
							<label class="form-check-label <?php echo isset($baseFunctions->rep['errors']['acc_tc'])?$baseFunctions->rep['errors']['acc_tc']:''; ?>" for="register-acc_tc">
								Agree to <a href="<?php echo $baseFunctions->buildUrl(array('view'=>"f_policy_tc")); ?>" class="label-link" target="_blank">terms and conditions</a>
							</label>
							<div class="invalid-feedback">
								You must agree before submitting.
							</div>
						</div>
					</div>



					<div class="form-input">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="da" id="register-acc_nl" name="register-acc_nl">
							<label class="form-check-label" for="register-acc_nl">
								Sign up to our awesome newsletter
							</label>
						</div>
					</div>

					<div class="form-input submit">
						<input type="hidden" name="source" value="<?php echo $baseFunctions->action; ?>">
						<input type="submit" name="register" class="btn btn-primary w-100" value="Register">
					</div>
				</form>

				<div class="card-footer">
					Already have an account? <a href="<?php echo $baseFunctions->buildUrl(array('view'=>"b_acc_login")); ?>" class="">Login now!</a>
				</div>
			</div>
		</div>
	</div>

<?php include_once('views/_footer.php') ?>