<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProBar - Connect with Skilled Barbers</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="icon" href="{{ asset('assets/LOGO.svg') }}" type="image/x-icon">
    <!-- Optional: Add Font Awesome for icons if you want -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
</head>
<body>

    <header>
        <nav class="container">
            <div class="logo">
                <a href="/">
                    <img src="{{asset('assets/LOGO.svg')}}" alt="Logo">
                </a>
            </div>
            <ul>
                <li><a href="#features">Features</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#join-barber">For Barbers</a></li>
                <li><a href="#cta">Download</a></li>
                <li><a href="{{ route('terms')}}">Terms</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="hero">
            <div class="container hero-content-grid">
                <div class="hero-text">
                    <h1>Find Your Perfect Barber, Effortlessly</h1>
                    <p class="subtitle">ProBar connects you with talented barbers in your area. Book appointments easily through our customer app.</p>
                    <a href="#cta" class="cta-button">Download the App</a>
                </div>
                <div class="hero-image-container">
                    <img src="{{asset('assets/hero.webp')}}" alt="ProBar App Screenshot" class="hero-image">
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features">
            <div class="container">
                <h2>Why Choose ProBar?</h2>
                <div class="features-grid">
                     <div class="feature-item">
                        <div class="icon">[🔍]</div> <!-- Simple Text Icon -->
                        <h3>Easy Discovery</h3>
                        <p>Browse profiles, services, and ratings of local barbers.</p>
                    </div>
                    <div class="feature-item">
                         <div class="icon">[📅]</div> <!-- Simple Text Icon -->
                        <h3>Simple Booking</h3>
                        <p>Check availability and book your next haircut in just a few taps.</p>
                    </div>
                    <div class="feature-item">
                         <div class="icon">[⭐]</div> <!-- Simple Text Icon -->
                        <h3>Verified Professionals</h3>
                        <p>Connect with skilled and reviewed barbers on our platform.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Join as Barber - Updated Layout -->
        <section id="join-barber" class="bg-alt">
            <div class="container join-content-grid">
                <div class="join-text">
                    <h2>Are You a Skilled Barber?</h2>
                    <p>Join the ProBar platform to showcase your talent, manage bookings efficiently, and connect with new clients. Grow your business with us!</p>
                    <a href="https://wa.me/YOUR_PHONE_NUMBER?text=Hi%20ProBar%2C%20I'm%20interested%20in%20joining%20as%20a%20barber." target="_blank" rel="noopener noreferrer" class="whatsapp-button">
                        Join via WhatsApp
                    </a>
                     <p class="small-text">Use our dedicated barber app to manage your profile and appointments.</p>
                </div>
                 <div class="join-image-container">
                    <img src="{{asset('assets/barber.png')}}" alt="Barber using ProBar App" class="join-image">
                </div>
            </div>
        </section>

        <!-- Section: Latest Photos Gallery - Updated -->
        <section id="gallery">

             <div class="container">
                 <h2>Latest Styles & Cuts</h2>
             </div>


            <div class="gallery-scroll-container">

                <div class="gallery-grid">

                    <div class="gallery-item">
                        <img src="{{asset('assets/images/1.webp')}}" alt="Gallery Image 1">
                    </div>
                    <div class="gallery-item">
                        <img src="{{asset('assets/images/2.webp')}}" alt="Gallery Image 2">
                    </div>
                    <div class="gallery-item">
                        <img src="{{asset('assets/images/3.webp')}}" alt="Gallery Image 3">
                    </div>
                    <div class="gallery-item">
                        <img src="{{asset('assets/images/4.webp')}}" alt="Gallery Image 4">
                    </div>
                     <div class="gallery-item">
                        <img src="{{asset('assets/images/5.webp')}}" alt="Gallery Image 5">
                    </div>
                     <div class="gallery-item">
                        <img src="{{asset('assets/images/6.webp')}}" alt="Gallery Image 6">
                    </div>

                     <div class="gallery-item">
                        <img src="{{asset('assets/images/1.webp')}}" alt="Gallery Image 1 Duplicate">
                    </div>
                    <div class="gallery-item">
                        <img src="{{asset('assets/images/2.webp')}}" alt="Gallery Image 2 Duplicate">
                    </div>
                    <div class="gallery-item">
                        <img src="{{asset('assets/images/3.webp')}}" alt="Gallery Image 3 Duplicate">
                    </div>
                    <div class="gallery-item">
                        <img src="{{asset('assets/images/4.webp')}}" alt="Gallery Image 4 Duplicate">
                    </div>
                     <div class="gallery-item">
                        <img src="{{asset('assets/images/5.webp')}}" alt="Gallery Image 5 Duplicate">
                    </div>
                     <div class="gallery-item">
                        <img src="{{asset('assets/images/6.webp')}}" alt="Gallery Image 6 Duplicate">
                    </div>
                </div>
            </div>

            <div class="container">
                <p class="gallery-note">Photos uploaded by ProBar barbers.</p>
            </div>
        </section>

        <!-- Call to Action (Download) Section -->
        <section id="cta" class="bg-alt">
            <div class="container cta-content">
                <h2>Ready for Your Next Great Haircut?</h2>
                <p>Download the ProBar Customer app today!</p>
                <div class="download-buttons">
                    <a href="#" class="store-button">App Store</a>
                    <a href="#" class="store-button">Google Play</a>
                </div>
                 <p class="small-text">Barbers: Download the dedicated ProBar Barber app from the stores.</p>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>©2025 Negen Tech. All Rights Reserved.</p>
            <ul>
                <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
            </ul>
        </div>
    </footer>

</body>
</html>
