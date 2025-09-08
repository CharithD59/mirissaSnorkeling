 
 <!-- Footer Start -->
 <div class="container-fluid bg-dark text-white-50 footer mt-2 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-2">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h2 class="display-6 fw-bold text-primary mb-4">Mirissa<span class="text-white">BayDiving</span></h2>
                <p>Discover the wonders of Mirissa Bay with our exceptional diving, snorkeling, and blue whale tours. Explore vibrant coral reefs and witness majestic marine life for an unforgettable adventure</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-square me-1" href="https://www.facebook.com/mirissabaydiving" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square me-1" href="https://www.instagram.com/srilankabluewhalesnorkeling?igsh=MWl1OHl2YzdjaDhmYg==" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-square me-1" href="https://www.google.com/maps?ll=5.944071,80.460657&z=16&t=m&hl=en&gl=LK&mapclient=embed&cid=5718689178518660128" target="_blank"><i class="fas fa-map-marker-alt"></i></a>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Get In Touch</h5>
                <p><i class="fa fa-map-marker-alt me-3"></i>R. Situm, 214, A2, Mirissa</p>
                <p><i class="fa fa-phone-alt me-3"></i>+94 70 205 0138</p>
                <p>
                    <i class="fa fa-envelope me-3"></i>
                    <a href="mailto:info@mirissabaybluewhalesnorkelingtour.com" title="mirissabaydiving@gmail.com">
                        mirissabaydiving@gmail.com
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
                <p class="mb-1">Monday - Sunday</p>
                <h6 class="text-light">06:00 am - 10:00 pm</h6>
            </div>
        </div>
    </div>
    <div class="container-fluid copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="#">mirissabaydiving</a>, All Right Reserved.
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
<a href="#" id="whatsappFloatBtn" class="whatsapp-float">
    <img src="{{ asset (env('ASSET_PREFIX', '').'img/whatsapp_l_size.png')}}" alt="Chat on WhatsApp"> 
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
    document.getElementById("whatsappFloatBtn").addEventListener("click", function (e) {
        e.preventDefault(); // Prevent immediate redirect

        fetch('/log-whatsapp-click', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                action: 'whatsapp_floating_click',
                phone: '94702050138'
            })
        })
        .then(response => response.json())
        .then(data => {
            window.open("https://wa.me/94702050138", "_blank");
        })
        .catch(error => {
            console.error("Logging failed", error);
            window.open("https://wa.me/94702050138", "_blank");
        });
    });
</script>
 

</body>
</html>