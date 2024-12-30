<!-- Section CTA-->
<?php
[$array, $count] = advertise::getstatic();
$pid = $array[1];
$static = new stock($pid);
?>
<section class="primary-overlay section parallax-container" data-parallax-img="images/<?php print($pid); ?>.jpg">
  <div class="parallax-content section-xxl context-dark text-md-left">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-sm-9 col-md-7 col-lg-5">
          <div class="cta-modern">
            <h3 class="cta-modern-title cta-modern-title-2 oh-desktop"><span class="d-inline-block wow fadeInLeft"><?php print($static->getbookname("pid", $pid)); ?></span></h3>
            <p class="cta-modern-text cta-modern-text-2 oh-desktop" data-wow-delay=".1s"><span class="cta-modern-decor cta-modern-decor-2 wow slideInLeft"></span><span class="d-inline-block wow slideInUp"><?php print($static->getauthor("pid",$pid));?></span></p><a class="button button-lg button-secondary button-winona wow fadeInRight" href="contacts.html" data-wow-delay=".2s">View The Book</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>