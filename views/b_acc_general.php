<?php include_once('views/_head.php') ?>

<?php include_once('views/_header.php') ?>

	<div class="section">
		<div class="container">
			<h1 class="section-title">Setări generale</h1>

			<?php include_once('views/_messages.php'); ?>

			<div class="row">
				<?php include_once('views/_b_acc_nav.php'); ?>

				<div class="acc-main col-lg-10">
					<div class="card card-form">
						<p class="h3">Modifică datele generale</p>
						
						<form action="" method="post" class="needs-validation" novalidate>

							<div class="form-input">
								<label for="acc-firstname" class="form-label">Prenume</label>
								<div class="input-group has-validation">
									<input type="text" class="form-control <?php echo isset($baseFunctions->rep['errors']['firstname'])?$baseFunctions->rep['errors']['firstname']:''; ?>" id="acc-firstname" name="acc-firstname" value="<?php echo $baseFunctions->firstname_user; ?>" placeholder="Prenume" required>
									<div class="invalid-feedback">
										Please fill in your first name.
									</div>
								</div>
							</div>

							<div class="form-input">
								<label for="acc-lastname" class="form-label">Nume</label>
								<div class="input-group has-validation">
									<input type="text" class="form-control <?php echo isset($baseFunctions->rep['errors']['lastname'])?$baseFunctions->rep['errors']['lastname']:''; ?>" id="acc-lastname" name="acc-lastname" value="<?php echo $baseFunctions->lastname_user; ?>" placeholder="Nume" required>
									<div class="invalid-feedback">
										Please fill in your last name.
									</div>
								</div>
							</div>

							<div class="form-input">
								<label for="acc-tel" class="form-label">Telefon</label>
								<div class="input-group has-validation">
									<input type="text" class="form-control <?php echo isset($baseFunctions->rep['errors']['tel'])?$baseFunctions->rep['errors']['tel']:''; ?>" id="acc-tel" name="acc-tel" value="<?php echo $baseFunctions->tel_user; ?>" placeholder="tel (ex: 07XXXXXXXX)" required>
									<div class="invalid-feedback">
										Please fill in your tel. number.
									</div>
								</div>
							</div>

							<div class="form-input">
								<label for="acc-username" class="form-label">Username</label>
								<div class="input-group has-validation">
									<input type="text" class="form-control <?php echo isset($baseFunctions->rep['errors']['username'])?$baseFunctions->rep['errors']['username']:''; ?>" id="acc-username" name="acc-username" value="<?php echo $baseFunctions->username; ?>" placeholder="Username" required>
									<div class="invalid-feedback">
										Please fill in your username.
									</div>
								</div>
							</div>

							<div class="form-input submit">
								<input type="hidden" name="source" value="<?php echo $baseFunctions->action; ?>">
								<input type="submit" name="acc_general_info" class="btn btn-primary w-100" value="Modifică">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include_once('views/_footer.php') ?>