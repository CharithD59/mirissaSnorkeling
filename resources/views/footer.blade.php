 
 <!-- Footer Start -->
 <div class="container-fluid bg-dark text-white-50 footer mt-2 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-2">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h2 class="display-6 fw-bold text-primary mb-4">{{ setting('footer.brand_first') }}<span class="text-white">{{ setting('footer.brand_second') }}</span></h2>
                <p>{{ setting('footer.about') }}</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-square me-1" href="{{ setting('social.facebook') }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square me-1" href="{{ setting('social.instagram') }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-square me-1" href="{{ setting('social.google_maps') }}" target="_blank"><i class="fas fa-map-marker-alt"></i></a>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Get In Touch</h5>
                <p><i class="fa fa-map-marker-alt me-3"></i>{{ setting('contact.address_short') }}</p>
                <p><i class="fa fa-phone-alt me-3"></i>{{ setting('contact.phone') }}</p>
                <p>
                    <i class="fa fa-envelope me-3"></i>
                    <a href="mailto:{{ setting('contact.email') }}" title="{{ setting('contact.email') }}">
                        {{ setting('contact.email') }}
                    </a>
                </p>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="text-light mb-4">Quick Links</h5>
                <a class="btn btn-link" href="/">Home Page</a>
                <a class="btn btn-link" href="/#aboutus_section">About Us</a>
                <a class="btn btn-link" href="/#services_section">Our Services</a>
                <a class="btn btn-link" href="/#gallery_section">Our Gallery</a>
                <a class="btn btn-link" href="/#reviews_section">Reviews</a>
                <a class="btn btn-link" href="/#contact_section">Contact Us</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary mb-4">Business Hours</h4>
                <p>We are open every day to serve you better. Visit us during the hours below:</p>
                <p class="mb-1">{{ setting('footer.hours_days') }}</p>
                <h6 class="text-light">{{ setting('footer.hours_time') }}</h6>
            </div>
        </div>
    </div>
    <div class="container-fluid copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="#">{{ setting('footer.copyright') }}</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="">CodeLabs</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square-top back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/{{ setting('contact.whatsapp') }}"
   id="whatsappFloatBtn"
   class="whatsapp-float"
   target="_blank"
   rel="noopener">
    <img src="{{ asset(env('ASSET_PREFIX','').'img/whatsapp_l_size.png') }}"
         alt="Chat on WhatsApp">
</a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset (env('ASSET_PREFIX', '').'lib/wow/wow.min.js')}}"></script> 
<script src="{{ asset (env('ASSET_PREFIX', '').'lib/easing/easing.min.js')}}"></script>
<script src="{{ asset (env('ASSET_PREFIX', '').'lib/waypoints/waypoints.min.js')}}"></script> 
<script src="{{ asset (env('ASSET_PREFIX', '').'lib/counterup/counterup.min.js')}}"></script> 
<script src="{{ asset (env('ASSET_PREFIX', '').'lib/owlcarousel/owl.carousel.min.js')}}"></script> 

<!-- custom js file link  -->
<script type="text/javascript" src="{{ asset (env('ASSET_PREFIX', '').'js/script.js')}}"></script> 

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5001082046759897"
     crossorigin="anonymous"></script>

<script>
document.getElementById("whatsappFloatBtn").addEventListener("click", function () {

    // Fire-and-forget logging (NO blocking)
    fetch('/log-whatsapp-click', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            action: 'whatsapp_floating_click',
            phone: @json(setting('contact.whatsapp'))
        }),
        keepalive: true   // Important for mobile browsers
    }).catch(() => {
        // ignore logging errors
    });

});
</script>
 

</body>
</html>