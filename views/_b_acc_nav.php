<div class="side-nav col-lg-2">
	<ul class="nav flex-column">

		<?php if ($baseFunctions->admin_status): ?>
			<li class="nav-item">
				<a class="nav-link bg-info" href="/admin.php">Admin</a>
			</li>
			<li class="nav-item">
				<hr class="divider">
			</li>
		<?php endif ?>

		<li class="nav-item">
			<a class="nav-link <?php echo ($baseFunctions->view=='b_acc_general')?'active':''; ?>" href="<?php echo $baseFunctions->buildUrl(array('view'=>"b_acc_general")); ?>"><?php echo $baseFunctions->translate['b_acc_general']['link_label'][$baseFunctions->lang]; ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($baseFunctions->view=='b_acc_security')?'active':''; ?>" href="<?php echo $baseFunctions->buildUrl(array('view'=>"b_acc_security")); ?>"><?php echo $baseFunctions->translate['b_acc_security']['link_label'][$baseFunctions->lang]; ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo ($baseFunctions->view=='b_acc_communication')?'active':''; ?>" href="<?php echo $baseFunctions->buildUrl(array('view'=>"b_acc_communication")); ?>"><?php echo $baseFunctions->translate['b_acc_communication']['link_label'][$baseFunctions->lang]; ?></a>
		</li>


		<li class="nav-item">
			<hr class="divider">
		</li>

		<li class="nav-item">
			<a class="nav-link <?php echo ($baseFunctions->view=='b_acc_delete_info'||$baseFunctions->view=='b_acc_delete_confirm')?'active':''; ?>" href="<?php echo $baseFunctions->buildUrl(array('view'=>"b_acc_delete_info")); ?>"><?php echo $baseFunctions->translate['b_acc_delete_info']['link_label'][$baseFunctions->lang]; ?></a>
		</li>

		<li class="nav-item">
			<hr class="divider">
		</li>



		<li class="nav-item">
			<a class="nav-link <?php echo ($baseFunctions->view=='b_acc_logout')?'active':''; ?>" href="<?php echo $baseFunctions->buildUrl(array('view'=>"b_acc_logout")); ?>"><?php echo $baseFunctions->translate['b_acc_logout']['link_label'][$baseFunctions->lang]; ?></a>
		</li>
	</ul>
</div>