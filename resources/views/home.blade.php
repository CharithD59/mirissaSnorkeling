@include('header')

<!-- Carousel Start -->

<div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <video class="w-100" autoplay muted loop playsinline>
                <source src="{{ asset (env('ASSET_PREFIX', '').'img/carousel-1.mp4')}}" type="video/mp4"> 
                Your browser does not support the video tag.
            </video>
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 900px;">
                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Let's Ride A Wave</h5>
                    <h2 class="display-1 text-white mb-md-4 animated zoomIn">Take Your Dive To The Next Level</h2>
                    <a href="view_booking_page" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Book Now</a>
                    <a href="/#contact_section" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <video class="w-100" autoplay muted loop playsinline>
                <source src="{{ asset (env('ASSET_PREFIX', '').'img/carousel-2.mp4')}}" type="video/mp4"> 
                Your browser does not support the video tag.
            </video>
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 900px;">
                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Blue Whale Tours</h5>
                    <h2 class="display-2 text-white mb-md-4 animated zoomIn">Mirissa Bay Diving Snorkeling and Blue Whale Tour</h2>
                    <a href="view_booking_page" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Book Now</a>
                    <a href="/#contact_section" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <video class="w-100" autoplay muted loop playsinline>
                <source src="{{ asset (env('ASSET_PREFIX', '').'img/carousel-3.mp4')}}" type="video/mp4"> 
                Your browser does not support the video tag.
            </video>
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 900px;">
                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Discoover Scuba Diving In Sri Lanka</h5>
                    <h2 class="display-1 text-white mb-md-4 animated zoomIn">A New Discovery Awaits</h2>
                    <a href="view_booking_page" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Book Now</a>
                    <a href="/#contact_section" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Carousel End -->

<!-- Banner Section Start -->

<section class="banner-section">
    <div class="banner-container">
        <div class="banner">
            <div class="background-pattern"></div>
            <div class="wave-animation"></div>
            <div class="whale-illustration">🐋</div>
            
            <div class="content-wrapper">
                <!-- Left: Main Text -->
                <div class="text-content">
                    <div class="badge">Marine Wildlife Experience</div>
                    <h1 style="color: #f0f8ff;">🐋 Blue Whales – The <span class="highlight">Gentle Giants</span> of Mirissa</h1>
                    
                    <p class="intro">
                        Did you know the <strong>Blue Whale</strong> is the largest animal ever to live on Earth 🌍 — even bigger than dinosaurs? 
                        Join us in Mirissa for an unforgettable adventure with these ocean giants.
                    </p>

                    <div class="facts-container">
                        <div class="fact-item">
                            <div class="fact-icon">📏</div>
                            <div class="fact-text">22–27 meters long (that’s 3 buses 🚍🚍🚍)</div>
                        </div>
                        <div class="fact-item">
                            <div class="fact-icon">👩‍🦱</div>
                            <div class="fact-text">Females are usually larger than males</div>
                        </div>
                        <div class="fact-item">
                            <div class="fact-icon">🐋</div>
                            <div class="fact-text">Record: 33 meters long, 150 tons (1926)</div>
                        </div>
                        <div class="fact-item">
                            <div class="fact-icon">⚖️</div>
                            <div class="fact-text">As heavy as 2,700 people combined</div>
                        </div>
                        <div class="fact-item">
                            <div class="fact-icon">❤️</div>
                            <div class="fact-text">Heart the size of a car 🚗</div>
                        </div>
                        <div class="fact-item">
                            <div class="fact-icon">🔊</div>
                            <div class="fact-text">Loudest animal on Earth, heard hundreds of km away</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Visual/Extra Info -->
                <div class="visual-content">

                    <div class="season-info">
                        <div class="season-icon">🌴</div>
                        <div class="season-text">
                            Why <strong>Mirissa</strong>?  
                            It’s one of the <em>world’s best places</em> to see Blue Whales up close, 
                            along with Sperm Whales and playful Dolphins 🐬 — just a short ride from shore.
                        </div>
                    </div>

                    <div class="season-info">
                        <div class="season-icon">👉</div>
                        <div class="season-text">
                            Join us in <strong>Mirissa</strong> and witness the largest animals on Earth in their natural home.  
                            A once-in-a-lifetime adventure awaits! 🐋🌊
                        </div>
                    </div>
                    
                    <br><br>
                    <a href="view_booking_page" class="cta-button">
                        Join a Whale Watching Tour 🐋
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Banner Section End -->

