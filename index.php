<?php 
$page_title = "Find Your Perfect Match";
require_once 'includes/header.php';
?>

<!-- Hero Section with Video Background -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Video -->
    <div class="absolute inset-0 z-0">
        <div class="w-full h-full bg-gradient-to-br from-pink-400 via-rose-400 to-pink-600 opacity-90"></div>
        <!-- Placeholder for video background -->
        <img src="https://placehold.co/1920x1080?text=Romantic+couple+walking+on+beach+sunset+holding+hands+happy+moments" 
             alt="Romantic couple moments" 
             class="absolute inset-0 w-full h-full object-cover mix-blend-overlay">
    </div>
    
    <!-- Floating Hearts Animation -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="heart-float absolute top-10 left-10 text-4xl text-white opacity-20">💕</div>
        <div class="heart-float absolute top-32 right-20 text-3xl text-pink-200 opacity-30" style="animation-delay: 1s">💖</div>
        <div class="heart-float absolute bottom-40 left-1/4 text-5xl text-rose-200 opacity-25" style="animation-delay: 2s">💝</div>
        <div class="heart-float absolute bottom-20 right-1/3 text-4xl text-white opacity-20" style="animation-delay: 3s">💗</div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in-up">
            Find Your
            <span class="text-yellow-300">Perfect Match</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 opacity-90 animate-fade-in-up" style="animation-delay: 0.2s">
            Connect with meaningful people around you. Start your love story today with verified profiles and intelligent matching.
        </p>
        
        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6 animate-fade-in-up" style="animation-delay: 0.4s">
            <a href="register.php" class="btn-dating text-lg px-8 py-4 hover:scale-110">
                Join Free Now 💕
            </a>
            <button onclick="scrollToHowItWorks()" class="bg-white/20 backdrop-blur-sm text-white border-2 border-white/30 hover:bg-white/30 font-semibold py-4 px-8 rounded-xl transition-all duration-300 hover:scale-105">
                How It Works
            </button>
        </div>
        
        <!-- Statistics -->
        <div class="grid grid-cols-3 gap-8 mt-16 animate-fade-in-up" style="animation-delay: 0.6s">
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-yellow-300">2.5M+</div>
                <div class="text-sm md:text-base opacity-90">Happy Singles</div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-yellow-300">500K+</div>
                <div class="text-sm md:text-base opacity-90">Successful Matches</div>
            </div>
            <div class="text-center">
                <div class="text-3xl md:text-4xl font-bold text-yellow-300">95%</div>
                <div class="text-sm md:text-base opacity-90">Success Rate</div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="py-20 bg-gradient-to-br from-pink-50 to-rose-100">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-gradient-pink mb-4">How It Works</h2>
        <p class="text-xl text-gray-600 mb-16">Simple steps to find your perfect match</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Step 1 -->
            <div class="card-dating hover-lift">
                <div class="text-6xl mb-6">📸</div>
                <h3 class="text-2xl font-bold text-dating-700 mb-4">1. Create Profile</h3>
                <p class="text-gray-600">Upload your best photos and tell your story. Our AI helps optimize your profile for maximum matches.</p>
            </div>
            
            <!-- Step 2 -->
            <div class="card-dating hover-lift" style="animation-delay: 0.1s">
                <div class="text-6xl mb-6">💖</div>
                <h3 class="text-2xl font-bold text-dating-700 mb-4">2. Discover & Match</h3>
                <p class="text-gray-600">Swipe through curated profiles near you. Our smart algorithm learns your preferences.</p>
            </div>
            
            <!-- Step 3 -->
            <div class="card-dating hover-lift" style="animation-delay: 0.2s">
                <div class="text-6xl mb-6">💬</div>
                <h3 class="text-2xl font-bold text-dating-700 mb-4">3. Chat & Meet</h3>
                <p class="text-gray-600">Start meaningful conversations and plan your first date with built-in safety features.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gradient-pink mb-4">Why Choose LoveConnect?</h2>
            <p class="text-xl text-gray-600">Premium features designed for serious relationships</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Verified Profiles -->
            <div class="card-dating text-center hover-glow">
                <div class="text-5xl mb-4">✅</div>
                <h3 class="text-xl font-bold text-dating-700 mb-3">Verified Profiles</h3>
                <p class="text-gray-600">Photo verification ensures authentic profiles and real people</p>
            </div>
            
            <!-- Smart Matching -->
            <div class="card-dating text-center hover-glow">
                <div class="text-5xl mb-4">🧠</div>
                <h3 class="text-xl font-bold text-dating-700 mb-3">AI Matching</h3>
                <p class="text-gray-600">Advanced algorithm learns your preferences for better matches</p>
            </div>
            
            <!-- Safe Dating -->
            <div class="card-dating text-center hover-glow">
                <div class="text-5xl mb-4">🛡️</div>
                <h3 class="text-xl font-bold text-dating-700 mb-3">Safe Dating</h3>
                <p class="text-gray-600">Background checks, safety tips, and secure communication</p>
            </div>
            
            <!-- Video Chat -->
            <div class="card-dating text-center hover-glow">
                <div class="text-5xl mb-4">🎥</div>
                <h3 class="text-xl font-bold text-dating-700 mb-3">Video Calls</h3>
                <p class="text-gray-600">Built-in video chat to connect before meeting in person</p>
            </div>
            
            <!-- Events -->
            <div class="card-dating text-center hover-glow">
                <div class="text-5xl mb-4">🎉</div>
                <h3 class="text-xl font-bold text-dating-700 mb-3">Local Events</h3>
                <p class="text-gray-600">Speed dating, group activities, and singles events near you</p>
            </div>
            
            <!-- Premium Features -->
            <div class="card-dating text-center hover-glow">
                <div class="text-5xl mb-4">⭐</div>
                <h3 class="text-xl font-bold text-dating-700 mb-3">Premium Perks</h3>
                <p class="text-gray-600">Unlimited likes, advanced filters, and priority matching</p>
            </div>
        </div>
    </div>
