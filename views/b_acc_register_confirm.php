<?php include_once('views/_head.php') ?>

<?php include_once('views/_header.php') ?>

	<div class="section login">
		<div class="container">
			<h1 class="section-title">Register email confirm</h1>

			<?php include_once('views/_messages.php'); ?>


			<!-- temp admin function -->
			<!-- <div class="card card-form">
				<form action="" method="post" class="needs-validation" novalidate>

					<div class="form-input submit">
						<input type="hidden" name="tve" value="<?php echo trim(htmlspecialchars($_GET['tve'])); ?>">
						<input type="hidden" name="source" value="<?php echo $baseFunctions->action; ?>">
						<input type="submit" name="acc_activate" class="btn btn-primary w-100" value="Activate account">
					</div>
				</form>
			</div> -->
		</div>
	</div>

<?php include_once('views/_footer.php') ?>