<!-- Banner Section Start -->

<section class="container py-3">
    <section class="wantToWork-area" 
        style="background-image: url('{{ asset (env('ASSET_PREFIX', '').'img/section_bg01.png') }}'); background-size: cover; background-position: center;">

        <div class="wants-wrapper w-padding2">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-8 col-lg-9 col-md-7">
                    <div class="wantToWork-caption wantToWork-caption2">
                        <h2>Contact Us on WhatsApp Anytime!</h2>
                        <p>Reach out to us instantly for inquiries, bookings, or support. Click below to chat with us on WhatsApp</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5">
                    <a href="#" id="whatsappBtn" class="btn wantToWork-btn btn btn-primary py-3 px-5">
                        <img src="{{ asset (env('ASSET_PREFIX', '').'img/whatsapp_s_size.png')}}" alt=""> Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
</section>

<!-- Banner Section End -->

<!-- About Start -->
<div class="container-xxl py-3" id="aboutus_section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="section-title position-relative pb-3 mb-3">
                    <h5 class="fw-bold text-primary text-uppercase">About Us</h5>
                    <h1 class="display-6 mb-0">Let us make your diving experience unforgettable</h1>
                </div>
                <p class="mb-4">Dive into the beauty of Mirissa Bay with our Diving, Snorkeling, and Blue Whale Tours. Discover vibrant coral reefs, swim with colorful marine life, and experience the awe of seeing majestic blue whales. Perfect for adventurers and nature lovers, we promise an unforgettable ocean experience.</p>
                <p class="fw-medium text-primary"><i class="fa fa-check text-success me-3"></i>Satisfaction Gurantee</p>
                <p class="fw-medium text-primary"><i class="fa fa-check text-success me-3"></i>Complete Equipment</p>
                <p class="fw-medium text-primary"><i class="fa fa-check text-success me-3"></i>Experienced Skipper & Divers</p>
                <div class="bg-primary d-flex align-items-center p-4 mt-5">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt fa-2x text-primary"></i>
                    </div>
                    <div class="ms-3">
                        <p class="fs-5 fw-medium mb-2 text-white">More About Us 24/7</p>
                        <h3 class="m-0">702050138</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pt-2" style="min-height: 500px;">
                <div class="position-relative h-100 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="position-absolute img-fluid w-100 h-100" src="{{ asset (env('ASSET_PREFIX', '').'img/about-4.jpg')}}" style="object-fit: cover; padding: 0 0 50px 100px;" alt="Snorkeling">
                    <img class="position-absolute start-0 bottom-0 img-fluid bg-white pt-2 pe-2 w-50 h-50" src="{{ asset (env('ASSET_PREFIX', '').'img/about-2.jpg')}}" style="object-fit: cover;" alt="Snorkeling">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Services Start -->
 <div class="container-fluid py-2 wow fadeInUp" data-wow-delay="0.1s" id="services_section">
    <div class="container">
        <div class="row g-2">
            <div class="section-title text-center position-relative pb-3 mb-2 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Our Services</h5>
                <h2 class="display-6 mb-0">What Services We Have</h2>
            </div>
            <div class="col-lg-12">
                <div class="owl-carousel price-carousel wow zoomIn" data-wow-delay="0.9s">

                    <div class="price-item pb-4">
                        <div class="position-relative">
                            <img class="img-fluid rounded-top" src="{{ asset (env('ASSET_PREFIX', '').'img/price-4.png')}}" alt="Snorkeling">
                        </div>
                        <div class="position-relative text-center bg-light border-bottom border-primary py-2 p-4">
                            <h4>Blue Whale Watching</h4>
                            <hr class="text-primary w-50 mx-auto mt-0">
                            <div class="d-flex justify-content-between mb-3"><span>Pickup 6 am</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Breakfast Tea, Coffee,Fruits</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Water Bottles</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>3 to 5 Hrs</span><i class="fa fa-check text-primary pt-1"></i></div>
                        </div>
                    </div>

                    <div class="price-item pb-4">
                        <div class="position-relative">
                            <img class="img-fluid rounded-top" src="{{ asset (env('ASSET_PREFIX', '').'img/price-14.jpg')}}" alt="Snorkeling">
                        </div>
                        <div class="position-relative text-center bg-light border-bottom border-primary py-2 p-4">
                            <h4>Blue Whale Snorkeling</h4>
                            <hr class="text-primary w-50 mx-auto mt-0">
                            <div class="d-flex justify-content-between mb-3"><span>Pickup 6 am</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Breakfast Tea, Coffee,Fruits</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Water Bottles</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>3 to 5 Hrs</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Swimming Equipments</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Gopro Camera</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Tirtule, Dolphin Watching</span><i class="fa fa-check text-primary pt-1"></i></div>
                        </div>
                    </div>

                    <div class="price-item pb-4">
                        <div class="position-relative">
                            <img class="img-fluid rounded-top" src="{{ asset (env('ASSET_PREFIX', '').'img/price-15.png')}}" alt="Snorkeling">
                        </div>
                        <div class="position-relative text-center bg-light border-bottom border-primary py-2 p-4">
                            <h4>Dolpin Snorkeling</h4>
                            <hr class="text-primary w-50 mx-auto mt-0">
                            <div class="d-flex justify-content-between mb-3"><span>Pickup Best Time 6 - 10 am</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Breakfast Tea, Coffee,Fruits</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>3 Hrs to 4 Hrs</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Swimming Equipments</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Gopro Camera</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Water Bottles</span><i class="fa fa-check text-primary pt-1"></i></div>
                        </div>
                    </div>

                    <div class="price-item pb-4">
                        <div class="position-relative">
                            <img class="img-fluid rounded-top" src="{{ asset (env('ASSET_PREFIX', '').'img/price-7.jpg')}}" alt="Snorkeling">
                        </div>
                        <div class="position-relative text-center bg-light border-bottom border-primary py-2 p-4">
                            <h4>Turtle Snorkeling Shallow Water</h4>
                            <hr class="text-primary w-50 mx-auto mt-0">
                            <div class="d-flex justify-content-between mb-3"><span>Best Time 8am to 1pm</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Swimming Equipments</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Gopro Camera</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>2 Hours tour </span><i class="fa fa-check text-primary pt-1"></i></div>
                        </div>
                    </div>

                    <!-- <div class="price-item pb-4">
                        <div class="position-relative">
                            <img class="img-fluid rounded-top" src="{{ asset (env('ASSET_PREFIX', '').'img/price-8.jpg')}}" alt="Snorkeling">
                        </div>
                        <div class="position-relative text-center bg-light border-bottom border-primary py-2 p-4">
                            <h4>Diving</h4>
                            <hr class="text-primary w-50 mx-auto mt-0">
                            <div class="d-flex justify-content-between mb-3"><span>Pickup All Day</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Swimming Equipments</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Gopro Camera</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>3 Hrs</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Fruit</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Water Bottles</span><i class="fa fa-check text-primary pt-1"></i></div>
                        </div>
                    </div> -->

                    <div class="price-item pb-4">
                        <div class="position-relative">
                            <img class="img-fluid rounded-top" src="{{ asset (env('ASSET_PREFIX', '').'img/price-9.jpg')}}" alt="Snorkeling">
                        </div>
                        <div class="position-relative text-center bg-light border-bottom border-primary py-2 p-4">
                            <h4>Deep Sea Fishing Tour</h4>
                            <hr class="text-primary w-50 mx-auto mt-0">
                            <div class="d-flex justify-content-between mb-3"><span>Pickup 6am</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Breakfast Fruits</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>3 Hrs</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Swimming Equipments</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Gopro Camera</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Water Bottles</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Fishing, Jumping Fishing</span><i class="fa fa-check text-primary pt-1"></i></div>
                        </div>
                    </div>

                    <div class="price-item pb-4">
                        <div class="position-relative">
                            <img class="img-fluid rounded-top" src="{{ asset (env('ASSET_PREFIX', '').'img/price-10.jpg')}}" alt="Snorkeling">
                        </div>
                        <div class="position-relative text-center bg-light border-bottom border-primary py-2 p-4">
                            <h4>Discovery scuba diving DSD</h4>
                            <hr class="text-primary w-50 mx-auto mt-0">
                            <div class="d-flex justify-content-between mb-3"><span>Pickup 8am 2pm and Drop</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Breakfast Fruits</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>3 hrs ~ 2 Diving Shallow Water Training 8 Meters 2nd Diving 15 Meters</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Swimming Equipments</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Gopro Camera</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Water Bottles</span><i class="fa fa-check text-primary pt-1"></i></div>
                        </div>
                    </div>

                    <!-- <div class="price-item pb-4">
                        <div class="position-relative">
                            <img class="img-fluid rounded-top" src="{{ asset (env('ASSET_PREFIX', '').'img/price-11.jpg')}}" alt="Snorkeling">
                        </div>
                        <div class="position-relative text-center bg-light border-bottom border-primary py-2 p-4">
                            <h4>Surf Lesson</h4>
                            <hr class="text-primary w-50 mx-auto mt-0">
                            <div class="d-flex justify-content-between mb-3"><span>Starting 8am 2pm and Drop</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Takes around 1.5 to 2 hours</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Choose 3 Beaches</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Swimming Equipments</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>Surfboard & Guide</span><i class="fa fa-check text-primary pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-2"><span>Water Bottles</span><i class="fa fa-check text-primary pt-1"></i></div>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->

