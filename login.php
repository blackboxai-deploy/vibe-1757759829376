<?php 
$page_title = "Login to Your Account";
require_once 'includes/header.php';

// Redirect if already logged in
if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}
?>

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="text-6xl mb-4">💕</div>
            <h2 class="text-3xl font-bold text-gradient-pink mb-2">Welcome Back!</h2>
            <p class="text-gray-600">Sign in to continue your love journey</p>
        </div>

        <!-- Login Form -->
        <div class="card-dating">
            <form class="ajax-form" action="api/auth.php" method="POST" id="login-form">
                <input type="hidden" name="action" value="login">
                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                
                <div class="space-y-6">
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-xl">📧</span>
                            </div>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                required 
                                class="form-input pl-12" 
                                placeholder="Enter your email"
                                autocomplete="email"
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-xl">🔒</span>
                            </div>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                class="form-input pl-12 pr-12" 
                                placeholder="Enter your password"
                                autocomplete="current-password"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" onclick="togglePassword('password')" class="text-gray-400 hover:text-gray-600">
                                    <span id="password-toggle">👁️</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember_me" 
                                name="remember_me" 
                                type="checkbox" 
                                class="h-4 w-4 text-dating-600 focus:ring-dating-500 border-gray-300 rounded"
                            >
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>
                        <a href="forgot-password.php" class="text-sm text-dating-600 hover:text-dating-700">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button 
                            type="submit" 
                            class="btn-dating w-full text-lg py-3 relative overflow-hidden"
                            id="login-btn"
                        >
                            <span class="relative z-10">Sign In 💖</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-rose-500 to-pink-500 opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Social Login -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <button class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-xl bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-xl mr-2">📘</span>
                        Facebook
                    </button>
                    <button class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-xl bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                        <span class="text-xl mr-2">🌐</span>
                        Google
                    </button>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center mt-6">
                <p class="text-gray-600">
                    Don't have an account? 
                    <a href="register.php" class="text-dating-600 hover:text-dating-700 font-semibold">
                        Join free today
                    </a>
                </p>
            </div>
        </div>

        <!-- Trust Indicators -->
        <div class="text-center">
            <div class="flex justify-center space-x-6 text-sm text-gray-500">
                <div class="flex items-center">
                    <span class="mr-1">🔒</span>
                    SSL Secured
                </div>
                <div class="flex items-center">
                    <span class="mr-1">🛡️</span>
                    Privacy Protected
                </div>
                <div class="flex items-center">
                    <span class="mr-1">✅</span>
                    Verified Profiles
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Hearts Animation -->
<div class="fixed inset-0 pointer-events-none overflow-hidden">
    <div class="heart-float absolute top-1/4 left-10 text-4xl text-pink-300 opacity-20">💕</div>
    <div class="heart-float absolute top-1/3 right-16 text-3xl text-rose-300 opacity-30" style="animation-delay: 1s">💖</div>
    <div class="heart-float absolute bottom-1/3 left-1/4 text-5xl text-pink-200 opacity-25" style="animation-delay: 2s">💝</div>
    <div class="heart-float absolute bottom-1/4 right-1/3 text-4xl text-rose-200 opacity-20" style="animation-delay: 3s">💗</div>
</div>

<script>
// Toggle Password Visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const toggle = document.getElementById(fieldId + '-toggle');
    
    if (field.type === 'password') {
        field.type = 'text';
        toggle.textContent = '🙈';
    } else {
        field.type = 'password';
        toggle.textContent = '👁️';
    }
}

// Enhanced form validation
document.getElementById('login-form').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    // Basic validation
    if (!email || !password) {
        e.preventDefault();
        showNotification('Please fill in all fields', 'error');
        return false;
    }
    
    // Email format validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        e.preventDefault();
        showNotification('Please enter a valid email address', 'error');
        return false;
    }
    
    // Show loading state
    const submitBtn = document.getElementById('login-btn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="loading-hearts"><span class="loading-heart">💕</span><span class="loading-heart">💖</span><span class="loading-heart">💝</span></span>';
    submitBtn.disabled = true;
    
    // Reset button after 3 seconds if form doesn't redirect
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 3000);
});

// Show notification function
function showNotification(message, type = 'info') {
    if (window.datingApp && window.datingApp.notifications) {
        window.datingApp.notifications.show(message, type);
    } else {
        alert(message);
    }
}

// Auto-focus first input
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('email').focus();
    
    // Add romantic glow effect on focus
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('romantic-glow');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('romantic-glow');
        });
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>