</section>

<!-- Success Stories Section -->
<section class="py-20 bg-gradient-to-br from-rose-50 to-pink-100">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gradient-pink mb-4">Success Stories</h2>
            <p class="text-xl text-gray-600">Real couples who found love on LoveConnect</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Story 1 -->
            <div class="card-dating hover-lift">
                <div class="flex items-center mb-4">
                    <img src="https://placehold.co/60x60?text=👩🏻" alt="Sarah" class="w-12 h-12 rounded-full mr-3">
                    <img src="https://placehold.co/60x60?text=👨🏻" alt="Mike" class="w-12 h-12 rounded-full">
                    <div class="ml-3">
                        <div class="font-bold text-dating-700">Sarah & Mike</div>
                        <div class="text-sm text-gray-500">Married 2 years ago</div>
                    </div>
                </div>
                <p class="text-gray-600 italic">"We matched on LoveConnect and knew instantly we were perfect for each other. Now we're happily married with a beautiful daughter!"</p>
                <div class="flex text-yellow-400 mt-4">
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
            
            <!-- Story 2 -->
            <div class="card-dating hover-lift">
                <div class="flex items-center mb-4">
                    <img src="https://placehold.co/60x60?text=👩🏽" alt="Emma" class="w-12 h-12 rounded-full mr-3">
                    <img src="https://placehold.co/60x60?text=👨🏽" alt="James" class="w-12 h-12 rounded-full">
                    <div class="ml-3">
                        <div class="font-bold text-dating-700">Emma & James</div>
                        <div class="text-sm text-gray-500">Together 3 years</div>
                    </div>
                </div>
                <p class="text-gray-600 italic">"After trying many dating apps, LoveConnect was the only one that actually worked. The quality of matches was incredible!"</p>
                <div class="flex text-yellow-400 mt-4">
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
            
            <!-- Story 3 -->
            <div class="card-dating hover-lift">
                <div class="flex items-center mb-4">
                    <img src="https://placehold.co/60x60?text=👩🏼" alt="Lisa" class="w-12 h-12 rounded-full mr-3">
                    <img src="https://placehold.co/60x60?text=👨🏼" alt="David" class="w-12 h-12 rounded-full">
                    <div class="ml-3">
                        <div class="font-bold text-dating-700">Lisa & David</div>
                        <div class="text-sm text-gray-500">Engaged last month</div>
                    </div>
                </div>
                <p class="text-gray-600 italic">"The AI matching was spot on! We had so much in common from day one. Thank you LoveConnect for bringing us together!"</p>
                <div class="flex text-yellow-400 mt-4">
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="success-stories.php" class="btn-dating-outline hover:scale-105">
                Read More Stories 💕
            </a>
        </div>
    </div>
</section>

