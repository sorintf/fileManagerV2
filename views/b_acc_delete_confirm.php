<?php include_once('views/_head.php') ?>

<?php include_once('views/_header.php') ?>

	<div class="section">
		<div class="container">
			<h1 class="section-title">Ștergere cont</h1>

			<?php include_once('views/_messages.php'); ?>

			<div class="row">
				<?php include_once('views/_b_acc_nav.php'); ?>

				<div class="acc-main col-lg-10">
					
					<div class="alert alert-danger d-flex align-items-center" role="alert">
						<svg class="bi flex-shrink-0 me-2 me-lg-4" width="24" height="24" role="img" aria-label="Danger:" fill="currentColor" viewBox="0 0 16 16">
							<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
						</svg>

						<div class="">
							<p class="h3">Ștergere cont</p>
							<p class="">După ștergere, contul poate fi recuperat pentru o perioada de 15 zile, după care ștergerea va deveni definitivă!</p>
							<p class="">După ștergerea contului, vei fi dezautentificat!</p>
							
							<form action="" method="post" class="needs-validation" novalidate>

								<div class="form-input submit">
									<input type="hidden" name="source" value="<?php echo $baseFunctions->action; ?>">
									<input type="submit" name="acc_delete" class="btn btn-danger w-100" value="Șterge">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include_once('views/_footer.php') ?>