<?php 
$page_title = "Join LoveConnect - Find Your Perfect Match";
require_once 'includes/header.php';

// Redirect if already logged in
if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}
?>

<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="text-6xl mb-4 animate-heart-beat">💕</div>
            <h1 class="text-4xl font-bold text-gradient-pink mb-2">Join LoveConnect</h1>
            <p class="text-xl text-gray-600">Start your journey to find love today</p>
            <div class="flex justify-center mt-4 space-x-8 text-sm text-gray-500">
                <div>✅ Free to join</div>
                <div>✅ Verified profiles</div>
                <div>✅ Safe & secure</div>
            </div>
        </div>

        <!-- Registration Form -->
        <div class="card-dating">
            <form class="ajax-form" action="api/auth.php" method="POST" id="register-form">
                <input type="hidden" name="action" value="register">
                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                
                <!-- Step Indicator -->
                <div class="flex justify-center mb-8">
                    <div class="flex space-x-4">
                        <div class="step-indicator active" data-step="1">
                            <span class="step-number">1</span>
                            <span class="step-label">Basic Info</span>
                        </div>
                        <div class="step-line"></div>
                        <div class="step-indicator" data-step="2">
                            <span class="step-number">2</span>
                            <span class="step-label">Details</span>
                        </div>
                        <div class="step-line"></div>
                        <div class="step-indicator" data-step="3">
                            <span class="step-number">3</span>
                            <span class="step-label">Photos</span>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Basic Information -->
                <div class="form-step active" id="step-1">
                    <h3 class="text-2xl font-bold text-center text-gradient-pink mb-6">Basic Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                First Name *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-400 text-xl">👤</span>
                                </div>
                                <input 
                                    id="first_name" 
                                    name="first_name" 
                                    type="text" 
                                    required 
                                    class="form-input pl-12" 
                                    placeholder="Your first name"
                                    autocomplete="given-name"
                                >
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Last Name *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-400 text-xl">👤</span>
                                </div>
                                <input 
                                    id="last_name" 
                                    name="last_name" 
                                    type="text" 
                                    required 
                                    class="form-input pl-12" 
                                    placeholder="Your last name"
                                    autocomplete="family-name"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address *
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
                        <p class="text-sm text-gray-500 mt-1">We'll send you verification email</p>
                    </div>

                    <!-- Password -->
                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password *
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
                                placeholder="Create strong password"
                                autocomplete="new-password"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" onclick="togglePassword('password')" class="text-gray-400 hover:text-gray-600">
                                    <span id="password-toggle">👁️</span>
                                </button>
                            </div>
                        </div>
                        <!-- Password Strength Indicator -->
                        <div class="mt-2">
                            <div class="flex space-x-1">
                                <div class="password-strength-bar" id="strength-1"></div>
                                <div class="password-strength-bar" id="strength-2"></div>
                                <div class="password-strength-bar" id="strength-3"></div>
                                <div class="password-strength-bar" id="strength-4"></div>
                            </div>
                            <p class="text-sm mt-1" id="password-strength-text">Password strength</p>
                        </div>
                    </div>

                    <!-- Birthdate -->
                    <div class="mt-6">
                        <label for="birthdate" class="block text-sm font-medium text-gray-700 mb-2">
                            Date of Birth *
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-xl">🎂</span>
                            </div>
                            <input 
                                id="birthdate" 
                                name="birthdate" 
                                type="date" 
                                required 
                                class="form-input pl-12" 
                                max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"
                            >
                        </div>
                        <p class="text-sm text-gray-500 mt-1">You must be 18 or older</p>
                    </div>

                    <div class="mt-8">
                        <button type="button" onclick="nextStep(1)" class="btn-dating w-full">
                            Continue to Details 💕
                        </button>
                    </div>
                </div>

                <!-- Step 2: Details -->
                <div class="form-step" id="step-2">
                    <h3 class="text-2xl font-bold text-center text-gradient-pink mb-6">Tell Us About Yourself</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                I am *
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="male" class="text-dating-600" required>
                                    <span class="ml-2">👨 Man</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="female" class="text-dating-600" required>
                                    <span class="ml-2">👩 Woman</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="other" class="text-dating-600" required>
                                    <span class="ml-2">🏳️‍🌈 Other</span>
                                </label>
                            </div>
                        </div>

                        <!-- Interested In -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Interested in *
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="interested_in" value="male" class="text-dating-600" required>
                                    <span class="ml-2">👨 Men</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="interested_in" value="female" class="text-dating-600" required>
                                    <span class="ml-2">👩 Women</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="interested_in" value="both" class="text-dating-600" required>
                                    <span class="ml-2">💕 Both</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="mt-6">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            Location *
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-xl">📍</span>
                            </div>
                            <input 
                                id="location" 
                                name="location" 
                                type="text" 
                                required 
                                class="form-input pl-12" 
                                placeholder="City, Country"
                            >
                            <button type="button" onclick="getLocation()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-dating-600 hover:text-dating-700">
                                🎯 Use Current
                            </button>
                        </div>
                    </div>

                    <!-- Bio -->
                    <div class="mt-6">
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                            About Me
                        </label>
                        <textarea 
                            id="bio" 
                            name="bio" 
                            rows="4" 
                            class="form-input" 
                            placeholder="Tell us about yourself, your interests, what you're looking for..."
                            maxlength="500"
                        ></textarea>
                        <div class="flex justify-between text-sm text-gray-500 mt-1">
                            <span>Help others get to know you better</span>
                            <span id="bio-count">0/500</span>
                        </div>
                    </div>

                    <div class="flex space-x-4 mt-8">
                        <button type="button" onclick="prevStep(2)" class="btn-dating-outline flex-1">
                            ← Back
                        </button>
                        <button type="button" onclick="nextStep(2)" class="btn-dating flex-1">
                            Add Photos 📸
                        </button>
                    </div>
                </div>

                <!-- Step 3: Photos -->
                <div class="form-step" id="step-3">
                    <h3 class="text-2xl font-bold text-center text-gradient-pink mb-6">Add Your Best Photos</h3>
                    
                    <div class="text-center mb-6">
                        <p class="text-gray-600">Upload at least 2 photos to get started. More photos get more matches!</p>
                    </div>

                    <!-- Photo Upload Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                        <div class="photo-upload-slot primary" data-slot="0">
                            <div class="upload-placeholder">
                                <span class="text-4xl">📸</span>
                                <p class="text-sm mt-2">Main Photo</p>
                                <span class="text-xs text-gray-500">Required</span>
                            </div>
                            <input type="file" name="photos[]" accept="image/*" class="hidden" onchange="handlePhotoUpload(this, 0)">
                        </div>

                        <?php for($i = 1; $i < 6; $i++): ?>
                        <div class="photo-upload-slot" data-slot="<?php echo $i; ?>">
                            <div class="upload-placeholder">
                                <span class="text-3xl">➕</span>
                                <p class="text-sm mt-2">Add Photo</p>
                            </div>
                            <input type="file" name="photos[]" accept="image/*" class="hidden" onchange="handlePhotoUpload(this, <?php echo $i; ?>)">
                        </div>
                        <?php endfor; ?>
                    </div>

                    <!-- Photo Guidelines -->
                    <div class="bg-pink-50 border border-pink-200 rounded-xl p-4 mb-6">
                        <h4 class="font-semibold text-dating-700 mb-2">📝 Photo Guidelines</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>✅ Clear, high-quality photos</li>
                            <li>✅ Show your face clearly</li>
                            <li>✅ Smile and be yourself</li>
                            <li>❌ No group photos as main</li>
                            <li>❌ No inappropriate content</li>
                            <li>❌ No heavily filtered images</li>
                        </ul>
                    </div>

                    <!-- Terms and Privacy -->
                    <div class="mt-6">
                        <label class="flex items-start">
                            <input type="checkbox" name="agree_terms" required class="mt-1 text-dating-600">
                            <span class="ml-2 text-sm text-gray-600">
                                I agree to the <a href="terms.php" class="text-dating-600 hover:underline">Terms of Service</a> 
                                and <a href="privacy.php" class="text-dating-600 hover:underline">Privacy Policy</a>. 
                                I confirm that I am at least 18 years old and all information provided is accurate.
                            </span>
                        </label>
                    </div>

                    <!-- Marketing Consent -->
                    <div class="mt-4">
                        <label class="flex items-start">
                            <input type="checkbox" name="marketing_consent" class="mt-1 text-dating-600">
                            <span class="ml-2 text-sm text-gray-600">
                                I'd like to receive dating tips, success stories, and special offers via email.
                            </span>
                        </label>
                    </div>

                    <div class="flex space-x-4 mt-8">
                        <button type="button" onclick="prevStep(3)" class="btn-dating-outline flex-1">
                            ← Back
                        </button>
                        <button type="submit" class="btn-dating flex-1 relative" id="register-btn">
                            <span class="relative z-10">Create My Account 💕</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Social Registration -->
        <div class="text-center mt-8">
            <p class="text-gray-600 mb-4">Or sign up with</p>
            <div class="flex justify-center space-x-4">
                <button class="flex items-center space-x-2 bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200">
                    <span class="text-xl">📘</span>
                    <span>Facebook</span>
                </button>
                <button class="flex items-center space-x-2 bg-red-500 text-white px-6 py-3 rounded-xl hover:bg-red-600 transition-colors duration-200">
                    <span class="text-xl">🌐</span>
                    <span>Google</span>
                </button>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center mt-6">
            <p class="text-gray-600">
                Already have an account? 
                <a href="login.php" class="text-dating-600 hover:text-dating-700 font-semibold">
                    Sign in here
                </a>
            </p>
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