<!-- Safety Features Section -->
<section id="safety" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gradient-pink mb-4">Your Safety Matters</h2>
            <p class="text-xl text-gray-600">Advanced security features for worry-free dating</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="text-3xl">🔒</div>
                        <div>
                            <h3 class="text-xl font-bold text-dating-700 mb-2">Secure Communication</h3>
                            <p class="text-gray-600">All messages are encrypted end-to-end for your privacy and security.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="text-3xl">📋</div>
                        <div>
                            <h3 class="text-xl font-bold text-dating-700 mb-2">Background Checks</h3>
                            <p class="text-gray-600">Optional background verification for premium members.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="text-3xl">📱</div>
                        <div>
                            <h3 class="text-xl font-bold text-dating-700 mb-2">Emergency Features</h3>
                            <p class="text-gray-600">Share date details with trusted contacts and quick emergency alerts.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="text-3xl">🚫</div>
                        <div>
                            <h3 class="text-xl font-bold text-dating-700 mb-2">Block & Report</h3>
                            <p class="text-gray-600">Easy reporting system with 24/7 moderation team support.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <img src="https://placehold.co/500x400?text=Security+shield+protection+safety+features+mobile+app+interface" 
                     alt="Safety features" 
                     class="rounded-2xl shadow-2xl hover:scale-105 transition-transform duration-300">
            </div>
        </div>
    </div>
</section>

<!-- App Download Section -->
<section class="py-20 bg-gradient-to-r from-dating-600 to-rose-600 text-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Download Our App</h2>
        <p class="text-xl mb-12 opacity-90">Find love on the go with our mobile app. Available on iOS and Android.</p>
        
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-8">
            <!-- App Store Button -->
            <a href="#" class="flex items-center space-x-4 bg-black text-white px-8 py-4 rounded-2xl hover:bg-gray-800 transition-colors duration-200 hover:scale-105">
                <svg class="w-12 h-12" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                </svg>
                <div class="text-left">
                    <div class="text-sm">Download on the</div>
                    <div class="text-xl font-bold">App Store</div>
                </div>
            </a>
            
            <!-- Google Play Button -->
            <a href="#" class="flex items-center space-x-4 bg-black text-white px-8 py-4 rounded-2xl hover:bg-gray-800 transition-colors duration-200 hover:scale-105">
                <svg class="w-12 h-12" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3,20.5V3.5C3,2.91 3.34,2.39 3.84,2.15L13.69,12L3.84,21.85C3.34,21.6 3,21.09 3,20.5M16.81,15.12L6.05,21.34L14.54,12.85L16.81,15.12M20.16,10.81C20.5,11.08 20.75,11.5 20.75,12C20.75,12.5 20.53,12.9 20.18,13.18L17.89,14.5L15.39,12L17.89,9.5L20.16,10.81M6.05,2.66L16.81,8.88L14.54,11.15L6.05,2.66Z"/>
                </svg>
                <div class="text-left">
                    <div class="text-sm">Get it on</div>
                    <div class="text-xl font-bold">Google Play</div>
                </div>
            </a>
        </div>
        
        <!-- App Features -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16">
            <div class="text-center">
                <div class="text-4xl mb-2">📱</div>
                <div class="font-semibold">Mobile First</div>
            </div>
            <div class="text-center">
                <div class="text-4xl mb-2">💬</div>
                <div class="font-semibold">Push Notifications</div>
            </div>
            <div class="text-center">
                <div class="text-4xl mb-2">📍</div>
                <div class="font-semibold">Location Based</div>
            </div>
            <div class="text-center">
                <div class="text-4xl mb-2">🔄</div>
                <div class="font-semibold">Offline Sync</div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="py-20 bg-gradient-to-br from-pink-100 to-rose-200">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-gradient-pink mb-6">Ready to Find Love?</h2>
        <p class="text-xl text-gray-700 mb-8">Join millions of singles who found their perfect match on LoveConnect</p>
        
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
            <a href="register.php" class="btn-dating text-lg px-8 py-4 hover:scale-110">
                Start Your Journey 💕
            </a>
            <a href="login.php" class="btn-dating-outline text-lg px-8 py-4 hover:scale-105">
                Already a Member?
            </a>
        </div>
        
        <!-- Trust Indicators -->
        <div class="flex flex-wrap justify-center items-center space-x-8 mt-12 opacity-60">
            <div class="text-sm text-gray-600">🔒 SSL Encrypted</div>
            <div class="text-sm text-gray-600">✅ Verified Profiles</div>
            <div class="text-sm text-gray-600">🛡️ Privacy Protected</div>
            <div class="text-sm text-gray-600">💯 Spam Free</div>
        </div>
    </div>
</section>

<script>
function scrollToHowItWorks() {
    document.getElementById('how-it-works').scrollIntoView({
        behavior: 'smooth'
    });
}

// Parallax effect for hero section
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero-background');
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});
</script>

<?php 
$additional_js = ['assets/js/landing.js'];
require_once 'includes/footer.php'; 
?>