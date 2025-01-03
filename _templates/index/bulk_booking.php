<!-- contact for bulk booking-->
<section class="section section-sm section-first bg-default">
    <div class="container">
        <h3 class="heading-3">Book your Table</h3>
        <form class="rd-form rd-mailform form-style-1" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
            <div class="row row-20 gutters-20">
                <div class="col-md-6 col-lg-4 oh-desktop">
                    <div class="form-wrap wow slideInDown">
                        <input class="form-input" id="contact-your-name-6" type="text" name="name" data-constraints="@Required">
                        <label class="form-label" for="contact-your-name-6">Your Name*</label>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 oh-desktop">
                    <div class="form-wrap wow slideInUp">
                        <input class="form-input" id="contact-email-6" type="email" name="email" data-constraints="@Email @Required">
                        <label class="form-label" for="contact-email-6">Your E-mail*</label>
                    </div>
                </div>
                <div class="col-lg-4 oh-desktop">
                    <div class="form-wrap wow slideInDown">
                        <!--Select 2-->
                        <select class="form-input" data-minimum-results-for-search="Infinity" data-constraints="@Required">
                            <option value="1">Select a Service</option>
                            <option value="2">Dine-In</option>
                            <option value="3">Carry-Out</option>
                            <option value="4">Event Catering</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-wrap wow fadeIn">
                        <label class="form-label" for="contact-message-6">Message</label>
                        <textarea class="form-input textarea-lg" id="contact-message-6" name="message" data-constraints="@Required"></textarea>
                    </div>
                </div>
            </div>
            <div class="group-custom-1 group-middle oh-desktop">
                <button class="button button-lg button-primary button-winona wow fadeInRight" type="submit">Send message</button>
                <!-- Quote Classic-->
                <article class="quote-classic quote-classic-3 wow slideInDown">
                    <div class="quote-classic-text">
                        <p class="q">Please reserve your table at least 1 day in advance.</p>
                    </div>
                </article>
            </div>
        </form>
    </div>
</section>