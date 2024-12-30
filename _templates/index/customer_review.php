<!-- Feedback -->
<section class="section section-xl bg-default">
    <div class="container">
        <h3 class="wow fadeInLeft">What People Say</h3>
    </div>
    <div class="container container-style-1">
        <div class="owl-carousel owl-style-12" data-items="1" data-sm-items="2" data-lg-items="3" data-margin="30" data-xl-margin="45" data-autoplay="true" data-nav="true" data-center="true" data-smart-speed="400">
            <?php
            $review = new feedback();
            for ($i = 1; $i <= $review->count; $i++) {
            ?>
                <!-- Quote Tara-->
                <article class="quote-tara">
                    <div class="quote-tara-caption">
                        <div class="quote-tara-text">
                            <p class="q">
                                <?php
                                echo $review->getfeedback('pid', $i);
                                ?></p>
                        </div>
                        <div class="quote-tara-figure"><img src="images/user-6-115x115.jpg" alt="" width="115" height="115" />
                        </div>
                    </div>
                    <h6 class="quote-tara-author"><?php echo $review->getname('pid',$i); ?></h6>
                    <div class="quote-tara-status"><?php echo $review->getwho('pid',$i); ?></div>
                </article>
            <?php
            }
            ?>
        </div>
    </div>
</section>