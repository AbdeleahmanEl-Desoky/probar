<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - ProBar</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="icon" href="{{ asset('assets/LOGO.svg') }}" type="image/x-icon">

</head>
<body>

    <header>
        <nav class="container">
            <div class="logo"><a href="{{ route('home') }}">ProBar</a></div>
            <ul>
                 <li><a href="{{ route('home') }}#features">Features</a></li>
                 <li><a href="{{ route('home') }}#gallery">Gallery</a></li>
                 <li><a href="{{ route('home') }}#join-barber">For Barbers</a></li>
                 <li><a href="{{ route('home') }}#cta">Download</a></li>
                 <li><a href="{{ route('terms') }}">Terms</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="privacy-content" class="legal-content">
            <div class="container">
                <h1>Privacy Policy</h1>
                <p>Last updated: April 13, 2025</p>

                <p>ProBar ("we", "us", or "our") operates the ProBar mobile applications, including the customer-facing app <strong>“ProBar: Find Your Barber”</strong> (for clients) and the professional app <strong>“ProBar Barber”</strong> (for barbers). This Privacy Policy outlines how we collect, use, and protect personal data across both platforms, and explains the rights and choices available to users.</p>

                <p>By using either of the ProBar apps, you agree to the collection and use of your information in accordance with this Privacy Policy.</p>

                <h2>1. Information We Collect</h2>
                <p>We collect different types of information depending on whether you are a client or a barber. This information helps us operate, maintain, and improve our services.</p>

                <h3>For Clients (ProBar: Find Your Barber)</h3>
                <ul>
                    <li>Full name</li>
                    <li>Email address</li>
                    <li>Phone number</li>
                    <li>Profile photo (optional)</li>
                    <li>Location data (for finding nearby barbers)</li>
                    <li>Booking history</li>
                    <li>Saved favorite barbers</li>
                    <li>In-app chat messages with barbers</li>
                    <li>Notifications preferences</li>
                    <li>Device and usage data (IP address, device ID, app activity, etc.)</li>
                </ul>

                <h3>For Barbers (ProBar for Barbers)</h3>
                <ul>
                    <li>Full name</li>
                    <li>Email address</li>
                    <li>Phone number</li>
                    <li>Shop name and location</li>
                    <li>Business description</li>
                    <li>Profile photo and shop logo</li>
                    <li>Portfolio and shop images (via photo library access)</li>
                    <li>Services offered</li>
                    <li>Pricing details</li>
                    <li>Working hours and availability schedule</li>
                    <li>Booking requests and history</li>
                    <li>Bank account details (if using integrated payment processing)</li>
                    <li>In-app chat messages with clients</li>
                    <li>Notification preferences</li>
                    <li>Device and usage data</li>
                </ul>

                <h2>2. How We Use Your Data</h2>
                <p>ProBar uses the collected data for various purposes:</p>
                <ul>
                    <li>To provide and maintain the Service</li>
                    <li>To connect clients with nearby barbers</li>
                    <li>To manage bookings, schedules, and chats</li>
                    <li>To personalize your experience and show relevant content</li>
                    <li>To send push notifications (e.g., booking reminders, messages)</li>
                    <li>To support customer service requests</li>
                    <li>To process payments and financial settlements (for barbers)</li>
                    <li>To monitor and analyze usage for improvement and development</li>
                    <li>To comply with legal obligations and protect our users and platform</li>
                </ul>

                <h2>3. Sharing Your Information</h2>
                <p>We may share your information in the following cases:</p>
                <ul>
                    <li>With other users as necessary (e.g., name and profile shared during bookings and chat)</li>
                    <li>With third-party service providers for hosting, analytics, customer support, and payments</li>
                    <li>In response to legal requests or to comply with laws</li>
                    <li>To protect the rights, safety, and property of users or ProBar</li>
                    <li>In case of a business transfer (merger, acquisition, etc.)</li>
                </ul>

                <h2>4. Data Security</h2>
                <p>We take reasonable measures to protect your personal data from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the Internet or electronic storage is 100% secure.</p>

                <h2>5. Your Rights</h2>
                <p>You may have rights regarding your personal data, depending on your location. These may include the right to access, correct, or delete your data, or to restrict how it's used. You can update your data from your app settings or by contacting us directly.</p>

                <h2>6. Permissions We Request</h2>
                <ul>
                    <li><strong>Location:</strong> Used to show nearby barbers (clients) or service area (barbers)</li>
                    <li><strong>Notifications:</strong> Used for booking updates, messages, and reminders</li>
                    <li><strong>Photos/Media:</strong> (Barbers) Used to upload shop photos and logos to your public profile</li>
                </ul>

                <h2>7. Children's Privacy</h2>
                <p>ProBar is not intended for use by individuals under the age of 13. We do not knowingly collect personal data from children under 13. If we become aware of such collection, we will take steps to delete it immediately.</p>

                <h2>8. Changes to This Policy</h2>
                <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated effective date. We recommend reviewing this policy periodically.</p>

                <h2>9. Contact Us</h2>
                <p>If you have any questions or concerns about this Privacy Policy, please contact us:</p>
                <ul>
                    <li>By email: [your support email]</li>
                </ul>

                <p><strong>Disclaimer:</strong> This policy is provided as a general template. You should consult with a legal professional to ensure compliance with applicable laws and regulations in your region and specific use case.</p>
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
