<!-- _templates/_billing.php -->
<!DOCTYPE html>
<html lang="en">
<?php
sessions::load_templates('head');
?>

<body>
    <?php
    $value = true;
    if (sessions::get('is_logged') and sessions::get('session_token')) {
        if (usersession::authorize(sessions::get('session_token'))) {
            $value = false;
            sessions::load_templates('checkout');
        }
    }
    if ($value) {
        sessions::load_script('login');
    }
    ?>
    <!-- partial -->
    <script src="js/lib/load.js"></script>
    <script>
        loadScript('js/checkout.js');
        loadScript('js/bootstrap.bundle.min.js');
    </script>
</body>
<!-- #_templates/_credentials.php -->
</html><!DOCTYPE html>
<html lang="en">
<?php
sessions::load_templates('head');
?>

<body>
    <?php
    if (sessions::get('is_logged') and sessions::get('session_token')) {
        if (usersession::authorize(sessions::get('session_token'))) {
    ?>
            <script>
                window.location.href = "/college-project/index.php";
            </script>
    <?php
        } else {
            sessions::load_templates(basename(sessions::CurrentScript(), ".php"));
        }
    } else {
        sessions::load_templates(basename(sessions::CurrentScript(), ".php"));
    }
    ?>
    <!-- partial -->
    <script src="js/lib/load.js"></script>
</body>
<!-- #_templates/_master.php -->
</html><!DOCTYPE html>
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
<!-- #_templates/about.php -->
</html><main>
	<?php
    sessions::load_templates('about/top_slide');
	sessions::load_templates('about/company_description');
	sessions::load_templates('about/service');
	sessions::load_templates('about/team');
	sessions::load_templates('about/history');
	sessions::load_templates('about/feedback');
	?>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/fonts.css">
</main>
<!-- #_templates/account.php -->
<main>
	<?php
    sessions::load_templates('account/page');
	?>
	<link rel="stylesheet" href="css/account.css">
</main>
<!-- #_templates/cart.php -->
<?php
sessions::load_templates('cart/page2');
// #_templates/checkout.php
<?php
sessions::load_templates('checkout/page');
// #_templates/contacts.php
<?php
sessions::load_templates('contacts/top_view');
sessions::load_templates('contacts/info');
// #_templates/display.php
<!--New arrivals-->
<section class="section section-lg bg-default">
    <div class="container">
        <?php
        $array = array_keys($_GET);
        if ($_GET['newarrivals']) {
            [$value, $num] = stock::getnewarrivals();
        }
        else {
            [$value, $num] = stock::getcategory('category',$array[0]);
        }
        $array = array_keys($_GET);
        ?>
        <h3 class="oh-desktop"><span class="d-inline-block wow slideInUp"><?php print($array[0]);?></span></h3>
        <div class="row row-lg row-30">
            <?php
            $i = 0;
            while ($i < $num) {
            ?>
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <!-- Product-->
                    <article class="product wow fadeInLeft" data-wow-delay=".15s">
                        <div class="product-figure">
                            <?php
                            $product = new stock($value[$i]);
                            print($product->getimage(165, 165));
                            ?>

                        </div>
                        <div class="product-rating"><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span class="mdi mdi-star text-gray-13"></span>
                        </div>
                        <h6 class="product-title">
                            <?php print(substr($product->getbookname("pid", $product->pid), 0, 20)); ?>
                        </h6>
                        <div class="product-price-wrap">
                            <div class="product-price">
                                <p>&#8377;<?php print($product->getprice("pid", $product->pid)); ?>
                                </p>
                            </div>
                        </div>
                        <div class="product-button">
                            <div class="button-wrap"><a class="button button-xs button-primary button-winona" href="cart.php?pid=<?php print($product->pid);?>&item=1">Add
                                    to cart</a></div>
                            <div class="button-wrap"><a class="button button-xs button-secondary button-winona" href="/college-project/product.php?<?php print("pid=" . $product->pid); ?>">View
                                    Product</a></div>
                        </div>
                    </article>
                </div>
            <?php
                $i++;
            }
            ?>
        </div>

    </div>

