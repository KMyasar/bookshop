<!-- Swiper-->
<section class="section swiper-container swiper-slider swiper-slider-2 swiper-slider-3" data-loop="true"
	data-autoplay="5000" data-simulate-touch="false" data-slide-effect="fade">
	<div class="swiper-wrapper text-sm-left">
		<?php
        [$array, $count] = advertise::getbanner();
		for ($i = 0; $i < $count; $i++) {
		    $pid = $array[$i];
		    $banner = new stock($pid);
		    ?>
		<div class="swiper-slide context-dark"
			data-slide-bg="images/<?php print($pid); ?>.jpg">
			<div class="swiper-slide-caption section-md">
				<div class="container">
					<div class="row">
						<div class="col-sm-9 col-md-8 col-lg-7 col-xl-7 offset-lg-1 offset-xxl-0">
							<h1 class="oh swiper-title"><span class="d-inline-block" data-caption-animate="slideInUp"
									data-caption-delay="0"><?php print($banner->getbookname("pid", "$banner->pid")); ?></span>
							</h1>
							<p class="big swiper-text" data-caption-animate="fadeInLeft" data-caption-delay="300">
								<?php print(substr($banner->getdescription("pid", "$banner->pid"), 0, 100) . "..."); ?>
							</p>
							<a class="button button-lg button-primary button-winona button-shadow-2"
								href="product.php?pid=<?php print($pid);?>"
								data-caption-animate="fadeInUp" data-caption-delay="300">View the book</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>
	<!-- Swiper Pagination-->
	<div class="swiper-pagination" data-bullet-custom="true"></div>
	<!-- Swiper Navigation-->
	<div class="swiper-button-prev">
		<div class="preview">
			<div class="preview__img"></div>
		</div>
		<div class="swiper-button-arrow"></div>
	</div>
	<div class="swiper-button-next">
		<div class="swiper-button-arrow"></div>
		<div class="preview">
			<div class="preview__img"></div>
		</div>
	</div>
</section>