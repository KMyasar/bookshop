<!--suggested product-->
<section class="section section-lg bg-default">
	<div class="container">
		<h3 class="oh-desktop"><span class="d-inline-block wow slideInUp">Exclusive Books</span></h3>
		<div class="row row-lg row-30">
			<?php
            [$value, $num] = stock::getcategory('suggest',1);
			$i = 0;
			while ($i < $num) {
			    ?>
			<div class="col-sm-6 col-lg-4 col-xl-3">
				<!-- Product-->
				<article class="product wow fadeInLeft" data-wow-delay=".15s">
					<div class="product-figure">
						<?php
			                    $product = new stock($value[$i]);
			    print($product->getimage(165,165));
			    ?>

					</div>
					<div class="product-rating"><span class="mdi mdi-star"></span><span
							class="mdi mdi-star"></span><span class="mdi mdi-star"></span><span
							class="mdi mdi-star"></span><span class="mdi mdi-star text-gray-13"></span>
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
						<div class="button-wrap"><a class="button button-xs button-primary button-winona" href="#">Add
								to cart</a></div>
						<div class="button-wrap"><a class="button button-xs button-secondary button-winona"
								href="/college-project/product.php?<?php print("pid=".$product->pid); ?>">View
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
</section>