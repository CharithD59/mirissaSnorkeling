<?php

/*
|--------------------------------------------------------------------------
| Editable website content
|--------------------------------------------------------------------------
| Every field listed here is editable from Admin > Website Content.
| "default" is the text currently shown on the website, so the site looks
| exactly the same until an admin changes a value. Values saved by the admin
| are stored in the `site_settings` table.
|
| Field types: text, textarea, html (basic formatting allowed), image, video,
| url, email, toggle, lines (one item per line; "icon | text" for facts).
*/

return [

    'general' => [
        'title' => 'General & Contact',
        'icon'  => 'bi-gear',
        'description' => 'Business details used in the header, footer, contact section and notification emails.',
        'fields' => [
            'site.name'               => ['label' => 'Website title', 'type' => 'text', 'default' => 'Mirissa Bay Diving Snorkeling and Blue Whale Tour'],
            'site.meta_description'   => ['label' => 'SEO meta description', 'type' => 'textarea', 'default' => 'Dive into the beauty of Mirissa Bay with our Diving, Snorkeling, and Blue Whale Tours'],
            'site.logo'               => ['label' => 'Logo', 'type' => 'image', 'default' => 'img/logoP.png'],
            'site.favicon'            => ['label' => 'Favicon', 'type' => 'image', 'default' => 'img/favicon.png'],
            'contact.phone'           => ['label' => 'Phone number (display)', 'type' => 'text', 'default' => '+94 70 205 0138'],
            'contact.whatsapp'        => ['label' => 'WhatsApp number (digits only, with country code)', 'type' => 'text', 'default' => '94702050138'],
            'contact.email'           => ['label' => 'Public email address', 'type' => 'email', 'default' => 'mirissabaydiving@gmail.com'],
            'contact.notify_email'    => ['label' => 'Email that receives new bookings & inquiries', 'type' => 'email', 'default' => 'info@mirissabaybluewhalesnorkelingtour.com'],
            'contact.address_full'    => ['label' => 'Full address (top bar)', 'type' => 'text', 'default' => 'Badugoda, R. Situm, 214, A2, Mirissa'],
            'contact.address_short'   => ['label' => 'Short address (contact & footer)', 'type' => 'text', 'default' => 'R. Situm, 214, A2, Mirissa'],
            'social.facebook'         => ['label' => 'Facebook URL', 'type' => 'url', 'default' => 'https://www.facebook.com/mirissabaydiving'],
            'social.instagram'        => ['label' => 'Instagram URL', 'type' => 'url', 'default' => 'https://www.instagram.com/srilankabluewhalesnorkeling?igsh=MWl1OHl2YzdjaDhmYg=='],
            'social.google_maps'      => ['label' => 'Google Maps URL', 'type' => 'url', 'default' => 'https://www.google.com/maps?ll=5.944071,80.460657&z=16&t=m&hl=en&gl=LK&mapclient=embed&cid=5718689178518660128'],
            'contact.map_embed'       => ['label' => 'Google Maps embed URL (iframe src)', 'type' => 'url', 'default' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.3668856612003!2d80.4606568!3d5.9440713999999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae1159bd02c3cc7%3A0x4f5cdd824a79a420!2sMirissa%20Bay%20Diving%20Snorkeling%20and%20Blue%20Whale%20Tour!5e0!3m2!1sen!2slk!4v1735471284905!5m2!1sen!2slk'],
            'footer.brand_first'      => ['label' => 'Footer brand (blue part)', 'type' => 'text', 'default' => 'Mirissa'],
            'footer.brand_second'     => ['label' => 'Footer brand (white part)', 'type' => 'text', 'default' => 'BayDiving'],
            'footer.about'            => ['label' => 'Footer description', 'type' => 'textarea', 'default' => 'Discover the wonders of Mirissa Bay with our exceptional diving, snorkeling, and blue whale tours. Explore vibrant coral reefs and witness majestic marine life for an unforgettable adventure'],
            'footer.hours_days'       => ['label' => 'Business days', 'type' => 'text', 'default' => 'Monday - Sunday'],
            'footer.hours_time'       => ['label' => 'Business hours', 'type' => 'text', 'default' => '06:00 am - 10:00 pm'],
            'footer.copyright'        => ['label' => 'Copyright name', 'type' => 'text', 'default' => 'mirissabaydiving'],
        ],
    ],

    'sections' => [
        'title' => 'Homepage Sections',
        'icon'  => 'bi-layout-text-window',
        'description' => 'Show or hide whole sections of the homepage.',
        'fields' => [
            'home.show_hero'        => ['label' => 'Hero slider', 'type' => 'toggle', 'default' => '1'],
            'home.show_facts'       => ['label' => 'Blue whale facts banner', 'type' => 'toggle', 'default' => '1'],
            'home.show_whatsapp'    => ['label' => 'WhatsApp call-to-action', 'type' => 'toggle', 'default' => '1'],
            'home.show_about'       => ['label' => 'About us', 'type' => 'toggle', 'default' => '1'],
            'home.show_whale'       => ['label' => 'Blue whale snorkeling banner', 'type' => 'toggle', 'default' => '1'],
            'home.show_services'    => ['label' => 'Services / packages', 'type' => 'toggle', 'default' => '1'],
            'home.show_why'         => ['label' => 'Why choose us', 'type' => 'toggle', 'default' => '1'],
            'home.show_gallery'     => ['label' => 'Gallery', 'type' => 'toggle', 'default' => '1'],
            'home.show_reviews'     => ['label' => 'Reviews', 'type' => 'toggle', 'default' => '1'],
            'home.show_contact'     => ['label' => 'Contact', 'type' => 'toggle', 'default' => '1'],
        ],
    ],

    'hero' => [
        'title' => 'Hero Slider',
        'icon'  => 'bi-film',
        'description' => 'The three full-width slides at the top of the homepage. Media can be an MP4 video or an image.',
        'fields' => [
            'hero.1.subtitle' => ['label' => 'Slide 1 – small heading', 'type' => 'text', 'default' => "Let's Ride A Wave"],
            'hero.1.title'    => ['label' => 'Slide 1 – main heading', 'type' => 'text', 'default' => 'Take Your Dive To The Next Level'],
            'hero.1.media'    => ['label' => 'Slide 1 – video / image', 'type' => 'video', 'default' => 'img/carousel-1.mp4'],
            'hero.2.subtitle' => ['label' => 'Slide 2 – small heading', 'type' => 'text', 'default' => 'Blue Whale Tours'],
            'hero.2.title'    => ['label' => 'Slide 2 – main heading', 'type' => 'text', 'default' => 'Mirissa Bay Diving Snorkeling and Blue Whale Tour'],
            'hero.2.media'    => ['label' => 'Slide 2 – video / image', 'type' => 'video', 'default' => 'img/carousel-2.mp4'],
            'hero.3.subtitle' => ['label' => 'Slide 3 – small heading', 'type' => 'text', 'default' => 'Discoover Scuba Diving In Sri Lanka'],
            'hero.3.title'    => ['label' => 'Slide 3 – main heading', 'type' => 'text', 'default' => 'A New Discovery Awaits'],
            'hero.3.media'    => ['label' => 'Slide 3 – video / image', 'type' => 'video', 'default' => 'img/carousel-3.mp4'],
            'hero.btn_book'    => ['label' => 'Primary button text', 'type' => 'text', 'default' => 'Book Now'],
            'hero.btn_contact' => ['label' => 'Secondary button text', 'type' => 'text', 'default' => 'Contact Us'],
        ],
    ],

    'facts' => [
        'title' => 'Blue Whale Facts Banner',
        'icon'  => 'bi-water',
        'description' => 'The blue banner with whale facts below the hero slider.',
        'fields' => [
            'facts.badge'        => ['label' => 'Badge', 'type' => 'text', 'default' => 'Marine Wildlife Experience'],
            'facts.heading'      => ['label' => 'Heading (wrap words in *asterisks* to highlight)', 'type' => 'text', 'default' => '🐋 Blue Whales – The *Gentle Giants* of Mirissa'],
            'facts.intro'        => ['label' => 'Intro', 'type' => 'html', 'default' => 'Did you know the <strong>Blue Whale</strong> is the largest animal ever to live on Earth 🌍 — even bigger than dinosaurs? Join us in Mirissa for an unforgettable adventure with these ocean giants.'],
            'facts.items'        => ['label' => 'Facts (one per line: icon | text)', 'type' => 'lines', 'default' => "📏 | 22–27 meters long (that’s 3 buses 🚍🚍🚍)\n👩‍🦱 | Females are usually larger than males\n🐋 | Record: 33 meters long, 150 tons (1926)\n⚖️ | As heavy as 2,700 people combined\n❤️ | Heart the size of a car 🚗\n🔊 | Loudest animal on Earth, heard hundreds of km away"],
            'facts.box1'         => ['label' => 'Info box 1', 'type' => 'html', 'default' => 'Why <strong>Mirissa</strong>? It’s one of the <em>world’s best places</em> to see Blue Whales up close, along with Sperm Whales and playful Dolphins 🐬 — just a short ride from shore.'],
            'facts.box2'         => ['label' => 'Info box 2', 'type' => 'html', 'default' => 'Join us in <strong>Mirissa</strong> and witness the largest animals on Earth in their natural home. A once-in-a-lifetime adventure awaits! 🐋🌊'],
            'facts.btn_book'     => ['label' => 'Booking button text', 'type' => 'text', 'default' => 'Join a Whale Watching Tour 🐋'],
            'facts.btn_more'     => ['label' => 'Read more button text', 'type' => 'text', 'default' => 'Read More 🐋'],
        ],
    ],

    'whatsapp' => [
        'title' => 'WhatsApp Call-to-action',
        'icon'  => 'bi-whatsapp',
        'description' => 'The WhatsApp strip on the homepage.',
        'fields' => [
            'whatsapp.heading'  => ['label' => 'Heading', 'type' => 'text', 'default' => 'Contact Us on WhatsApp Anytime!'],
            'whatsapp.text'     => ['label' => 'Text', 'type' => 'textarea', 'default' => 'Reach out to us instantly for inquiries, bookings, or support. Click below to chat with us on WhatsApp'],
            'whatsapp.button'   => ['label' => 'Button text', 'type' => 'text', 'default' => 'Chat on WhatsApp'],
            'whatsapp.bg'       => ['label' => 'Background image', 'type' => 'image', 'default' => 'img/section_bg01.png'],
        ],
    ],

    'about' => [
        'title' => 'About Us',
        'icon'  => 'bi-info-circle',
        'description' => 'About section on the homepage.',
        'fields' => [
            'about.label'      => ['label' => 'Small label', 'type' => 'text', 'default' => 'About Us'],
            'about.heading'    => ['label' => 'Heading', 'type' => 'text', 'default' => 'Let us make your diving experience unforgettable'],
            'about.text'       => ['label' => 'Paragraph', 'type' => 'textarea', 'default' => 'Dive into the beauty of Mirissa Bay with our Diving, Snorkeling, and Blue Whale Tours. Discover vibrant coral reefs, swim with colorful marine life, and experience the awe of seeing majestic blue whales. Perfect for adventurers and nature lovers, we promise an unforgettable ocean experience.'],
            'about.points'     => ['label' => 'Check-list points (one per line)', 'type' => 'lines', 'default' => "Satisfaction Gurantee\nComplete Equipment\nExperienced Skipper & Divers"],
            'about.call_label' => ['label' => 'Call box label', 'type' => 'text', 'default' => 'More About Us 24/7'],
            'about.call_number'=> ['label' => 'Call box number', 'type' => 'text', 'default' => '702050138'],
            'about.image_main' => ['label' => 'Main image', 'type' => 'image', 'default' => 'img/about-5.png'],
            'about.image_small'=> ['label' => 'Small overlay image', 'type' => 'image', 'default' => 'img/about-2.jpg'],
        ],
    ],

    'whale' => [
        'title' => 'Blue Whale Snorkeling Banner',
        'icon'  => 'bi-megaphone',
        'description' => 'Animated banner that links to the blue whale snorkeling page.',
        'fields' => [
            'whale.title'    => ['label' => 'Title', 'type' => 'text', 'default' => 'BLUE WHALE SNORKELING'],
            'whale.subtitle' => ['label' => 'Subtitle', 'type' => 'textarea', 'default' => 'Dive into an unforgettable adventure in Mirissa and snorkel alongside majestic whales and playful dolphins in the crystal-clear waters of the Indian Ocean.'],
            'whale.button'   => ['label' => 'Button text', 'type' => 'text', 'default' => 'READ MORE'],
            'whale.link'     => ['label' => 'Link', 'type' => 'text', 'default' => 'view_blue_whale_snorkeling'],
        ],
    ],

    'services' => [
        'title' => 'Services Section',
        'icon'  => 'bi-grid',
        'description' => 'Headings of the services section. The service cards themselves are managed under Packages.',
        'fields' => [
            'services.label'   => ['label' => 'Small label', 'type' => 'text', 'default' => 'Our Services'],
            'services.heading' => ['label' => 'Heading', 'type' => 'text', 'default' => 'What Services We Have'],
            'services.button'  => ['label' => '"Read more" button text', 'type' => 'text', 'default' => 'Read More'],
        ],
    ],

    'why' => [
        'title' => 'Why Choose Us',
        'icon'  => 'bi-award',
        'description' => 'Why choose us block with statistics.',
        'fields' => [
            'why.badge'     => ['label' => 'Badge', 'type' => 'text', 'default' => 'Why Choose Us'],
            'why.heading'   => ['label' => 'Heading', 'type' => 'text', 'default' => 'Your Ultimate Marine Adventure in Mirissa'],
            'why.text'      => ['label' => 'Text', 'type' => 'textarea', 'default' => 'Enjoy a safe, comfortable, and unforgettable adventure on the waters of Mirissa with our expert team.'],
            'why.points'    => ['label' => 'Points (one per line)', 'type' => 'lines', 'default' => "Eco-Friendly & Safe Marine Experiences\nProfessional & Experienced Crew"],
            'why.button'    => ['label' => 'Button text', 'type' => 'text', 'default' => 'Book Your Adventure'],
            'why.stat1_value' => ['label' => 'Stat 1 value', 'type' => 'text', 'default' => '20+'],
            'why.stat1_label' => ['label' => 'Stat 1 label', 'type' => 'text', 'default' => 'Years of Experience'],
            'why.stat2_value' => ['label' => 'Stat 2 value', 'type' => 'text', 'default' => '8960+'],
            'why.stat2_label' => ['label' => 'Stat 2 label', 'type' => 'text', 'default' => 'Happy Travelers'],
            'why.stat3_value' => ['label' => 'Stat 3 value', 'type' => 'text', 'default' => '25+'],
            'why.stat3_label' => ['label' => 'Stat 3 label', 'type' => 'text', 'default' => 'Adventure Options'],
            'why.stat4_value' => ['label' => 'Stat 4 value', 'type' => 'text', 'default' => '100%'],
            'why.stat4_label' => ['label' => 'Stat 4 label', 'type' => 'text', 'default' => 'Eco-Friendly & Safe Tours'],
        ],
    ],

    'gallery' => [
        'title' => 'Gallery Texts',
        'icon'  => 'bi-images',
        'description' => 'Headings for the homepage gallery and the gallery page. Photos are managed under Gallery.',
        'fields' => [
            'gallery.label'          => ['label' => 'Homepage small label', 'type' => 'text', 'default' => 'Our Gallery'],
            'gallery.heading'        => ['label' => 'Homepage heading (wrap words in *asterisks* to highlight)', 'type' => 'text', 'default' => 'Let`s See Our *Gallery* Awsome Memories'],
            'gallery.button'         => ['label' => 'Homepage button text', 'type' => 'text', 'default' => 'Explore More Images'],
            'gallery.page_title'     => ['label' => 'Gallery page title', 'type' => 'text', 'default' => 'Mirissa Snorkeling Gallery'],
            'gallery.page_intro'     => ['label' => 'Gallery page intro', 'type' => 'textarea', 'default' => 'Explore the breathtaking underwater world of Mirissa through our collection of stunning snorkeling moments'],
        ],
    ],

    'reviews' => [
        'title' => 'Reviews Section',
        'icon'  => 'bi-star',
        'description' => 'Headings and Google review links.',
        'fields' => [
            'reviews.label'      => ['label' => 'Small label', 'type' => 'text', 'default' => 'Testimonial'],
            'reviews.heading'    => ['label' => 'Heading', 'type' => 'text', 'default' => 'What Clients Say About Us'],
            'reviews.google_url' => ['label' => '"View Google Reviews" link', 'type' => 'url', 'default' => 'https://www.google.com/search?hl=en-LK&gl=lk&q=Mirissa+Bay+Diving+Blue+Whale+Turtle+Snorkeling,+Badugoda,+R.+Situm,+214,+A2,+Mirissa&ludocid=5718689178518660128&lsig=AB86z5V5df7w480jxPbg3AgRGDEO#lrd=0x3ae1159bd02c3cc7:0x4f5cdd824a79a420,1,,,,'],
            'reviews.write_url'  => ['label' => '"Add Google Review" link', 'type' => 'url', 'default' => 'https://search.google.com/local/writereview?placeid=ChIJxzws0JsV4ToRIKR5SoLdXE8'],
        ],
    ],

    'contact' => [
        'title' => 'Contact Section',
        'icon'  => 'bi-envelope',
        'description' => 'Contact section on the homepage (phone, email and address come from General & Contact).',
        'fields' => [
            'contact.label'        => ['label' => 'Small label', 'type' => 'text', 'default' => 'Contact Us'],
            'contact.heading'      => ['label' => 'Heading', 'type' => 'text', 'default' => 'If You Have Any Query, Feel Free To Contact Us'],
            'contact.call_label'   => ['label' => 'Phone box label', 'type' => 'text', 'default' => 'Call to ask any question'],
            'contact.email_label'  => ['label' => 'Email box label', 'type' => 'text', 'default' => 'Email to get free quote'],
            'contact.visit_label'  => ['label' => 'Address box label', 'type' => 'text', 'default' => 'Visit our office'],
            'contact.button'       => ['label' => 'Form button text', 'type' => 'text', 'default' => 'Send Message'],
        ],
    ],

    'booking' => [
        'title' => 'Booking Page',
        'icon'  => 'bi-calendar-check',
        'description' => 'Texts on the online booking page.',
        'fields' => [
            'booking.page_title' => ['label' => 'Page header title', 'type' => 'text', 'default' => 'Online Booking'],
            'booking.label'      => ['label' => 'Small label', 'type' => 'text', 'default' => 'Booking'],
            'booking.heading'    => ['label' => 'Left heading', 'type' => 'text', 'default' => 'Online Booking'],
            'booking.text1'      => ['label' => 'Left paragraph 1', 'type' => 'textarea', 'default' => 'Easily book your diving, snorkeling, or blue whale tour online and secure your spot for an unforgettable adventure in Mirissa Bay.'],
            'booking.text2'      => ['label' => 'Left paragraph 2', 'type' => 'textarea', 'default' => 'Our user-friendly platform ensures a seamless booking process, so you can focus on planning your dream ocean experience.'],
            'booking.form_title' => ['label' => 'Form heading', 'type' => 'text', 'default' => 'Book A Mirissa Bay Diving'],
            'booking.offer_title'=> ['label' => 'Offer highlight', 'type' => 'text', 'default' => 'Exclusive Discounts:'],
            'booking.offer_text' => ['label' => 'Offer text', 'type' => 'textarea', 'default' => 'Book now and enjoy special deals on our diving, snorkeling, and blue whale tours. Get more exciting offers here and make your Mirissa Bay adventure unforgettable!'],
            'booking.button'     => ['label' => 'Button text', 'type' => 'text', 'default' => 'Book Now'],
            'booking.success'    => ['label' => 'Thank-you message (booking & contact forms)', 'type' => 'text', 'default' => 'Thank you for getting in touch! We appreciate you contacting us'],
        ],
    ],
];
