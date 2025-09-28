@include('header')

<style>
    /*---------------------
  About Page Header
-----------------------*/

.page-header_about {
    height: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(rgba(28, 31, 50, 0.9), rgba(31, 50, 28, 0.9)), url("{{ asset(env('ASSET_PREFIX', '') . 'img/whale.png') }}");
    background-attachment: fixed;
    object-fit: cover;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

@media (max-width: 991.98px) {
    .page-header_about {
        height: 300px;
    }
    .page-header_about h1 {
        text-align: center;
    }
}
</style>

<!-- Page Header Start -->
<div class="container-fluid page-header_about">
    <h1 class="display-3 text-uppercase text-white mb-3">WHALE SNORKELING MIRISSA</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="/">HOME</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">WHALE SNORKELING</h6>
    </div>
</div>
<!-- Page Header Start -->

<style>

    .tours_sec{
        background: linear-gradient(135deg, #e0f7ff 0%, #b3e0ff 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
    }

    .tours_sec .container {
        max-width: 1300px;
        width: 100%;
        text-align: center;
    }

    .tours_sec .header {
        margin-bottom: 50px;
    }

    .tours_sec h1 {
        color: #1a3c5a;
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .tours_sec .subtitle {
        color: #4a6b8a;
        font-size: 1.2rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .tours_sec .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        justify-content: center;
    }

    .tours_sec .card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .tours_sec .card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .tours_sec .card-header {
        padding: 25px 25px 15px;
        position: relative;
    }

    .tours_sec .card-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 28px;
        color: white;
    }

    .tours_sec .group-tour .card-icon {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
    }

    .tours_sec .private-single .card-icon {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
    }

    .tours_sec .private-couple .card-icon {
        background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
    }

    .tours_sec .card-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #e74c3c;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
    }

    .tours_sec .card-title {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #2c3e50;
    }

    .tours_sec .card-subtitle {
        font-size: 1rem;
        color: #7f8c8d;
        margin-bottom: 15px;
    }

    .tours_sec .card-price {
        font-size: 2.8rem;
        font-weight: 800;
        margin: 10px 0;
        color: #2c3e50;
    }

    .tours_sec .card-price span {
        font-size: 1.2rem;
        font-weight: 500;
        color: #7f8c8d;
    }

    .tours_sec .card-body {
        padding: 0 25px 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .tours_sec .features-list {
        list-style: none;
        text-align: left;
        margin-bottom: 25px;
        flex-grow: 1;
    }

    .tours_sec .features-list li {
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        color: #5a6c7d;
    }

    .tours_sec .features-list li:last-child {
        border-bottom: none;
    }

    .tours_sec .features-list li i {
        color: #2ecc71;
        margin-right: 12px;
        font-size: 1.1rem;
    }

    .tours_sec .card-footer {
        padding: 0 25px 25px;
    }

    .tours_sec .btn {
        display: inline-block;
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        padding: 14px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        width: 100%;
        font-size: 1.1rem;
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        position: relative;
        overflow: hidden;
    }

    .tours_sec .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(52, 152, 219, 0.5);
    }

    .tours_sec .btn:active {
        transform: translateY(1px);
    }

    .tours_sec .btn:after {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
    }

    .tours_sec .btn:hover:after {
        left: 100%;
    }

    .tours_sec .group-tour .btn {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
    }

    .tours_sec .private-single .btn {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
    }

    .tours_sec .private-couple .btn {
        background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
        box-shadow: 0 5px 15px rgba(155, 89, 182, 0.4);
    }

    .tours_sec .per-person {
        font-size: 0.9rem;
        color: #7f8c8d;
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .tours_sec .cards-container {
            grid-template-columns: 1fr;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .tours_sec h1 {
            font-size: 2.2rem;
        }
    }

    .tours_sec .water-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 20px;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="%23007cb3"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="%23007cb3"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="%23007cb3"/></svg>');
        background-size: cover;
        opacity: 0.1;
    }
</style>

<section class="tours_sec">
    <div class="container">
        <div class="header">
            <h1>Boat Tour Adventures</h1>
            <p class="subtitle">Experience the ocean like never before with our premium snorkeling tours. Choose the perfect package for your adventure!</p>
        </div>
        
        <div class="cards-container">
            <!-- Group Boat Tour Card -->
            <div class="card group-tour">
                <div class="water-wave"></div>
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-badge">Most Popular</div>
                    <h2 class="card-title">Group Boat Tour</h2>
                    <p class="card-subtitle">Join fellow adventurers</p>
                    <div class="card-price">$500<span>/4 People</span></div>
                </div>
                <div class="card-body">
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i>4-hour whale snorkeling experience</li>
                        <li><i class="fas fa-check"></i>Breakfast included</li>
                        <li><i class="fas fa-check"></i>Premium snorkeling equipment</li>
                        <li><i class="fas fa-check"></i>Free snorkeling with turtle tour</li>
                        <li><i class="fas fa-check"></i>GoPro camera for underwater memories</li>
                        <li><i class="fas fa-check"></i>Free hotel pick-up and drop-off</li>
                        <li><i class="fas fa-check"></i>Experienced marine guide</li>
                        <li><i class="fas fa-check"></i>Join a boat with a group</li>
                    </ul>
                </div>
            </div>

            <!-- Individual Group Rate Card -->
            <div class="card group-tour">
                <div class="water-wave"></div>
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h2 class="card-title">Group Rate</h2>
                    <p class="card-subtitle">Individual spot in group tour</p>
                    <div class="card-price">$125<span>/person</span></div>
                </div>
                <div class="card-body">
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i>4-hour whale snorkeling experience</li>
                        <li><i class="fas fa-check"></i>Breakfast included</li>
                        <li><i class="fas fa-check"></i>Premium snorkeling equipment</li>
                        <li><i class="fas fa-check"></i>Free snorkeling with turtle tour</li>
                        <li><i class="fas fa-check"></i>GoPro camera for underwater memories</li>
                        <li><i class="fas fa-check"></i>Free hotel pick-up and drop-off</li>
                        <li><i class="fas fa-check"></i>Experienced marine guide</li>
                        <li><i class="fas fa-check"></i>Join a boat with a group</li>
                    </ul>
                </div>
            </div>

            <!-- Private Boat Tour Single Card -->
            <div class="card private-single">
                <div class="water-wave"></div>
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-badge">Exclusive</div>
                    <h2 class="card-title">Private Boat Tour</h2>
                    <p class="card-subtitle">Solo adventurer experience</p>
                    <div class="card-price">$325<span>/person</span></div>
                </div>
                <div class="card-body">
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i>4-hour whale snorkeling experience</li>
                        <li><i class="fas fa-check"></i>Breakfast included</li>
                        <li><i class="fas fa-check"></i>Premium snorkeling equipment</li>
                        <li><i class="fas fa-check"></i>Free snorkeling with turtle tour</li>
                        <li><i class="fas fa-check"></i>GoPro camera for underwater memories</li>
                        <li><i class="fas fa-check"></i>Free hotel pick-up and drop-off</li>
                        <li><i class="fas fa-check"></i>Experienced marine guide</li>
                        <li><i class="fas fa-check"></i>Private boat just for you</li>
                    </ul>
                </div>
            </div>

            <!-- Private Boat Tour Couple Card -->
            <div class="card private-couple">
                <div class="water-wave"></div>
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="card-badge">Perfect for Couples</div>
                    <h2 class="card-title">Private Boat Tour</h2>
                    <p class="card-subtitle">Romantic adventure for two</p>
                    <div class="card-price">$400<span>/2 People</span></div>
                </div>
                <div class="card-body">
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i>4-hour whale snorkeling experience</li>
                        <li><i class="fas fa-check"></i>Breakfast included</li>
                        <li><i class="fas fa-check"></i>Premium snorkeling equipment</li>
                        <li><i class="fas fa-check"></i>Free snorkeling with turtle tour</li>
                        <li><i class="fas fa-check"></i>GoPro camera for underwater memories</li>
                        <li><i class="fas fa-check"></i>Free hotel pick-up and drop-off</li>
                        <li><i class="fas fa-check"></i>Experienced marine guide</li>
                        <li><i class="fas fa-check"></i>Private boat exclusively for you</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Add subtle animation to cards on page load
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 200 * index);
        });
    });