<style>
/* Multi-step form styles */
.form-step {
    display: none;
}

.form-step.active {
    display: block;
    animation: fadeInUp 0.5s ease-out;
}

.step-indicator {
    display: flex;
    flex-direction: column;
    align-items: center;
    opacity: 0.5;
    transition: opacity 0.3s;
}

.step-indicator.active {
    opacity: 1;
}

.step-number {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e5e7eb;
    display: flex;
    items-center: justify-content: center;
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 8px;
    transition: all 0.3s;
}

.step-indicator.active .step-number {
    background: linear-gradient(135deg, #ec4899, #db2777);
    color: white;
}

.step-label {
    font-size: 12px;
    color: #6b7280;
    text-align: center;
}

.step-line {
    width: 32px;
    height: 2px;
    background: #e5e7eb;
    margin-top: 16px;
}

.step-indicator.active + .step-line {
    background: linear-gradient(135deg, #ec4899, #db2777);
}

/* Photo upload styles */
.photo-upload-slot {
    aspect-ratio: 3/4;
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
}

.photo-upload-slot:hover {
    border-color: #ec4899;
    background: #fdf2f8;
}

.photo-upload-slot.primary {
    border-color: #ec4899;
    background: #fef7f0;
}

.upload-placeholder {
    text-align: center;
    transition: all 0.3s;
}

.photo-upload-slot:hover .upload-placeholder {
    transform: scale(1.05);
}

.photo-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-remove {
    position: absolute;
    top: 4px;
    right: 4px;
    background: rgba(0,0,0,0.7);
    color: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    items-center;
    justify-content: center;
    cursor: pointer;
    font-size: 12px;
}

/* Password strength indicator */
.password-strength-bar {
    height: 4px;
    background: #e5e7eb;
    border-radius: 2px;
    flex: 1;
    transition: background-color 0.3s;
}

.password-strength-bar.weak { background: #ef4444; }
.password-strength-bar.fair { background: #f97316; }
.password-strength-bar.good { background: #eab308; }
.password-strength-bar.strong { background: #22c55e; }
</style>

<script>
let currentStep = 1;
const totalSteps = 3;

// Step Navigation
function nextStep(step) {
    if (validateStep(step)) {
        if (step < totalSteps) {
            currentStep = step + 1;
            showStep(currentStep);
        }
    }
}

function prevStep(step) {
    if (step > 1) {
        currentStep = step - 1;
        showStep(currentStep);
    }
}

function showStep(step) {
    // Hide all steps
    document.querySelectorAll('.form-step').forEach(el => {
        el.classList.remove('active');
    });
    
    // Show current step
    document.getElementById(`step-${step}`).classList.add('active');
    
    // Update indicators
    document.querySelectorAll('.step-indicator').forEach((el, index) => {
        if (index < step) {
            el.classList.add('active');
        } else {
            el.classList.remove('active');
        }
    });
}

// Step Validation
function validateStep(step) {
    let isValid = true;
    
    if (step === 1) {
        const required = ['first_name', 'last_name', 'email', 'password', 'birthdate'];
        required.forEach(field => {
            const input = document.getElementById(field);
            if (!input.value.trim()) {
                showFieldError(input, 'This field is required');
                isValid = false;
            }
        });
        
        // Email validation
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value && !emailRegex.test(email.value)) {
            showFieldError(email, 'Please enter a valid email address');
            isValid = false;
        }
        
        // Age validation
        const birthdate = document.getElementById('birthdate');
        if (birthdate.value) {
            const age = calculateAge(birthdate.value);
            if (age < 18) {
                showFieldError(birthdate, 'You must be at least 18 years old');
                isValid = false;
            }
        }
    }
    
    if (step === 2) {
        if (!document.querySelector('input[name="gender"]:checked')) {
            showNotification('Please select your gender', 'error');
            isValid = false;
        }
        if (!document.querySelector('input[name="interested_in"]:checked')) {
            showNotification('Please select who you\'re interested in', 'error');
            isValid = false;
        }
        if (!document.getElementById('location').value.trim()) {
            showFieldError(document.getElementById('location'), 'Please enter your location');
            isValid = false;
        }
    }
    
    return isValid;
}

function showFieldError(field, message) {
    field.classList.add('border-red-500');
    
    // Remove existing error
    const existingError = field.parentElement.querySelector('.field-error');
    if (existingError) existingError.remove();
    
    // Add new error
    const error = document.createElement('p');
    error.className = 'field-error text-red-500 text-sm mt-1';
    error.textContent = message;
    field.parentElement.appendChild(error);
    
    // Remove error on input
    field.addEventListener('input', function() {
        this.classList.remove('border-red-500');
        const error = this.parentElement.querySelector('.field-error');
        if (error) error.remove();
    });
}

// Photo Upload Handler
function handlePhotoUpload(input, slot) {
    const file = input.files[0];
    if (file) {
        // Validate file
        if (!file.type.startsWith('image/')) {
            showNotification('Please select an image file', 'error');
            return;
        }
        
        if (file.size > 5 * 1024 * 1024) { // 5MB limit
            showNotification('Image size must be less than 5MB', 'error');
            return;
        }
        
        // Preview image
        const reader = new FileReader();
        reader.onload = function(e) {
            const slotElement = document.querySelector(`[data-slot="${slot}"]`);
            slotElement.innerHTML = `
                <img src="${e.target.result}" alt="Photo preview" class="photo-preview">
                <button type="button" class="photo-remove" onclick="removePhoto(${slot})">×</button>
            `;
            slotElement.classList.add('has-photo');
        };
        reader.readAsDataURL(file);
    }
}

function removePhoto(slot) {
    const slotElement = document.querySelector(`[data-slot="${slot}"]`);
    const input = slotElement.querySelector('input[type="file"]');
    
    // Reset input
    input.value = '';
    
    // Restore placeholder
    if (slot === 0) {
        slotElement.innerHTML = `
            <div class="upload-placeholder">
                <span class="text-4xl">📸</span>
                <p class="text-sm mt-2">Main Photo</p>
                <span class="text-xs text-gray-500">Required</span>
            </div>
            <input type="file" name="photos[]" accept="image/*" class="hidden" onchange="handlePhotoUpload(this, ${slot})">
        `;
    } else {
        slotElement.innerHTML = `
            <div class="upload-placeholder">
                <span class="text-3xl">➕</span>
                <p class="text-sm mt-2">Add Photo</p>
            </div>
            <input type="file" name="photos[]" accept="image/*" class="hidden" onchange="handlePhotoUpload(this, ${slot})">
        `;
    }
    
    slotElement.classList.remove('has-photo');
}

// Photo upload click handler
document.addEventListener('click', function(e) {
    if (e.target.closest('.photo-upload-slot') && !e.target.closest('.photo-remove')) {
        const slot = e.target.closest('.photo-upload-slot');
        const input = slot.querySelector('input[type="file"]');
        input.click();
    }
});

// Password Strength Checker
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strength = calculatePasswordStrength(password);
    updatePasswordStrengthIndicator(strength);
});

function calculatePasswordStrength(password) {
    let score = 0;
    
    if (password.length >= 8) score++;
    if (/[a-z]/.test(password)) score++;
    if (/[A-Z]/.test(password)) score++;
    if (/[0-9]/.test(password)) score++;
    if (/[^a-zA-Z0-9]/.test(password)) score++;
    
    return score;
}

function updatePasswordStrengthIndicator(strength) {
    const bars = document.querySelectorAll('.password-strength-bar');
    const text = document.getElementById('password-strength-text');
    
    // Reset bars
    bars.forEach(bar => {
        bar.className = 'password-strength-bar';
    });
    
    // Update based on strength
    const levels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
    const classes = ['', 'weak', 'fair', 'good', 'strong'];
    
    for (let i = 0; i < strength; i++) {
        bars[i].classList.add(classes[strength]);
    }
    
    text.textContent = strength > 0 ? levels[strength - 1] : 'Password strength';
    text.className = `text-sm mt-1 ${strength < 2 ? 'text-red-500' : strength < 4 ? 'text-yellow-500' : 'text-green-500'}`;
}

// Bio character counter
document.getElementById('bio').addEventListener('input', function() {
    const count = this.value.length;
    document.getElementById('bio-count').textContent = `${count}/500`;
});

// Location detection
function getLocation() {
    if (navigator.geolocation) {
        showLoading();
        navigator.geolocation.getCurrentPosition(
            function(position) {
                // Reverse geocoding would go here
                // For demo, just fill with placeholder
                document.getElementById('location').value = 'Istanbul, Turkey';
                hideLoading();
                showNotification('Location detected!', 'success');
            },
            function(error) {
                hideLoading();
                showNotification('Unable to detect location', 'error');
            }
        );
    } else {
        showNotification('Geolocation is not supported by this browser', 'error');
    }
}

// Utility Functions
function calculateAge(birthdate) {
    const birth = new Date(birthdate);
    const today = new Date();
    let age = today.getFullYear() - birth.getFullYear();
    const m = today.getMonth() - birth.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) {
        age--;
    }
    return age;
}

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

function showNotification(message, type = 'info') {
    if (window.datingApp && window.datingApp.notifications) {
        window.datingApp.notifications.show(message, type);
    } else {
        alert(message);
    }
}

// Form submission
document.getElementById('register-form').addEventListener('submit', function(e) {
    if (!validateStep(3)) {
        e.preventDefault();
        return;
    }
    
    // Check if at least main photo is uploaded
    const mainPhotoSlot = document.querySelector('[data-slot="0"]');
    if (!mainPhotoSlot.classList.contains('has-photo')) {
        e.preventDefault();
        showNotification('Please upload at least your main photo', 'error');
        return;
    }
    
    // Check terms agreement
    if (!document.querySelector('input[name="agree_terms"]:checked')) {
        e.preventDefault();
        showNotification('Please agree to the terms and conditions', 'error');
        return;
    }
    
    // Show loading state
    const submitBtn = document.getElementById('register-btn');
    submitBtn.innerHTML = '<span class="loading-hearts"><span class="loading-heart">💕</span><span class="loading-heart">💖</span><span class="loading-heart">💝</span></span>';
    submitBtn.disabled = true;
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    showStep(1);
    document.getElementById('first_name').focus();
});
</script>

<?php require_once 'includes/footer.php'; ?>