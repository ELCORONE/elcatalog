<div class='wrap'>
	<h1 class='wp-heading-inline'>Плагин добавления товаров</h1>
		<div id="togglenav">
			<?php if (isset($_SESSION['elgoods_upload_file'])): ?>
			<p><?= $_SESSION['elgoods_upload_file']; ?></p>
			<?php unset($_SESSION['elgoods_upload_file']); ?>
			<?php endif; ?>
			<?php
			$action = admin_url('admin-post.php');
			$redirect = $_SERVER['REQUEST_URI'];
			?>
			<form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
				<?php wp_nonce_field('elgoods_upload_file'); ?>
				<input type="hidden" name="action" value="elgoods_upload_file" />
				<input type="hidden" name="redirect" value="<?= $redirect ?>" />
				<input type="file" name="elgoods_upload_file" required />
				<input type="text" name="elgoods_link" style="width:300px" required>
				<input type="submit" value="Добавить товар" />
			</form>
		</div>
</div>
