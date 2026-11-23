@include('header')

<!-- Carousel Start -->
@if(setting_on('home.show_hero'))
<div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach([1, 2, 3] as $slide)
            @php $media = setting('hero.' . $slide . '.media'); @endphp
            <div class="carousel-item {{ $slide === 1 ? 'active' : '' }}">
                @if(is_video_path($media))
                    <video class="w-100" autoplay muted loop playsinline>
                        <source src="{{ site_asset($media) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <img class="w-100" src="{{ site_asset($media) }}" alt="{{ setting('hero.' . $slide . '.title') }}">
                @endif
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">{{ setting('hero.' . $slide . '.subtitle') }}</h5>
                        <h2 class="{{ $slide === 2 ? 'display-2' : 'display-1' }} text-white mb-md-4 animated zoomIn">{{ setting('hero.' . $slide . '.title') }}</h2>
                        <a href="view_booking_page" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">{{ setting('hero.btn_book') }}</a>
                        <a href="/#contact_section" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">{{ setting('hero.btn_contact') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
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
@endif

<!-- Carousel End -->

<!-- Banner Section Start -->
@if(setting_on('home.show_facts'))
<section class="banner-section">
    <div class="banner-container">
        <div class="banner">
            <div class="background-pattern"></div>
            <div class="wave-animation"></div>
            <div class="whale-illustration">🐋</div>
            
            <div class="content-wrapper">
                <!-- Left: Main Text -->
                <div class="text-content">
                    <div class="badge">{{ setting('facts.badge') }}</div>
                    <h1 style="color: #f0f8ff;">{!! cms_highlight(setting('facts.heading'), 'highlight') !!}</h1>
                    
                    <p class="intro">
                        {!! cms_html(setting('facts.intro')) !!}
                    </p>

                    <div class="facts-container">
                        @foreach(cms_pairs('facts.items') as $fact)
                            <div class="fact-item">
                                <div class="fact-icon">{{ $fact['icon'] }}</div>
                                <div class="fact-text">{{ $fact['text'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Right: Visual/Extra Info -->
                <div class="visual-content">

                    <div class="season-info">
                        <div class="season-icon">🌴</div>
                        <div class="season-text">{!! cms_html(setting('facts.box1')) !!}</div>
                    </div>

                    <div class="season-info">
                        <div class="season-icon">👉</div>
                        <div class="season-text">{!! cms_html(setting('facts.box2')) !!}</div>
                    </div>
                    
                    <br><br>
                    <a href="view_booking_page" class="cta-button">
                        {{ setting('facts.btn_book') }}
                    </a>
                    <br>
                    <a href="view_blue_whale_snorkeling" class="cta-button">
                        {{ setting('facts.btn_more') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Banner Section End -->

<!-- Banner Section Start -->
@if(setting_on('home.show_whatsapp'))
<section class="container py-3">
    <section class="wantToWork-area" 
        style="background-image: url('{{ site_asset(setting('whatsapp.bg')) }}'); background-size: cover; background-position: center;">

        <div class="wants-wrapper w-padding2">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-8 col-lg-9 col-md-7">
                    <div class="wantToWork-caption wantToWork-caption2">
                        <h2>{{ setting('whatsapp.heading') }}</h2>
                        <p>{{ setting('whatsapp.text') }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5">
                    <a href="#" id="whatsappBtn" class="btn wantToWork-btn btn btn-primary py-3 px-5">
                        <img src="{{ asset (env('ASSET_PREFIX', '').'img/whatsapp_s_size.png')}}" alt=""> {{ setting('whatsapp.button') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</section>
@endif
<!-- Banner Section End -->

<!-- About Start -->
@if(setting_on('home.show_about'))
<div class="container-xxl py-3" id="aboutus_section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="section-title position-relative pb-3 mb-3">
                    <h5 class="fw-bold text-primary text-uppercase">{{ setting('about.label') }}</h5>
                    <h1 class="display-6 mb-0">{{ setting('about.heading') }}</h1>
                </div>
                <p class="mb-4">{{ setting('about.text') }}</p>
                @foreach(cms_lines('about.points') as $point)
                    <p class="fw-medium text-primary"><i class="fa fa-check text-success me-3"></i>{{ $point }}</p>
                @endforeach
                <div class="bg-primary d-flex align-items-center p-4 mt-5">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt fa-2x text-primary"></i>
                    </div>
                    <div class="ms-3">
                        <p class="fs-5 fw-medium mb-2 text-white">{{ setting('about.call_label') }}</p>
                        <h3 class="m-0">{{ setting('about.call_number') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pt-2" style="min-height: 500px;">
                <div class="position-relative h-100 wow fadeInUp" data-wow-delay="0.5s">
                    <img class="position-absolute img-fluid w-100 h-100" src="{{ site_asset(setting('about.image_main')) }}" style="object-fit: cover; padding: 0 0 50px 100px;" alt="Snorkeling">
                    <img class="position-absolute start-0 bottom-0 img-fluid bg-white pt-2 pe-2 w-50 h-50" src="{{ site_asset(setting('about.image_small')) }}" style="object-fit: cover;" alt="Snorkeling">
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- About End -->

<style>
    .price-tag {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #0d6efd;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1.2rem;
            z-index: 10;
        }
</style>

@if(setting_on('home.show_whale'))
<section class="banner_01">
    <div class="banner-container" onclick="window.location.href='{{ setting('whale.link') }}'">
        <div class="banner">
            <div class="ocean">
                <div class="wave"></div>
                <div class="wave"></div>
            </div>
            <div class="whale"></div>
            <div class="tail"></div>
            <div class="water-spout"></div>
            <div class="bubbles" id="bubbles"></div>
            <div class="content">
                <h1 class="title">{{ setting('whale.title') }}</h1>
                <p class="subtitle">{{ setting('whale.subtitle') }}</p>
                <button class="cta-button">{{ setting('whale.button') }}</button>
            </div>
        </div>
    </div>

    <script>
        // Create bubbles dynamically
        const bubblesContainer = document.getElementById('bubbles');
        
        for (let i = 0; i < 20; i++) {
            const bubble = document.createElement('div');
            bubble.classList.add('bubble');
            
            // Random properties for each bubble
            const size = Math.random() * 20 + 5;
            const left = Math.random() * 100;
            const animationDuration = Math.random() * 10 + 5;
            const animationDelay = Math.random() * 15;
            
            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.animationDuration = `${animationDuration}s`;
            bubble.style.animationDelay = `${animationDelay}s`;
            
            bubblesContainer.appendChild(bubble);
        }

        // Redirect when banner is clicked
        document.querySelector('.banner-container').addEventListener('click', function() {
            window.location.href = @json(setting('whale.link'));
        });
    </script>
</section>
@endif

<!-- Services Start -->
@if(setting_on('home.show_services') && $packages->count())
 <div class="container-fluid py-2 wow fadeInUp" data-wow-delay="0.1s" id="services_section">
    <div class="container">
        <div class="row g-2">
            <div class="section-title text-center position-relative pb-3 mb-2 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">{{ setting('services.label') }}</h5>
                <h2 class="display-6 mb-0">{{ setting('services.heading') }}</h2>
            </div>
            <div class="col-lg-12">
                <div class="owl-carousel price-carousel wow zoomIn" data-wow-delay="0.9s">
                    @foreach($packages as $package)
                        <div class="price-item pb-4">
                            <div class="position-relative">
                                @if($package->price_tag)
                                    <span class="price-tag">{{ $package->price_tag }}</span>
                                @endif
                                @if($package->image)
                                    <img class="img-fluid rounded-top" src="{{ site_asset($package->image) }}" alt="{{ $package->name }}">
                                @endif
                            </div>
                            <div class="position-relative text-center bg-light border-bottom border-primary py-2 p-4">
                                <h4>{{ $package->name }}</h4>
                                <hr class="text-primary w-50 mx-auto mt-0">
                                @foreach((array) $package->features as $feature)
                                    <div class="d-flex justify-content-between mb-3"><span>{{ $feature }}</span><i class="fa fa-check text-primary pt-1"></i></div>
                                @endforeach
                                @if($package->detail_url)
                                    <a href="{{ $package->detail_url }}" class="btn btn-primary py-2 px-4 position-absolute top-100 start-50 translate-middle">{{ setting('services.button') }}</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Services End -->

<!-- Why Choose Us Start -->
@if(setting_on('home.show_why'))

<div class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Column: Text -->
            <div class="col-lg-6 mb-5">
                <small class="bg-primary text-white text-uppercase font-weight-bold px-2 py-1 rounded">{{ setting('why.badge') }}</small>
                <h1 class="mt-3 mb-3">{{ setting('why.heading') }}</h1>
                <p class="text-muted mb-4">{{ setting('why.text') }}</p>
                <div class="mb-4">
                    @foreach(cms_lines('why.points') as $point)
                        <p class="mb-2">
                            <i class="fa fa-check-circle text-primary me-2"></i>{{ $point }}
                        </p>
                    @endforeach
                </div>
                <a href="/view_booking_page" class="btn btn-primary btn-lg">{{ setting('why.button') }}</a>
            </div>

            <!-- Right Column: Stats Cards -->
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="card shadow-sm text-center border-0 rounded-3 p-4 hover-shadow">
                            <h2 class="display-4 text-primary mb-2" data-toggle="counter-up">{{ setting('why.stat1_value') }}</h2>
                            <p class="fw-bold mb-0">{{ setting('why.stat1_label') }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card shadow-sm text-center border-0 rounded-3 p-4 hover-shadow">
                            <h2 class="display-4 text-primary mb-2" data-toggle="counter-up">{{ setting('why.stat2_value') }}</h2>
                            <p class="fw-bold mb-0">{{ setting('why.stat2_label') }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card shadow-sm text-center border-0 rounded-3 p-4 hover-shadow">
                            <h2 class="display-4 text-primary mb-2" data-toggle="counter-up">{{ setting('why.stat3_value') }}</h2>
                            <p class="fw-bold mb-0">{{ setting('why.stat3_label') }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card shadow-sm text-center border-0 rounded-3 p-4 hover-shadow">
                            <h2 class="display-4 text-primary mb-2" data-toggle="counter-up">{{ setting('why.stat4_value') }}</h2>
                            <p class="fw-bold mb-0">{{ setting('why.stat4_label') }}</p>
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
@endif
<!-- Why Choose Us End -->

<!-- Gallery Start -->
@if(setting_on('home.show_gallery'))
<div class="container-xxl py-3" id="gallery_section">
    <div class="container">
        <div class="row g-5 mb-5 align-items-end wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-lg-6">
                <p><span class="text-primary me-2">#</span>{{ setting('gallery.label') }}</p>
                <h2 class="display-6 mb-0">
                    {!! cms_highlight(setting('gallery.heading')) !!}
                </h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a class="btn btn-primary py-3 px-5" href="view_gallery_section">{{ setting('gallery.button') }}</a>
            </div>
        </div>
        <div class="row g-4">
            @foreach($homeGallery->chunk(2) as $index => $column)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.1 + ($loop->index * 0.2) }}s">
                    <div class="row g-4">
                        @foreach($column as $photo)
                            <div class="col-12">
                                <a class="animal-item" href="{{ site_asset($photo->image) }}" data-lightbox="animal">
                                    <div class="position-relative">
                                        <img class="img-fluid" src="{{ site_asset($photo->image) }}" alt="{{ $photo->alt ?: 'Snorkeling' }}" />
                                        <div class="animal-text p-4">
                                            @if($photo->caption)<p class="text-white small text-uppercase mb-0">{{ $photo->caption }}</p>@endif
                                            @if($photo->title)<h5 class="text-white mb-0">{{ $photo->title }}</h5>@endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- Gallery End -->

<!-- Reviews Start -->
@if(setting_on('home.show_reviews'))
<div class="container" id="reviews_section">
    <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
        <h5 class="fw-bold text-primary text-uppercase">{{ setting('reviews.label') }}</h5>
        <h2 class="display-6 mb-0">{{ setting('reviews.heading') }}</h2>
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
                <a href="{{ setting('reviews.google_url') }}"
                target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" 
                        alt="Google Reviews" 
                        style="height: 34px; margin-top: 8px;">
                </a>
            </div>
        </div>
        
        <div class="review-buttons">
            <button class="view-reviews-btn" onclick="window.open({{ json_encode(setting('reviews.google_url')) }}, '_blank')">
                <i class="fas fa-star"></i> View Google Reviews
            </button>
            
            <button class="add-review-btn" onclick="window.open({{ json_encode(setting('reviews.write_url')) }}, '_blank')">
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
@endif
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
@if(setting_on('home.show_contact'))
<div class="container-fluid wow fadeInUp" data-wow-delay="0.1s" id="contact_section">
    <div class="container py-3">
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">{{ setting('contact.label') }}</h5>
            <h2 class="display-6 mb-0">{{ setting('contact.heading') }}</h2>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">{{ setting('contact.call_label') }}</h5>
                        <h4 class="text-primary mb-0"><a href="tel:{{ preg_replace('/[^\d+]/', '', setting('contact.phone')) }}" class="text-primary">{{ setting('contact.phone') }}</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-envelope-open text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">{{ setting('contact.email_label') }}</h5>
                        <h4 class="text-primary mb-0" style="text-transform: lowercase;">
                            <a href="mailto:{{ setting('contact.email') }}" class="text-primary" title="{{ setting('contact.email') }}">
                                {{ setting('contact.email') }}
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
                        <h5 class="mb-2">{{ setting('contact.visit_label') }}</h5>
                        <h4 class="text-primary mb-0">{{ setting('contact.address_short') }}</h4>
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
                            <button class="btn btn-primary w-100 py-3" onclick="saveContact_page();" id="contactBtn" value="S E N D  M E S S A G E" type="button">{{ setting('contact.button') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
                <iframe class="position-relative rounded w-100 h-100"
                    src="{{ setting('contact.map_embed') }}"
                    frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endif
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
                        text: @json(setting('booking.success')),
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
            },
            error: function (xhr) {
                var msg = (xhr.status === 422 && xhr.responseText) ? xhr.responseText : 'Oops! Something went wrong. Please try again or contact us on WhatsApp.';
                Swal.fire({
                    position: 'center',
                    imageUrl: '{{ site_asset('img/logo.png') }}',
                    imageHeight: 60,
                    imageAlt: 'logo',
                    color: '#121518',
                    text: msg,
                    showConfirmButton: true,
                    confirmButtonColor: '#fdbe33'
                });
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
            phone: @json(setting('contact.whatsapp'))
        })
    })
    .then(response => response.json())
    .then(data => {
        window.open("https://wa.me/" + @json(setting('contact.whatsapp')), "_blank");
    })
    .catch(error => {
        console.error("Logging failed", error);
        window.open("https://wa.me/" + @json(setting('contact.whatsapp')), "_blank");
    });
});

</script>


@include('footer')