<!-- Why Choose Us Start -->

<div class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Column: Text -->
            <div class="col-lg-6 mb-5">
                <small class="bg-primary text-white text-uppercase font-weight-bold px-2 py-1 rounded">Why Choose Us</small>
                <h1 class="mt-3 mb-3">Your Ultimate Marine Adventure in Mirissa</h1>
                <p class="text-muted mb-4">
                    Enjoy a safe, comfortable, and unforgettable adventure on the waters of Mirissa with our expert team.
                </p>
                <div class="mb-4">
                    <p class="mb-2">
                        <i class="fa fa-check-circle text-primary me-2"></i>Eco-Friendly & Safe Marine Experiences
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-check-circle text-primary me-2"></i>Professional & Experienced Crew
                    </p>
                </div>
                <a href="/view_booking_page" class="btn btn-primary btn-lg">Book Your Adventure</a>
            </div>

            <!-- Right Column: Stats Cards -->
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="card shadow-sm text-center border-0 rounded-3 p-4 hover-shadow">
                            <h2 class="display-4 text-primary mb-2" data-toggle="counter-up">20+</h2>
                            <p class="fw-bold mb-0">Years of Experience</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card shadow-sm text-center border-0 rounded-3 p-4 hover-shadow">
                            <h2 class="display-4 text-primary mb-2" data-toggle="counter-up">8960+</h2>
                            <p class="fw-bold mb-0">Happy Travelers</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card shadow-sm text-center border-0 rounded-3 p-4 hover-shadow">
                            <h2 class="display-4 text-primary mb-2" data-toggle="counter-up">25+</h2>
                            <p class="fw-bold mb-0">Adventure Options</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card shadow-sm text-center border-0 rounded-3 p-4 hover-shadow">
                            <h2 class="display-4 text-primary mb-2" data-toggle="counter-up">100%</h2>
                            <p class="fw-bold mb-0">Eco-Friendly & Safe Tours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}