// #_templates/error.php
</section><h1>Error<h1>
// #_templates/footer.php
<!-- Page Footer-->
<footer class="section footer-modern context-dark footer-modern-2">
	<div class="footer-modern-line">
		<div class="container">
			<div class="row row-50">
				<div class="col-md-6 col-lg-4">
					<h5 class="footer-modern-title oh-desktop"><span class="d-inline-block wow slideInLeft">What We
							Offer</span></h5>
					<ul class="footer-modern-list d-inline-block d-sm-block wow fadeInUp">
						<li><a href="display.php?award=1">Award</a></li>
						<li><a href="display.php?fantacy=1">Fantacy</a></li>
						<li><a href="display.php?novel=1">novel</a></li>
						<li><a href="display.php?selfhelp=1">Self help</a></li>
						<li><a href="display.php?manga=1">Manga</a></li>
						<li><a href="display.php?comics=1">Comics</a></li>
					</ul>
				</div>
				<div class="col-md-6 col-lg-4 col-xl-3">
					<h5 class="footer-modern-title oh-desktop"><span
							class="d-inline-block wow slideInLeft">Information</span></h5>
					<ul class="footer-modern-list d-inline-block d-sm-block wow fadeInUp">
						<li><a href="about.php">About us</a></li>
						<li><a href="display.php?newarrivals=1">New arraivals</a></li>
						<li><a href="account.php">Account</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-modern-line-2">
		<div class="container">
			<div class="row row-30 align-items-center">
				<div class="col-sm-6 col-md-7 col-lg-4 col-xl-4">
					<div class="row row-30 align-items-center text-lg-center">
						<div class="col-md-7 col-xl-6"><a class="brand" href="index.php"><img src="images/logo.png"
									alt="" width="198" height="100" /></a></div>

					</div>
				</div>
				<div class="col-sm-6 col-md-12 col-lg-8 col-xl-8 oh-desktop">
					<div class="group-xmd group-sm-justify">
						<div class="footer-modern-contacts wow slideInUp">
							<div class="unit unit-spacing-sm align-items-center">
								<div class="unit-left"><span class="icon icon-24 mdi mdi-phone"></span></div>
								<div class="unit-body"><a class="phone" href="tel:">+91 48628622626</a></div>
							</div>
						</div>
						<div class="footer-modern-contacts wow slideInDown">
							<div class="unit unit-spacing-sm align-items-center">
								<div class="unit-left"><span class="icon mdi mdi-email"></span></div>
								<div class="unit-body"><a class="mail" href="mailto:">readandcatch</a></div>
							</div>
						</div>
						<div class="wow slideInRight">
							<ul class="list-inline footer-social-list footer-social-list-2 footer-social-list-3">
								<li><a class="icon mdi mdi-facebook" href="#"></a></li>
								<li><a class="icon mdi mdi-twitter" href="#"></a></li>
								<li><a class="icon mdi mdi-instagram" href="#"></a></li>
								<li><a class="icon mdi mdi-google-plus" href="#"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-modern-line-3">
		<div class="container">
			<div class="row row-10 justify-content-between">
				<div class="col-md-6"><span>The New college,Royapetteh</span></div>
				<div class="col-md-auto">
					<!-- Rights-->
					<p class="rights"><span>&copy;&nbsp;</span><span
							class="copyright-year"></span><span></span><span>.&nbsp;</span><span>All Rights
							Reserved.</span><span> Design&nbsp;by&nbsp;<a
								href="https://www.readandcatch.com">readandcatch</a></span></p>
				</div>
			</div>
		</div>
	</div>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/fonts.css">
</footer>
// #_templates/head.php
	<head>

	<!-- fetch the title based on script -->
	<title>
		<?php echo basename(sessions::CurrentScript(), ".php") ?>
	</title>
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">

	<script src="js/core.min.js"></script>
	<link rel="icon" href="images/planner.png" type="image/x-icon">
	<?php
	if ((basename(sessions::CurrentScript(), ".php") == "login")or(basename(sessions::CurrentScript(),".php")=="signup")) {
	?>
		<link rel="stylesheet" href="css/credentials.css">
	<?php
	}
	elseif (basename(sessions::CurrentScript(),".php")=="checkout") {
		?>
		<link rel="stylesheet" href="css/checkout.css">
		<link rel="stylesheet" href="css/lib/bootstrap.min.css ">
		<?php
	} 
	else {
		?>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/fonts.css">
		<?php
	}
	?>
</head>
// #_templates/header.php
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
// #_templates/index.php
<main>
    <?php
    sessions::load_templates('index/banner-slider');
    sessions::load_templates('index/menu');
    sessions::load_templates('index/CTA');
    sessions::load_templates('index/suggest_product');
    sessions::load_templates('index/CTA2');
    sessions::load_templates('index/customer_review');
    sessions::load_templates('index/masonry');
    sessions::load_templates('index/bulk_booking');
    sessions::load_templates('index/service');
    ?>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts.css">
</main>
// #_templates/login.php
<?php
sessions::load_templates('login/auth');
?>
// #_templates/logout.php
<?php
include_once 'lib/load.php';
if (sessions::get('is_logged') and sessions::get('session_token')) {
    $user = new usersession(sessions::get('session_token'));
    $user->removeSession();
    sessions::destory();
?>
    <script>
        window.location.href="/college-project/login.php";
    </script>
<?php
}
?>
// #_templates/makepay.php
<?php
include_once '/opt/lampp/htdocs/college-project/lib/load.php';
if (isset($_POST)) {
    $history = new history();
    $user = new user(sessions::get('username'));
    
    for ($i = 0; $i < count($_SESSION['checklist']); $i++) {
        $array = array();
        $transaction = md5($user->id.date("Y-m-d"));
        foreach ($_SESSION['checklist'][$i] as $key => $value) {
           array_push($array, $value);
        }
        foreach ($_POST as $key => $value) {
            array_push($array, $value);
        }
        array_push($array,$transaction);
        if ($history->makehistory($array,$user->id)) {
            $cart = new cart();
            if ($cart->clearcart($user->id)) {
                sessions::load_script('index');
            }
            else
            {
                echo "Oops something happened";
                // sleep(3);
                // sessions::load_script('index');
            }
        }
        else
        {
            echo "Invalid credentials contact admin";
            // sleep(3);
            // sessions::load_script('index');
        }
        unset($array);
    }
} else {
    echo "error..." . __LINE__;
}
// #_templates/preloader.php
<div class="preloader">
	<div class="wrapper-triangle">
		<div class="pen">
			<?php
            $i = 0;
			while ($i < 3) {
			    ?>
			<div class="line-triangle">
				<?php
			            $j = 0;
			    while ($j < 7) {
			        ?>
				<div class="triangle"></div>
				<?php
			            $j++;
			    }
			    ?>
			</div>
			<?php
                $i++;
			}
			?>
		</div>
	</div>
</div>
// #_templates/product.php
<?php
    sessions::load_templates('product/page');
// #_templates/signup.php
<?php
sessions::load_templates('signup/auth');