<?php
if (!defined('SITE_NAME')) {
    require_once 'config.php';
}

$current_page = basename($_SERVER['PHP_SELF'], '.php');
$user = get_current_user();
?>
<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>LoveConnect - Premium Dating Network</title>
    
    <!-- Favicons -->
    <link rel="icon" href="https://placehold.co/32x32?text=💕" type="image/x-icon">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <link href="assets/css/output.css" rel="stylesheet">
    
    <!-- Meta Tags -->
    <meta name="description" content="Premium Dating Network - Find your perfect match with LoveConnect. Safe, verified profiles and intelligent matching.">
    <meta name="keywords" content="dating, relationships, love, match, singles, chat">
    <meta name="author" content="LoveConnect">
    
    <!-- Open Graph -->
    <meta property="og:title" content="LoveConnect - Premium Dating Network">
    <meta property="og:description" content="Find your perfect match with intelligent matching and verified profiles">
    <meta property="og:image" content="https://placehold.co/1200x630?text=LoveConnect+Dating+Network">
    <meta property="og:url" content="<?php echo SITE_URL; ?>">
    <meta property="og:type" content="website">
    
    <!-- Additional CSS -->
    <style>
        .heart-float {
            animation: heartFloat 4s ease-in-out infinite;
        }
        
        @keyframes heartFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .romantic-glow {
            box-shadow: 0 0 20px rgba(236, 72, 153, 0.3);
        }
    </style>
</head>
<body class="h-full font-romantic">
    <!-- Navigation Header -->
    <nav class="bg-white/80 backdrop-blur-lg border-b border-pink-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center space-x-2 group">
                        <div class="text-2xl heart-float group-hover:scale-110 transition-transform duration-300">💕</div>
                        <span class="text-xl font-bold text-gradient-pink">LoveConnect</span>
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <?php if (is_logged_in()): ?>
                        <!-- Authenticated Navigation -->
                        <a href="dashboard.php" class="nav-link <?php echo $current_page == 'dashboard' ? 'active' : ''; ?>">
                            <span class="text-lg">🏠</span>
                            <span>Dashboard</span>
                        </a>
                        
                        <a href="discover.php" class="nav-link <?php echo $current_page == 'discover' ? 'active' : ''; ?>">
                            <span class="text-lg">🔍</span>
                            <span>Discover</span>
                        </a>
                        
                        <a href="matches.php" class="nav-link <?php echo $current_page == 'matches' ? 'active' : ''; ?>">
                            <span class="text-lg">💖</span>
                            <span>Matches</span>
                        </a>
                        
                        <a href="chat.php" class="nav-link <?php echo $current_page == 'chat' ? 'active' : ''; ?>">
                            <span class="text-lg">💬</span>
                            <span>Chat</span>
                        </a>
                        
                        <!-- User Profile Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center space-x-2 p-2 rounded-xl hover:bg-pink-50 transition-colors duration-200">
                                <img src="https://placehold.co/40x40?text=👤" alt="Profile" class="w-8 h-8 rounded-full">
                                <span class="text-sm font-medium"><?php echo htmlspecialchars($user['first_name']); ?></span>
                                <svg class="w-4 h-4 transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="py-2">
                                    <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-dating-600">My Profile</a>
                                    <a href="settings.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-dating-600">Settings</a>
                                    <a href="premium.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 hover:text-dating-600">
                                        <span class="flex items-center justify-between">
                                            Premium
                                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">✨</span>
                                        </span>
                                    </a>
                                    <hr class="my-1">
                                    <a href="api/auth.php?action=logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Guest Navigation -->
                        <a href="index.php" class="text-gray-600 hover:text-dating-600 transition-colors duration-200">Home</a>
                        <a href="#how-it-works" class="text-gray-600 hover:text-dating-600 transition-colors duration-200">How it Works</a>
                        <a href="#safety" class="text-gray-600 hover:text-dating-600 transition-colors duration-200">Safety</a>
                        
                        <div class="flex items-center space-x-3">
                            <a href="login.php" class="btn-dating-outline py-2 px-4 text-sm">Login</a>
                            <a href="register.php" class="btn-dating py-2 px-4 text-sm">Join Now</a>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button onclick="toggleMobileMenu()" class="text-gray-600 hover:text-dating-600 p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-pink-100">
            <div class="px-4 py-4 space-y-2">
                <?php if (is_logged_in()): ?>
                    <a href="dashboard.php" class="block nav-link">Dashboard</a>
                    <a href="discover.php" class="block nav-link">Discover</a>
                    <a href="matches.php" class="block nav-link">Matches</a>
                    <a href="chat.php" class="block nav-link">Chat</a>
                    <a href="profile.php" class="block nav-link">My Profile</a>
                    <a href="premium.php" class="block nav-link">Premium ✨</a>
                    <a href="api/auth.php?action=logout" class="block nav-link text-red-600">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="block nav-link">Login</a>
                    <a href="register.php" class="block nav-link">Join Now</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    
    <!-- Success/Error Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mx-4 mt-4" role="alert">
            <span class="block sm:inline"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></span>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mx-4 mt-4" role="alert">
            <span class="block sm:inline"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></span>
        </div>
    <?php endif; ?>

    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
        
        // Heart Animation
        document.addEventListener('DOMContentLoaded', function() {
            const hearts = document.querySelectorAll('.heart-float');
            hearts.forEach(heart => {
                heart.addEventListener('mouseenter', function() {
                    this.style.animation = 'heartbeat 0.6s ease-in-out';
                    setTimeout(() => {
                        this.style.animation = 'heartFloat 4s ease-in-out infinite';
                    }, 600);
                });
            });
        });
    </script>