</script>

<!-- Whale Snorkeling Tours - Modern HTML + CSS paragraphs -->
<section class="tours-section" aria-labelledby="tours-heading">
  <div class="container">
    <h2 id="tours-heading">Whale & Snorkeling Tours — Choose Your Experience</h2>
    <p class="lead">Safe, professional and unforgettable — all tours include a licensed skipper, lifeguard, breakfast, snorkeling gear, GoPro photos and free turtle snorkeling.</p>

    <p class="tour-option"><strong>Team Boat Tour:</strong> A perfect choice for families, couples or small groups seeking an exclusive and personalized adventure. Enjoy the whole boat just for your team (maximum 4 people). For <span class="price">$500 per boat</span>, you’ll receive breakfast, all snorkeling equipment, free turtle snorkeling tour, GoPro camera, and free pick-up and drop-off within Mirissa. Guided by a professional licensed skipper and lifeguard.</p>

    <p class="tour-option"><strong>Private Boat Tour:</strong> Experience the ocean without distractions on your own private boat. This package includes breakfast, snorkeling equipment, sightings of whales and dolphins, a free turtle snorkeling tour, GoPro camera, and free pick-up and drop-off within Mirissa. Led by a licensed skipper and lifeguard for your safety and comfort.</p>

    <p class="tour-option"><strong>One Person Tour:</strong> Ideal for solo travelers or budget-conscious guests who wish to join a small group of whale lovers. For <span class="price">$300 per person</span>, enjoy breakfast, snorkeling equipment, free turtle snorkeling tour, GoPro camera, and pick-up and drop-off within Mirissa. With a professional licensed skipper and lifeguard accompanying you.</p>

    <p class="tour-option"><strong>Two Person Tour:</strong> A wonderful choice for couples looking for a private and romantic experience. For <span class="price">$350 per two people</span>, enjoy whale, dolphin, and turtle encounters along with breakfast, snorkeling gear, lifejackets, GoPro camera, and pick-up and drop-off within Mirissa. Supervised by a licensed skipper and lifeguard.</p>

    <p class="footnote">All tours depend on weather and nature’s rhythm. Safety is our first priority — your experience will always be guided by professionals.</p>
  </div>

  <style>
    .tours-section{background:linear-gradient(180deg,#f7fbff,#eef8ff);padding:48px 20px;}
    .tours-section .container{max-width:1300px;margin:0 auto;}
    .tours-section h2{font-size:1.8rem;margin-bottom:12px;}
    .tours-section .lead{color:#6b7280;margin-bottom:22px;}
    .tour-option{margin-bottom:20px;line-height:1.6;color:#334155;}
    .tour-option strong{color:#111827;}
    .price{color:#0d6efd;font-weight:600;}
    .footnote{color:#6b7280;font-size:0.9rem;margin-top:24px;}
    @media(max-width:600px){
      .tours-section{padding:28px 14px;}
      .tours-section h2{font-size:1.4rem;}
    }
  </style>
</section>

<!-- Modern Video Section -->
<section class="video-gallery" aria-labelledby="video-heading">
  <div class="container">
    <h2 id="video-heading">Experience the Adventure</h2>
    <p class="lead">Watch highlights from our recent whale snorkeling tours in Mirissa.</p>

    <div class="video-grid">
      <div class="video-item">
        <video autoplay muted loop playsinline>
          <source src="{{ asset (env('ASSET_PREFIX', '').'img/carousel-1.mp4')}}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
      <div class="video-item">
        <video autoplay muted loop playsinline>
          <source src="{{ asset (env('ASSET_PREFIX', '').'img/carousel-2.mp4')}}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
      <div class="video-item">
        <video autoplay muted loop playsinline>
          <source src="{{ asset (env('ASSET_PREFIX', '').'img/carousel-3.mp4')}}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
      <div class="video-item">
        <video autoplay muted loop playsinline>
          <source src="{{ asset (env('ASSET_PREFIX', '').'img/carousel-4.mp4')}}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>
  </div>

  <style>
    .video-gallery{background:#f9fafb;padding:48px 20px;}
    .video-gallery .container{max-width:1300px;margin:0 auto;}
    .video-gallery h2{font-size:1.8rem;margin-bottom:12px;}
    .video-gallery .lead{color:#6b7280;margin-bottom:22px;}

    .video-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;}
    .video-item{position:relative;overflow:hidden;border-radius:16px;box-shadow:0 8px 20px rgba(0,0,0,0.12);}
    .video-item video{width:100%;height:auto;display:block;border-radius:16px;object-fit:cover;}

    /* Vertical video aspect ratio */
    .video-item{aspect-ratio:9/16;background:#000;}
    .video-item video{height:100%;width:100%;object-fit:cover;}

    @media(max-width:600px){
      .video-gallery{padding:28px 14px;}
      .video-gallery h2{font-size:1.4rem;}
    }
  </style>
</section>


<style>

    .faq_sec {
        background: linear-gradient(135deg, #e0f7ff 0%, #b3e0ff 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
    }

    .faq_sec .container {
        max-width: 1100px;
        width: 100%;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .faq_sec .faq-header {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        padding: 40px 30px;
        text-align: center;
    }

    .faq_sec .faq-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 10px;
        color: #ffffff;
    }

    .faq_sec .faq-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .faq_sec .faq-content {
        padding: 40px 30px;
    }

    .faq_sec .faq-item {
        margin-bottom: 20px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid #eaeaea;
    }

    .faq_sec .faq-item.active {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: #3498db;
    }

    .faq_sec .faq-question {
        padding: 20px 25px;
        background: #f8fafc;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background 0.3s ease;
    }

    .faq_sec .faq-question:hover {
        background: #f0f5ff;
    }

    .faq_sec .faq-item.active .faq-question {
        background: linear-gradient(135deg, #f0f8ff 0%, #e1f0ff 100%);
        border-bottom: 1px solid #e1f0ff;
    }

    .faq_sec .faq-question h3 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }

    .faq_sec .faq-icon {
        color: #3498db;
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .faq_sec .faq-item.active .faq-icon {
        transform: rotate(180deg);
        color: #2c3e50;
    }

    .faq_sec .faq-answer {
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: all 0.4s ease;
        background: white;
    }

    .faq_sec .faq-item.active .faq-answer {
        padding: 25px;
        max-height: 500px;
    }

    .faq_sec .faq-answer p {
        color: #5a6c7d;
        line-height: 1.7;
        font-size: 1.05rem;
        margin: 0;
    }

    .faq_sec .contact-section {
        background: #f8fafc;
        padding: 30px;
        text-align: center;
        border-top: 1px solid #eaeaea;
    }

    .faq_sec .contact-title {
        font-size: 1.5rem;
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .faq_sec .contact-text {
        color: #5a6c7d;
        margin-bottom: 20px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .faq_sec .contact-btn {
        display: inline-block;
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
    }

    .faq_sec .contact-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(52, 152, 219, 0.5);
    }

    .faq_sec .contact-btn i {
        margin-right: 8px;
    }

    @media (max-width: 768px) {
        .faq_sec .faq-header {
            padding: 30px 20px;
        }
        
        .faq_sec .faq-title {
            font-size: 2rem;
        }
        
        .faq_sec .faq-content {
            padding: 30px 20px;
        }
        
        .faq_sec .faq-question {
            padding: 18px 20px;
        }
        
        .faq_sec .faq-question h3 {
            font-size: 1.1rem;
        }
        
        .faq_sec .faq-item.active .faq-answer {
            padding: 20px;
        }
    }

    .faq_sec .wave-decoration {
        height: 10px;
        background: linear-gradient(90deg, 
            #3498db, #2ecc71, #9b59b6, #e74c3c, #f39c12, #3498db);
        background-size: 200% 100%;
        animation: wave 8s linear infinite;
    }

    @keyframes wave {
        0% { background-position: 0% 50%; }
        100% { background-position: 200% 50%; }
    }
</style>

<section class="faq_sec">
    <div class="container">
        <div class="wave-decoration"></div>
        
        <div class="faq-header">
            <h1 class="faq-title">FAQ's</h1>
            <p class="faq-subtitle">Frequently Asked Questions about our boat tours</p>
        </div>
        
        <div class="faq-content">
            <div class="faq-item active">
                <div class="faq-question">
                    <h3>How many people can join the private boat tour?</h3>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Our private boat tours are customizable to accommodate your group size. We can accommodate up to 6 people comfortably on our standard private tours. For larger groups, we offer special arrangements with larger vessels. Please contact us for groups larger than 6 people.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>What's included in the tour package?</h3>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>All our tour packages include: 4-hour whale snorkeling experience, breakfast, premium snorkeling equipment, free snorkeling with turtle tour, GoPro camera for capturing memories, free hotel pick-up and drop-off, and an experienced marine guide. Private tours also include exclusive use of the boat.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Do we get to use the GoPro camera ourselves?</h3>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Yes! We provide a GoPro camera for each group to use throughout the tour. Our guides will help you set it up and show you how to use it effectively. You'll be able to capture your own underwater memories, and we'll provide a memory card for you to keep all your photos and videos.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Can we customize the tour schedule?</h3>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Absolutely! While our standard tours are 4 hours, private tours can be customized to fit your schedule. We can adjust the duration, departure time, and even the itinerary based on your preferences. Additional hours can be added for an extra fee. Please discuss your requirements when booking.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Is the tour suitable for beginners?</h3>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Yes, our tours are perfect for beginners! Our experienced guides provide thorough safety briefings and snorkeling instruction before we enter the water. We have flotation devices available and always stay in calm, protected areas ideal for first-time snorkelers. Over 60% of our guests are first-time snorkelers!</p>
                </div>
            </div>
        </div>
        
        <div class="contact-section">
            <h3 class="contact-title">Still have questions?</h3>
            <p class="contact-text">If you didn't find the answer to your question, feel free to contact us directly. Our team is happy to help!</p>
            <a href="#" id="whatsappBtn" class="contact-btn">
                <img src="{{ asset (env('ASSET_PREFIX', '').'img/whatsapp_s_size.png')}}" 
                    alt="WhatsApp" 
                    style="height:20px; width:20px; margin-right:8px; vertical-align:middle;">
                Chat on WhatsApp
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');
        
        // Initially expand the first item
        faqItems[0].classList.add('active');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            
            question.addEventListener('click', () => {
                // Close all other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
                
                // Toggle current item
                item.classList.toggle('active');
            });
        });
        
        // Add animation to FAQ items on page load
        faqItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, 200 * index);
        });
    });
</script>

<script>
document.getElementById("whatsappBtn").addEventListener("click", function (e) {
    e.preventDefault(); // Stop normal link

    fetch('/log-whatsapp-click', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            action: 'whatsapp_click',
            phone: '94702050138'
        })
    })
    .then(response => response.json())
    .then(data => {
        // Open WhatsApp after logging
        window.open("https://wa.me/94702050138", "_blank");
    })
    .catch(error => {
        console.error("Logging failed", error);
        window.open("https://wa.me/94702050138", "_blank");
    });
});
</script>













@include('footer')