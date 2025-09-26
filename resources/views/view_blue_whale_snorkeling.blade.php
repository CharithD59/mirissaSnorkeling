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

<style>

    .contact_sec {
        background: linear-gradient(135deg, #e0f7ff 0%, #b3e0ff 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
        box-sizing: border-box;
    }

    .contact_sec .container {
        max-width: 1100px;
        width: 100%;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .contact_sec .contact-header {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        padding: 50px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .contact_sec .contact-header:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".1" fill="%23ffffff"/></svg>');
        background-size: cover;
        opacity: 0.1;
    }

    .contact_sec .contact-title {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 15px;
        position: relative;
    }

    .contact_sec .contact-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
        position: relative;
    }

    .contact_sec .contact-content {
        display: flex;
        flex-wrap: wrap;
        padding: 0;
    }

    .contact_sec .contact-info {
        flex: 1;
        min-width: 300px;
        padding: 50px 40px;
        background: #f8fafc;
    }

    .contact_sec .contact-methods {
        margin-bottom: 40px;
    }

    .contact_sec .contact-method {
        display: flex;
        align-items: flex-start;
        margin-bottom: 30px;
        padding: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact_sec .contact-method:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .contact_sec .contact-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
    }

    .contact_sec .phone .contact-icon {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
    }

    .contact_sec .email .contact-icon {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    }

    .contact_sec .contact-details h3 {
        font-size: 1.3rem;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .contact_sec .contact-details p {
        color: #5a6c7d;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .contact_sec .contact-link {
        color: #3498db;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
        display: inline-block;
        margin-top: 5px;
    }

    .contact_sec .contact-link:hover {
        color: #2980b9;
        text-decoration: underline;
    }

    .contact_sec .business-hours {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .contact_sec .hours-title {
        font-size: 1.4rem;
        color: #2c3e50;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .contact_sec .hours-title i {
        margin-right: 10px;
        color: #3498db;
    }

    .contact_sec .hours-list {
        list-style: none;
    }

    .contact_sec .hours-list li {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
        color: #5a6c7d;
    }

    .contact_sec .hours-list li:last-child {
        border-bottom: none;
    }

    .contact_sec .hours-list .day {
        font-weight: 600;
        color: #2c3e50;
    }

    .contact_sec .contact-form {
        flex: 1;
        min-width: 300px;
        padding: 50px 40px;
    }

    .contact_sec .form-title {
        font-size: 1.8rem;
        color: #2c3e50;
        margin-bottom: 30px;
        text-align: center;
    }

    .contact_sec .form-group {
        margin-bottom: 25px;
    }

    .contact_sec .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #2c3e50;
        font-weight: 600;
    }

    .contact_sec .form-control {
        width: 100%;
        padding: 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .contact_sec .form-control:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    .contact_sec textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    .contact_sec .submit-btn {
        display: block;
        width: 100%;
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        border: none;
        padding: 16px;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
    }

    .contact_sec .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(52, 152, 219, 0.5);
    }

    .contact_sec .submit-btn:active {
        transform: translateY(1px);
    }

    .contact_sec .social-links {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .contact_sec .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #f0f0f0;
        color: #5a6c7d;
        margin: 0 10px;
        text-decoration: none;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .contact_sec .social-link:hover {
        transform: translateY(-5px);
        background: #3498db;
        color: white;
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
    }

    @media (max-width: 768px) {
        .contact_sec .contact-content {
            flex-direction: column;
        }
        
        .contact_sec .contact-info, .contact-form {
            padding: 30px 25px;
        }
        
        .contact_sec .contact-title {
            font-size: 2.2rem;
        }
    }

    .contact_sec .wave-decoration {
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

<!-- Contact Section -->

<section class="contact_sec">
    <div class="container">
        <div class="wave-decoration"></div>
        
        <div class="contact-header">
            <h1 class="contact-title">Contact Us</h1>
            <p class="contact-subtitle">Get in touch with us to book your adventure or ask any questions about our boat tours</p>
        </div>
        
        <div class="contact-content">
            <div class="contact-info">
                <div class="contact-methods">
                    <div class="contact-method phone">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Call Us</h3>
                            <p>+94 70 205 0138</p>
                            <a href="tel:+94702050138" class="contact-link">Call Now</a>
                        </div>
                    </div>
                    
                    <div class="contact-method email">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email Us</h3>
                            <p>mirissabaydiving@gmail.com</p>
                            <a href="mailto:mirissabaydiving@gmail.com" class="contact-link">Send Email</a>
                        </div>
                    </div>
                </div>
                
                <div class="business-hours">
                    <h3 class="hours-title"><i class="fas fa-clock"></i> Business Hours</h3>
                    <ul class="hours-list">
                        <li><span class="day">Monday - Friday</span> <span>8:00 AM - 6:00 PM</span></li>
                        <li><span class="day">Saturday</span> <span>8:00 AM - 8:00 PM</span></li>
                        <li><span class="day">Sunday</span> <span>8:00 AM - 5:00 PM</span></li>
                        <li><span class="day">Holidays</span> <span>9:00 AM - 4:00 PM</span></li>
                    </ul>
                </div>
                
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-tripadvisor"></i></a>
                </div>
            </div>
            
            <div class="contact-form">
                <h3 class="form-title">Send us a Message</h3>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter your name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" class="form-control" placeholder="Enter your phone number">
                    </div>
                    
                    <div class="form-group">
                        <label for="tour">Tour Interest</label>
                        <select id="tour" class="form-control">
                            <option value="">Select a tour</option>
                            <option value="group">Group Boat Tour</option>
                            <option value="private-single">Private Tour (Single)</option>
                            <option value="private-couple">Private Tour (Couple)</option>
                            <option value="other">Other/Not Sure</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" class="form-control" placeholder="Tell us about your inquiry or booking request" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.getElementById('contactForm');
        
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simple form validation
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            
            if (name && email && message) {
                // In a real application, you would send the form data to a server
                alert('Thank you for your message! We will get back to you soon.');
                contactForm.reset();
            } else {
                alert('Please fill in all required fields.');
            }
        });
        
        // Add animation to contact methods
        const contactMethods = document.querySelectorAll('.contact-method');
        contactMethods.forEach((method, index) => {
            method.style.opacity = '0';
            method.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                method.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                method.style.opacity = '1';
                method.style.transform = 'translateX(0)';
            }, 300 * index);
        });
    });
</script>

@include('footer')