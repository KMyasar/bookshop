<!-- Section CTA-->
<?php
[$array, $count] = advertise::getstatic();
$pid = $array[0];
$static = new stock($pid);
?>
<section class="primary-overlay section parallax-container" data-parallax-img="images/<?php print($pid); ?>.jpg">
    <div class="parallax-content section-xl context-dark text-md-left">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-sm-8 col-md-7 col-lg-5">
                    <div class="cta-modern">
                        <h3 class="cta-modern-title wow fadeInRight"><?php print($static->getbookname("pid", $pid)); ?></h3>
                        <p class="lead"><?php print(substr($static->getdescription("pid", $pid), 0, 100) . "..."); ?></p>
                        <p class="cta-modern-text oh-desktop" data-wow-delay=".1s"><span class="cta-modern-decor wow slideInLeft"></span><span class="d-inline-block wow slideInDown"><?php print($static->getauthor('pid', $pid)); ?></span></p>
                        <a class="button button-md button-secondary-2 button-winona wow fadeInUp" href="product.php?pid=<?php echo $pid;?>" data-wow-delay=".2s">View The Book</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>