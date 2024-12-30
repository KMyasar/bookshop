<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<?php
if (isset($_GET['logout'])) {
	sessions::load_templates('logout');
}
?>
<?php
sessions::load_templates('head');
sessions::load_templates("preloader");
?>

<body>

	<div class="page">
		<!-- Page Header-->
		<?php
		sessions::load_templates('header');
		/**
		 * Main content
		 */
		?>
		<?php
		if (basename(sessions::CurrentScript(), ".php") == "account") {
			if (sessions::get('is_logged') and sessions::get('session_token')) {
				if (usersession::authorize(sessions::get('session_token'))) {
					sessions::load_templates(basename(sessions::CurrentScript(), ".php"));
				} else {
		?>
					<script>
						window.location.href = "/college-project/login.php";
					</script>
				<?php }
			} else {
				?>
				<script>
					window.location.href = "/college-project/login.php";
				</script>
		<?php }
		} else {
			sessions::load_templates(basename(sessions::CurrentScript(), ".php"));
		}
		/**
		 * Page footer
		 */
		sessions::load_templates('footer');
		?>
	</div>
	<script src="js/lib/load.js"></script>
	<script>
		loadScript('js/script.js');
		<?php
		if (basename(sessions::CurrentScript(), ".php") == "account") {
		?>
			loadScript('js/account.js');
		<?php
		}
		?>
	</script>
</body>

</html>