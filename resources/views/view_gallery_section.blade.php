@include('header')

<style>

.gallery-section {
    background: linear-gradient(to bottom, #0a2a43, #1a4a6c);
    color: #fff;
    min-height: 100vh;
}

.gallery-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.gallery-section header {
    text-align: center;
    padding-top: 110px;
}

.gallery-section header h1 {
    font-size: 3rem;
    margin-bottom: 10px;
    color: #4fc3f7;
    text-shadow: 0 2px 10px rgba(79, 195, 247, 0.5);
}

.gallery-section header p {
    font-size: 1.2rem;
    max-width: 800px;
    margin: 0 auto;
    color: #e0f7fa;
}

.gallery-section .gallery-controls {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    margin: 30px 0;
}

.gallery-section .filter-btn {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid #4fc3f7;
    color: #e0f7fa;
    padding: 10px 20px;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.gallery-section .filter-btn:hover, .filter-btn.active {
    background: #4fc3f7;
    color: #0a2a43;
}

.gallery-section .gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.gallery-section .gallery-item {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gallery-section .gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
}

.gallery-section .gallery-item img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.gallery-section .gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-section .item-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(10, 42, 67, 0.9), transparent);
    padding: 20px;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.gallery-section .gallery-item:hover .item-overlay {
    transform: translateY(0);
}

.gallery-section .item-overlay h3 {
    font-size: 1.2rem;
    margin-bottom: 8px;
}

.gallery-section .item-overlay p {
    font-size: 0.9rem;
    opacity: 0.8;
}

.gallery-section .lightbox {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(10, 42, 67, 0.95);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

.gallery-section .lightbox.open {
    opacity: 1;
    pointer-events: auto;
}

.gallery-section .lightbox-content {
    position: relative;
    max-width: 90%;
    max-height: 90%;
}

.gallery-section .lightbox-content img {
    max-width: 100%;
    max-height: 80vh;
    border-radius: 8px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.5);
}

.gallery-section .lightbox-caption {
    text-align: center;
    margin-top: 15px;
    font-size: 1.2rem;
}

.gallery-section .close-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 2rem;
    color: #fff;
    background: none;
    border: none;
    cursor: pointer;
    transition: color 0.3s ease;
}

.gallery-section .close-btn:hover {
    color: #4fc3f7;
}

.gallery-section .nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 2rem;
    color: #fff;
    background: rgba(0, 0, 0, 0.3);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: background 0.3s ease;
}

.gallery-section .nav-btn:hover {
    background: rgba(79, 195, 247, 0.5);
}

.gallery-section .prev-btn {
    left: 20px;
}

.gallery-section .next-btn {
    right: 20px;
}

@media (max-width: 768px) {
    .gallery-section .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }
    
    .gallery-section header h1 {
        font-size: 2.5rem;
    }
    
    .gallery-section .filter-btn {
        padding: 8px 16px;
        font-size: 0.9rem;
    }

    .gallery-section header {
        text-align: center;
        padding-top: 40px;
    }

}

@media (max-width: 480px) {
    .gallery-section .gallery-grid {
        grid-template-columns: 1fr;
    }
    
    .gallery-section header h1 {
        font-size: 2rem;
    }
    
    .gallery-section .filter-btn {
        padding: 6px 12px;
        font-size: 0.8rem;
    }
    
    .gallery-section .nav-btn {
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
    }

    .gallery-section header {
        text-align: center;
        padding-top: 40px;
    }
}

.gallery-section .water-effect {
    position: relative;
    overflow: hidden;
}

.gallery-section .water-effect::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: rgba(255, 255, 255, 0.1);
    transform: rotate(30deg);
    transition: all 0.3s ease;
}

.gallery-section .gallery-item:hover .water-effect::after {
    transform: rotate(30deg) translate(10px, 10px);
}
</style>

