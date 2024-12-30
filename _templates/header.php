<header class="section page-header">
	<!-- RD Navbar-->
	<div class="rd-navbar-wrap">
		<nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
			data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
			data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static"
			data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
			data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="56px" data-xl-stick-up-offset="56px"
			data-xxl-stick-up-offset="56px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
			<div class="rd-navbar-inner-outer">
				<div class="rd-navbar-inner">
					<!-- RD Navbar Panel-->
					<div class="rd-navbar-panel">
						<!-- RD Navbar Toggle-->
						<button class="rd-navbar-toggle"
							data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
						<!-- RD Navbar Brand-->
						<div class="rd-navbar-brand"><a class="brand" href="index.php"><img class="brand-logo-dark"
									src="images/logo.png" alt="" width="40" height="20" /></a></div>
					</div>
					<div class="rd-navbar-right rd-navbar-nav-wrap">
						<div class="rd-navbar-aside">
							<ul class="rd-navbar-contacts-2">
								<?php
                                if (usersession::authorize(sessions::get('session_token'))) {
                                    ?>
								<li>
									<div class="unit unit-spacing-xs">
										<div class="unit-left"><span class="fa fa-users"></span></div>
										<div class="unit-body">
											<b><?php echo sessions::get('username') ?></b>
										</div>
									</div>
								</li><?php
                                }
								?>

								<li>
									<div class="unit unit-spacing-xs">
										<div class="unit-left"><span class="icon mdi mdi-phone"></span></div>
										<div class="unit-body"><a class="phone" href="tel:7448841349">+91-7448841349</a>
										</div>
									</div>
								</li>
								<li>
									<div class="unit unit-spacing-xs">
										<div class="unit-left"><span class="icon mdi mdi-map-marker"></span>
										</div>
										<div class="unit-body"><a class="address"
												href="https://goo.gl/maps/BJPgL4t3xFgYeFmR7">The New
												college,Royapettah,Chennai</a></div>
									</div>
								</li>
							</ul>
							<ul class="list-share-2">
								<li><a class="icon mdi mdi-facebook" href="https://www.facebook.com/readandcatch/"></a>
								</li>
								<li><a class="icon mdi mdi-twitter" href="https://twitter.com/readandcatch"></a></li>
								<li><a class="icon mdi mdi-instagram" href="https://instagram.com/readandcatch"></a>
								</li>
							</ul>
						</div>
						<div class="rd-navbar-main">
							<!-- RD Navbar Nav-->
							<ul class="rd-navbar-nav">
								<li class="rd-nav-item <?php if (basename(sessions::CurrentScript(), ".php") == "index") {
								    echo "active";
								} ?>"><a class="rd-nav-link" href="index.php">Home</a>
								</li>
								<li class="rd-nav-item <?php if (basename(sessions::CurrentScript(), ".php") == "typography") {
								    echo "active";
								} ?>"><a class="rd-nav-link" href="display.php?newarrivals=1">New arrivals</a>
								</li>
								<li class="rd-nav-item <?php if (basename(sessions::CurrentScript(), ".php") == "about") {
								    echo "active";
								} ?>"><a class="rd-nav-link" href="about.php">About us</a>
								</li>
								<li class="rd-nav-item <?php if (basename(sessions::CurrentScript(), ".php") == "cart") {
								    echo "active";
								} ?>"><a class="rd-nav-link" href="cart.php">Cart</a>
								</li>
								<?php
								if (sessions::get('is_logged') and sessions::get('session_token')) {
								    if (usersession::authorize(sessions::get('session_token'))) {
								        $redirect_1 = "account";
								        $redirect_2 = "logout";
								        ?>
								<li class="rd-nav-item <?php if (basename(sessions::CurrentScript(), ".php") == "account") {
								    echo "active";
								} ?>"><a class="rd-nav-link"
										href="<?php print($redirect_1 . '.php'); ?>"><?php print(ucfirst($redirect_1)); ?></a>
								</li>
								<li class="rd-nav-item"><a class="rd-nav-link"
										href="<?php print($redirect_2 . '.php'); ?>"><?php print(ucfirst($redirect_2)); ?></a>
								</li>
								<?php
								    }
								} else {
								    $redirect_1 = "login";
								    ?>
								<li class="rd-nav-item"><a class="rd-nav-link"
										href="<?php print($redirect_1 . '.php') ?>"><?php print(ucfirst($redirect_1)) ?></a>
								</li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</div>
</header>