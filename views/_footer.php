

	<footer id="footer">
		<div class="copy">&copy; 2023 (and forever and ever and ever) Two & From</div>
	</footer>

	<script src="/js/jquery-3.7.1.min.js"></script>
	<script src="/js/bootstrap.bundle.min.js"></script>

	<?php if ($baseFunctions->pageSel2): ?>
		<script src="/js/select2.min.js"></script>
		<script src="/js/select-custom.js?v=<?php echo $baseFunctions->version; ?>"></script>
	<?php endif ?>

	<script>
		(() => {
			'use strict'

			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			const forms = document.querySelectorAll('.needs-validation')

			// Loop over them and prevent submission
			Array.from(forms).forEach(form => {
				form.addEventListener('submit', event => {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
		})()
	</script>
</body>
</html>