<section class="gallery-section">
    <div class="container">
        <header>
            <h1>Mirissa Snorkeling Gallery</h1>
            <p>Explore the breathtaking underwater world of Mirissa through our collection of stunning snorkeling moments</p>
        </header>
        
        <div class="gallery-controls">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="turtle_snorkeling">Turtle Snorkeling</button>
            <button class="filter-btn" data-filter="whales _snorkeling">Whales Snorkeling</button>
            <button class="filter-btn" data-filter="branding">Branding</button>
        </div>
        
        <div class="gallery-grid">
            <!-- Turtle Snorkeling -->
            <div class="gallery-item" data-category="turtle_snorkeling">
                <div class="water-effect">
                    <img src="{{ asset (env('ASSET_PREFIX', '').'img/gallery/TurtleSnorkeling_01.JPG')}}" alt="Turtle Snorkeling">
                </div>
            </div>

            <!-- Turtle Snorkeling -->
            <div class="gallery-item" data-category="turtle_snorkeling">
                <div class="water-effect">
                    <img src="{{ asset (env('ASSET_PREFIX', '').'img/gallery/TurtleSnorkeling_02.JPG')}}" alt="Turtle Snorkeling">
                </div>
            </div>
            
            <!-- Whales  Snorkeling -->
            <div class="gallery-item" data-category="whales _snorkeling">
                <div class="water-effect">
                    <img src="{{ asset (env('ASSET_PREFIX', '').'img/gallery/WhalesSnorkeling_01.JPG')}}" alt="whales _snorkeling reef in Mirissa">
                </div>
            </div>

            <div class="gallery-item" data-category="whales _snorkeling">
                <div class="water-effect">
                    <img src="{{ asset (env('ASSET_PREFIX', '').'img/gallery/WhalesSnorkeling_02.JPG')}}" alt="whales _snorkeling reef in Mirissa">
                </div>
            </div>

            <div class="gallery-item" data-category="whales _snorkeling">
                <div class="water-effect">
                    <img src="{{ asset (env('ASSET_PREFIX', '').'img/gallery/WhalesSnorkeling_03.JPG')}}" alt="whales _snorkeling reef in Mirissa">
                </div>
            </div>

            <div class="gallery-item" data-category="whales _snorkeling">
                <div class="water-effect">
                    <img src="{{ asset (env('ASSET_PREFIX', '').'img/gallery/WhalesSnorkeling_04.JPG')}}" alt="whales _snorkeling reef in Mirissa">
                </div>
            </div>

            <div class="gallery-item" data-category="whales _snorkeling">
                <div class="water-effect">
                    <img src="{{ asset (env('ASSET_PREFIX', '').'img/gallery/WhalesSnorkeling_05.JPG')}}" alt="whales _snorkeling reef in Mirissa">
                </div>
            </div>

            <div class="gallery-item" data-category="whales _snorkeling">
                <div class="water-effect">
                    <img src="{{ asset (env('ASSET_PREFIX', '').'img/gallery/WhalesSnorkeling_06.JPG')}}" alt="whales _snorkeling reef in Mirissa">
                </div>
            </div>

            <div class="gallery-item" data-category="whales _snorkeling">
                <div class="water-effect">
                    <img src="{{ asset (env('ASSET_PREFIX', '').'img/gallery/WhalesSnorkeling_07.JPG')}}" alt="whales _snorkeling reef in Mirissa">
                </div>
            </div>
            
            <!-- branding -->
            <div class="gallery-item" data-category="branding">
                <div class="water-effect">
                    <img src="{{ asset (env('ASSET_PREFIX', '').'img/gallery/Branding.png')}}" alt="branding">
                </div>
            </div>
            
        </div>
    </div>

    <!-- Lightbox -->
    <div class="lightbox">
        <button class="close-btn">&times;</button>
        <button class="nav-btn prev-btn"><i class="fas fa-chevron-left"></i></button>
        <button class="nav-btn next-btn"><i class="fas fa-chevron-right"></i></button>
        <div class="lightbox-content">
            <img src="" alt="">
            <div class="lightbox-caption"></div>
        </div>
    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Set active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                // Filter items
                const filterValue = button.getAttribute('data-filter');
                
                galleryItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
        
        // Lightbox functionality
        const lightbox = document.querySelector('.lightbox');
        const lightboxImg = document.querySelector('.lightbox-content img');
        const lightboxCaption = document.querySelector('.lightbox-caption');
        const closeBtn = document.querySelector('.close-btn');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        
        let currentImageIndex = 0;
        const images = Array.from(galleryItems);
        
        // Open lightbox
        galleryItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                currentImageIndex = index;
                updateLightbox();
                lightbox.classList.add('open');
            });
        });
        
        // Close lightbox
        closeBtn.addEventListener('click', () => {
            lightbox.classList.remove('open');
        });
        
        // Navigate lightbox
        prevBtn.addEventListener('click', () => {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            updateLightbox();
        });
        
        nextBtn.addEventListener('click', () => {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            updateLightbox();
        });
        
        // Update lightbox content
        function updateLightbox() {
            const item = images[currentImageIndex];
            const imgSrc = item.querySelector('img').src;
            const caption = item.querySelector('h3').textContent;
            
            lightboxImg.src = imgSrc;
            lightboxCaption.textContent = caption;
        }
        
        // Close lightbox when clicking outside content
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                lightbox.classList.remove('open');
            }
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (lightbox.classList.contains('open')) {
                if (e.key === 'Escape') {
                    lightbox.classList.remove('open');
                } else if (e.key === 'ArrowLeft') {
                    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                    updateLightbox();
                } else if (e.key === 'ArrowRight') {
                    currentImageIndex = (currentImageIndex + 1) % images.length;
                    updateLightbox();
                }
            }
        });
    });
</script>

@include('footer')