</style>

<!-- Why Choose Us End -->

<!-- Gallery Start -->
<div class="container-xxl py-3" id="gallery_section">
    <div class="container">
        <div class="row g-5 mb-5 align-items-end wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-lg-6">
                <p><span class="text-primary me-2">#</span>Our Gallery</p>
                <h2 class="display-6 mb-0">
                    Let`s See Our <span class="text-primary">Gallery</span> Awsome
                    Memories
                </h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a class="btn btn-primary py-3 px-5" href="">Explore More Images</a>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-4">
                    <div class="col-12">
                        <a class="animal-item" href="{{ asset (env('ASSET_PREFIX', '').'img/gallery-1.jpg')}}" data-lightbox="animal"> 
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset (env('ASSET_PREFIX', '').'img/gallery-1.jpg')}}" alt="Snorkeling" />
                                <div class="animal-text p-4">
                                    <p class="text-white small text-uppercase mb-0">12/09/2024</p>
                                    <h5 class="text-white mb-0">Mirissa sri lanka</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="animal-item" href="{{ asset (env('ASSET_PREFIX', '').'img/gallery-2.jpeg')}}" data-lightbox="animal">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset (env('ASSET_PREFIX', '').'img/gallery-2.jpeg')}}" alt="Snorkeling" />
                                <div class="animal-text p-4">
                                    <p class="text-white small text-uppercase mb-0">12/09/2024</p>
                                    <h5 class="text-white mb-0">Mirissa sri lanka</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="row g-4">
                    <div class="col-12">
                        <a class="animal-item" href="{{ asset (env('ASSET_PREFIX', '').'img/gallery-7.jpeg')}}" data-lightbox="animal">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset (env('ASSET_PREFIX', '').'img/gallery-7.jpeg')}}" alt="Snorkeling" />
                                <div class="animal-text p-4">
                                    <p class="text-white small text-uppercase mb-0">12/09/2024</p>
                                    <h5 class="text-white mb-0">Mirissa sri lanka</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="animal-item" href="{{ asset (env('ASSET_PREFIX', '').'img/gallery-4.jpg')}}" data-lightbox="animal">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset (env('ASSET_PREFIX', '').'img/gallery-4.jpg')}}" alt="Snorkeling" />
                                <div class="animal-text p-4">
                                    <p class="text-white small text-uppercase mb-0">12/09/2024</p>
                                    <h5 class="text-white mb-0">Mirissa sri lanka</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="row g-4">
                    <div class="col-12">
                        <a class="animal-item" href="{{ asset (env('ASSET_PREFIX', '').'img/gallery-5.jpg')}}" data-lightbox="animal">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset (env('ASSET_PREFIX', '').'img/gallery-5.jpg')}}" alt="Snorkeling" />
                                <div class="animal-text p-4">
                                    <p class="text-white small text-uppercase mb-0">12/09/2024</p>
                                    <h5 class="text-white mb-0">Mirissa sri lanka</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="animal-item" href="{{ asset (env('ASSET_PREFIX', '').'img/gallery-6.jpg')}}" data-lightbox="animal">
                            <div class="position-relative">
                                <img class="img-fluid" src="{{ asset (env('ASSET_PREFIX', '').'img/gallery-6.jpg')}}" alt="Snorkeling" />
                                <div class="animal-text p-4">
                                    <p class="text-white small text-uppercase mb-0">12/09/2024</p>
                                    <h5 class="text-white mb-0">Mirissa sri lanka</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Gallery End -->

<!-- Reviews Start -->
<div class="container" id="reviews_section">
    <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
        <h5 class="fw-bold text-primary text-uppercase">Testimonial</h5>
        <h2 class="display-6 mb-0">What Clients Say About Us</h2>
    </div>
    
    <div class="reviews-container">
        <div class="reviews-header">
        <div class="google-rating">
            <div>
                <div class="rating-number">EXCELLENT</div>
                <div class="rating-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                
                <!-- Google Logo instead of review text -->
                <a href="https://www.google.com/search?hl=en-LK&gl=lk&q=Mirissa+Bay+Diving+Blue+Whale+Turtle+Snorkeling,+Badugoda,+R.+Situm,+214,+A2,+Mirissa&ludocid=5718689178518660128&lsig=AB86z5V5df7w480jxPbg3AgRGDEO#lrd=0x3ae1159bd02c3cc7:0x4f5cdd824a79a420,1,,,,"
                target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" 
                        alt="Google Reviews" 
                        style="height: 34px; margin-top: 8px;">
                </a>
            </div>
        </div>
        
        <div class="review-buttons">
            <button class="view-reviews-btn" onclick="window.open('https://www.google.com/search?hl=en-LK&gl=lk&q=Mirissa+Bay+Diving+Blue+Whale+Turtle+Snorkeling,+Badugoda,+R.+Situm,+214,+A2,+Mirissa&ludocid=5718689178518660128&lsig=AB86z5V5df7w480jxPbg3AgRGDEO#lrd=0x3ae1159bd02c3cc7:0x4f5cdd824a79a420,1,,,,', '_blank')">
                <i class="fas fa-star"></i> View Google Reviews
            </button>
            
            <button class="add-review-btn" onclick="window.open('https://search.google.com/local/writereview?placeid=ChIJxzws0JsV4ToRIKR5SoLdXE8', '_blank')">
                <i class="fab fa-google"></i> Add Google Review
            </button>
        </div>
    </div>

        
        <!-- Carousel Container -->
        <div class="reviews-carousel owl-carousel owl-theme">
            <!-- Review 1 -->
            <div class="review-card item">
                <div class="review-header">
                    <div class="reviewer-info">
                        <div class="reviewer-name">Mikal Mikal</div>
                        <div class="review-date">a month ago</div>
                    </div>
                    <div class="google-logo">
                        <div class="google-g">
                            <div class="g-line"></div>
                            <span class="red"></span>
                            <span class="yellow"></span>
                            <span class="green"></span>
                            <span class="blue"></span>
                        </div>
                    </div>
                </div>
                <div class="review-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="review-content">
                    Really good experience.we had a great time we found this guy name krishanta he told us we can see whales, dolphins and turtles so we booked a tour form him he picked us up from our hotel at 6.00 o clock in the morning then he bring us to his diving centre then he give us the equipment like life jackets then we got in to his boat
                    after 30 minutes we saw our first whale so we started the snorkeling after 45 minutes we lost the whale so krishanta start searching he called his friend and got a location for a whale after 30 minutes we could not find a whale but we found a group of dolphins and we started speaking them after like 1 hour krishanta got a call from his friend they found whale so we started moving 40 minutes late we got to see the most beautiful thing in our lives
                    there was 3 whales in same place in the rest of our time we started snowing them after 2 hours we had to head back so we started to head back when we are in the beach I asked krishanta we didn't see any turtles and he told we are going to see them now and told us jump  in to the water and we saw 10 to 15 turtles
                    This the best day of my life

                    High recommended!!
                </p>
                <div class="review-helpful">
                    <i class="far fa-thumbs-up"></i> People found this helpful
                </div>
            </div>

            <!-- Review 2 -->
            <div class="review-card item">
                <div class="review-header">
                    <div class="reviewer-info">
                        <div class="reviewer-name">Nithish kumar</div>
                        <div class="review-date">5 months ago</div>
                    </div>
                    <div class="google-logo">
                        <div class="google-g">
                            <div class="g-line"></div>
                            <span class="red"></span>
                            <span class="yellow"></span>
                            <span class="green"></span>
                            <span class="blue"></span>
                        </div>
                    </div>
                </div>
                <div class="review-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="review-content">
                    Chartering his boat for 8 days.
                </p>
                <p class="review-content">
                    Happy new year 2020 with Blue Whale, The Biggest Sea Mammal in the world,  this year as well !!! Great trip here in Mirissa.
                </p>
                <p class="review-content">
                   Chartering his boat for 7 days.
                </p>
                <p class="review-content">
                    Kesa, the owner, is definitely the Best Skipper in Mirissa area. A lot of diving-service-shop-skippers call to him everyday to get some information before their going to the sea. Best for whale watching and photographing.
                </p>
                <div class="review-images">
                    <img class="review-image" src="{{ asset (env('ASSET_PREFIX', '').'img/review-14.png')}}" alt="Fishing trip">
                </div>
                <div class="review-helpful">
                    <i class="far fa-thumbs-up"></i> People found this helpful
                </div>
            </div>

            <!-- Review 3 -->
            <div class="review-card item">
                <div class="review-header">
                    <div class="reviewer-info">
                        <div class="reviewer-name">Lilian G</div>
                        <div class="review-date">Reviewed April 8, 2019</div>
                    </div>
                    <div class="tripadvisor-logo">
                        <div class="owl">
                            <div class="eye left">
                            <div class="pupil"></div>
                            </div>
                            <div class="eye right">
                            <div class="pupil"></div>
                            </div>
                        </div>
                        <span class="text">Tripadvisor</span>
                    </div>
                </div>
                <div class="review-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="review-content">
                    We had a full day with Skipper and his friend on the sea. At first we sailed for 2-3 hours on the sea to wait until the big boats went back to the harbor from whale watching. After that we soon saw 1 big whale which we snorkeled with. Two images below are from that first dive! So that was really worth waiting for, but the day became even better when we found another whale alone. We could have a really good look under water at the biggest creature on earth! After that we saw a whale couple, and followed them for a long time. One of them even swam really close under the boat! Skipper and his friend are real experts and really made this an unforgettable experience!!
                    Allow yourself a once in a lifetime experience, wait and trust on Skipper and his friend. It can be a bumpy ride when the sea is rough, so be prepared and don’t forget to bring sun cream!
                </p>
                <div class="review-images">
                    <img class="review-image" src="{{ asset (env('ASSET_PREFIX', '').'img/review-15.jpg')}}" alt="Review-04">
                    <img class="review-image" src="{{ asset (env('ASSET_PREFIX', '').'img/review-16.jpg')}}" alt="Review-05">
                </div>
                <div class="review-helpful">
                    <i class="far fa-thumbs-up"></i> People found this helpful
                </div>
            </div>
            
            <!-- Review 4 -->
            <div class="review-card item">
                <div class="review-header">
                    <div class="reviewer-info">
                        <div class="reviewer-name">Siddharth Kotamraju</div>
                        <div class="review-date">5 months ago</div>
                    </div>
                    <div class="google-logo">
                        <div class="google-g">
                            <div class="g-line"></div>
                            <span class="red"></span>
                            <span class="yellow"></span>
                            <span class="green"></span>
                            <span class="blue"></span>
                        </div>
                    </div>
                </div>
                <div class="review-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="review-content">
                    Best experience. Kesa was very helpful and we got great views underwater. With good quality video. Best place to watch Blue whales and snorkel with them.
                </p>
                <div class="review-images">
                    <img class="review-image" src="{{ asset (env('ASSET_PREFIX', '').'img/review-13.jpg')}}" alt="Review-04">
                </div>
                <div class="review-helpful">
                    <i class="far fa-thumbs-up"></i> People found this helpful
                </div>
            </div>

            <!-- Review 5 -->
            <div class="review-card item">
                <div class="review-header">
                    <div class="reviewer-info">
                        <div class="reviewer-name">666yuton</div>
                        <div class="review-date">Reviewed January 10, 2019</div>
                    </div>
                    <div class="tripadvisor-logo">
                        <div class="owl">
                            <div class="eye left">
                            <div class="pupil"></div>
                            </div>
                            <div class="eye right">
                            <div class="pupil"></div>
                            </div>
                        </div>
                        <span class="text">Tripadvisor</span>
                    </div>
                </div>
                <div class="review-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="review-content">
                    Kesa, the owner, is definitely the Best Skipper in Mirissa area. A lot of diving-service-shop-skippers call to him everyday to get some information before their going to the sea. Best for whale watching and photographing.
                    See my Instagram account and check out my works here in Mirissa.
                </p>
                <div class="review-helpful">
                    <i class="far fa-thumbs-up"></i> People found this helpful
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Reviews End -->

<!-- Add Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- Add jQuery and Owl Carousel JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
    $(document).ready(function(){
        $('.reviews-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    });
</script>

<!-- Contact Start -->
<div class="container-fluid wow fadeInUp" data-wow-delay="0.1s" id="contact_section">
    <div class="container py-3">
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Contact Us</h5>
            <h2 class="display-6 mb-0">If You Have Any Query, Feel Free To Contact Us</h2>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Call to ask any question</h5>
                        <h4 class="text-primary mb-0">+94 70 205 0138</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-envelope-open text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Email to get free quote</h5>
                        <h4 class="text-primary mb-0" style="text-transform: lowercase;">
                            <a href="" class="text-primary" title="mirissabaydiving@gmail.com" target="_blank">
                                mirissabaydiving@gmail.com
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Visit our office</h5>
                        <h4 class="text-primary mb-0">R. Situm, 214, A2, Mirissa</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control border-0 bg-light px-4" placeholder="Your Name" id="cus_name" style="height: 55px;">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control border-0 bg-light px-4" placeholder="Your Email" id="email" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control border-0 bg-light px-4" placeholder="Contact Number" id="mobi_num" style="height: 55px;">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control border-0 bg-light px-4 py-3" rows="4" id="message" placeholder="Message"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" onclick="saveContact_page();" id="contactBtn" value="S E N D  M E S S A G E" type="button">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                <iframe class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.3668856612003!2d80.4606568!3d5.9440713999999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae1159bd02c3cc7%3A0x4f5cdd824a79a420!2sMirissa%20Bay%20Diving%20Snorkeling%20and%20Blue%20Whale%20Tour!5e0!3m2!1sen!2slk!4v1735471284905!5m2!1sen!2slk"
                    frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<script>

function saveContact_page() {

    document.getElementById('contactBtn').value = 'required';

    const cus_name      = document.getElementById('cus_name').value;
    const email     = document.getElementById('email').value;
    const mobi_num    = document.getElementById('mobi_num').value;
    const message   = document.getElementById('message').value;

    if(cus_name == "" || email == "" || mobi_num == "" || message == ""){

        Swal.fire({
                        position: 'center',
                        imageUrl: '{{"public/img/logo.png"}}',
                        imageHeight: 60,
                        imageAlt: 'logo',
                        color: '#121518',
                        text: 'Please complete all required fields',
                        showConfirmButton: true,
                        confirmButtonColor: '#fdbe33',
                        timer: 3000
                    }).then((result) => {

                    })

    }else{

        document.getElementById('contactBtn').value = 'Sending…';

        $.ajax({

            url: 'send_contact_mail',
            type: 'GET',
            data: {
                cus_name: cus_name,
                email: email,
                mobi_num: mobi_num,
                message: message,
            },
            success: function (response) {

                if(response === 'success'){

                    document.getElementById('contactBtn').value = 'Send Message';

                    Swal.fire({
                        position: 'center',
                        imageUrl: '{{"public/img/logo.png"}}',
                        imageHeight: 60,
                        imageAlt: 'logo',
                        color: '#121518',
                        text: 'Thank you for getting in touch! We appreciate you contacting us',
                        showConfirmButton: false,
                        timer: 2500
                    }).then((result) => {

                        document.getElementById('cus_name').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('mobi_num').value = '';
                        document.getElementById('message').value = '';

                        // window.location.href = 'view_contact_page';
                    })
                }else{
                    Swal.fire({
                        position: 'center',
                        imageUrl: '{{"public/img/logo.png"}}',
                        imageHeight: 60,
                        imageAlt: 'logo',
                        color: '#121518',
                        text: 'Oops! Somthing went wrong.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {

                        document.getElementById('cus_name').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('mobi_num').value = '';
                        document.getElementById('message').value = '';

                        // window.location.href = 'view_contact_page';
                    })
                }
            }

        })

    }

}

</script>

<script>

document.getElementById("whatsappBtn").addEventListener("click", function (e) {
    e.preventDefault(); // Prevent immediate redirect

    fetch('/log-whatsapp-click', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // if using Laravel
        },
        body: JSON.stringify({
            action: 'whatsapp_click',
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


@include('footer')