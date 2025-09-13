/**
 * LoveConnect Dating Network - Main JavaScript File
 * Core functionality for the entire application
 */

class DatingApp {
    constructor() {
        this.init();
        this.bindEvents();
        this.initHeartAnimations();
    }

    init() {
        console.log('🍕 LoveConnect Dating Network Initialized');
        
        // Initialize CSRF token for AJAX requests
        this.csrfToken = window.csrfToken || '';
        
        // Initialize notification system
        this.initNotifications();
        
        // Initialize intersection observer for animations
        this.initScrollAnimations();
        
        // Initialize swipe functionality for mobile
        this.initSwipeGestures();
    }

    bindEvents() {
        // Global click handlers
        document.addEventListener('click', this.handleGlobalClicks.bind(this));
        
        // Form submissions
        document.addEventListener('submit', this.handleFormSubmissions.bind(this));
        
        // Window events
        window.addEventListener('scroll', this.handleScroll.bind(this));
        window.addEventListener('resize', this.handleResize.bind(this));
        
        // Visibility change for real-time features
        document.addEventListener('visibilitychange', this.handleVisibilityChange.bind(this));
    }

    // Heart Animation System
    initHeartAnimations() {
        this.heartAnimations = {
            createFloatingHeart: (x, y, type = 'like') => {
                const heart = document.createElement('div');
                heart.className = `absolute pointer-events-none z-50 text-4xl ${type === 'super' ? 'text-yellow-400' : 'text-red-400'}`;
                heart.innerHTML = type === 'super' ? '⭐' : '💖';
                heart.style.left = x + 'px';
                heart.style.top = y + 'px';
                heart.style.transform = 'scale(0)';
                
                document.body.appendChild(heart);
                
                // Animate
                anime({
                    targets: heart,
                    scale: [0, 1.5, 0],
                    translateY: -100,
                    opacity: [1, 1, 0],
                    duration: 2000,
                    easing: 'easeOutQuart',
                    complete: () => heart.remove()
                });
            },

            likeExplosion: (element) => {
                const rect = element.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;
                
                // Create multiple hearts
                for (let i = 0; i < 8; i++) {
                    setTimeout(() => {
                        this.heartAnimations.createFloatingHeart(
                            centerX + (Math.random() - 0.5) * 200,
                            centerY + (Math.random() - 0.5) * 200
                        );
                    }, i * 100);
                }
            }
        };
    }

    // Notification System
    initNotifications() {
        this.notifications = {
            container: null,
            
            init: () => {
                if (!this.notifications.container) {
                    this.notifications.container = document.createElement('div');
                    this.notifications.container.id = 'notification-container';
                    this.notifications.container.className = 'fixed top-4 right-4 z-50 space-y-2';
                    document.body.appendChild(this.notifications.container);
                }
            },

            show: (message, type = 'info', duration = 5000) => {
                this.notifications.init();
                
                const notification = document.createElement('div');
                const icons = {
                    success: '✅',
                    error: '❌', 
                    info: 'ℹ️',
                    match: '💖',
                    message: '💬'
                };
                
                notification.className = `
                    card-dating max-w-sm transform translate-x-full opacity-0 transition-all duration-300
                    ${type === 'success' ? 'border-green-200 bg-green-50' : ''}
                    ${type === 'error' ? 'border-red-200 bg-red-50' : ''}
                    ${type === 'match' ? 'border-pink-200 bg-pink-50' : ''}
                `;
                
                notification.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <span class="text-2xl">${icons[type] || icons.info}</span>
                        <p class="text-sm font-medium flex-1">${message}</p>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                `;
                
                this.notifications.container.appendChild(notification);
                
                // Animate in
                setTimeout(() => {
                    notification.classList.remove('translate-x-full', 'opacity-0');
                }, 100);
                
                // Auto remove
                if (duration > 0) {
                    setTimeout(() => {
                        notification.classList.add('translate-x-full', 'opacity-0');
                        setTimeout(() => notification.remove(), 300);
                    }, duration);
                }
            }
        };
    }

    // Scroll Animations
    initScrollAnimations() {
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                    }
                });
            }, { threshold: 0.1 });

            // Observe elements with animation class
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        }
    }

    // Swipe Gestures for Mobile
    initSwipeGestures() {
        let startX, startY, distX, distY;
        
        document.addEventListener('touchstart', (e) => {
            const touch = e.touches[0];
            startX = touch.clientX;
            startY = touch.clientY;
        });

        document.addEventListener('touchmove', (e) => {
            if (!startX || !startY) return;
            
            const touch = e.touches[0];
            distX = touch.clientX - startX;
            distY = touch.clientY - startY;
        });

        document.addEventListener('touchend', (e) => {
            if (!startX || !startY) return;
            
            const swipeThreshold = 100;
            const card = e.target.closest('.swipe-card');
            
            if (card && Math.abs(distX) > swipeThreshold) {
                if (distX > 0) {
                    this.handleSwipe(card, 'right'); // Like
                } else {
                    this.handleSwipe(card, 'left'); // Pass
                }
            }
            
            startX = startY = distX = distY = 0;
        });
    }

    // Swipe Handler
    handleSwipe(card, direction) {
        const userId = card.dataset.userId;
        const action = direction === 'right' ? 'like' : 'pass';
        
        // Animate card
        card.style.transform = `translateX(${direction === 'right' ? '100%' : '-100%'}) rotate(${direction === 'right' ? '20deg' : '-20deg'})`;
        card.style.opacity = '0';
        
        // Send to server
        this.sendSwipeAction(userId, action);
        
        // Remove card after animation
        setTimeout(() => {
            card.remove();
            this.loadNextCard();
        }, 300);
        
        // Show heart animation for likes
        if (direction === 'right') {
            this.heartAnimations.likeExplosion(card);
        }
    }

    // AJAX Functions
    async sendSwipeAction(userId, action) {
        try {
            const response = await fetch('api/swipes.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': this.csrfToken
                },
                body: JSON.stringify({
                    user_id: userId,
                    action: action
                })
            });
            
            const data = await response.json();
            
            if (data.match) {
                this.notifications.show('🎉 It\'s a match! Start chatting now!', 'match');
                this.showMatchModal(data.matchedUser);
            }
            
        } catch (error) {
            console.error('Swipe error:', error);
        }
    }

    // Match Modal
    showMatchModal(matchedUser) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        modal.innerHTML = `
            <div class="card-dating max-w-md w-full mx-4 text-center animate-bounce-heart">
                <div class="text-6xl mb-4">💖</div>
                <h2 class="text-3xl font-bold text-gradient-pink mb-4">It's a Match!</h2>
                <div class="flex justify-center items-center space-x-4 mb-6">
                    <img src="${matchedUser.photo}" alt="You" class="w-20 h-20 rounded-full">
                    <div class="text-4xl">💕</div>
                    <img src="${matchedUser.photo}" alt="${matchedUser.name}" class="w-20 h-20 rounded-full">
                </div>
                <p class="text-gray-600 mb-6">You and ${matchedUser.name} liked each other!</p>
                <div class="flex space-x-4">
                    <button onclick="this.closest('.fixed').remove()" class="btn-dating-outline flex-1">Keep Swiping</button>
                    <a href="chat.php?match=${matchedUser.id}" class="btn-dating flex-1">Start Chatting</a>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Auto-remove after 5 seconds if no interaction
        setTimeout(() => {
            if (document.body.contains(modal)) {
                modal.remove();
            }
        }, 5000);
    }

    // Global Event Handlers
    handleGlobalClicks(e) {
        // Like button clicks
        if (e.target.matches('.btn-like, .btn-like *')) {
            e.preventDefault();
            const button = e.target.closest('.btn-like');
            const userId = button.dataset.userId;
            this.sendSwipeAction(userId, 'like');
            this.heartAnimations.likeExplosion(button);
        }
        
        // Pass button clicks
        if (e.target.matches('.btn-pass, .btn-pass *')) {
            e.preventDefault();
            const button = e.target.closest('.btn-pass');
            const userId = button.dataset.userId;
            this.sendSwipeAction(userId, 'pass');
        }
        
        // Super like button clicks
        if (e.target.matches('.btn-super-like, .btn-super-like *')) {
            e.preventDefault();
            const button = e.target.closest('.btn-super-like');
            const userId = button.dataset.userId;
            this.sendSwipeAction(userId, 'super_like');
            this.heartAnimations.createFloatingHeart(e.clientX, e.clientY, 'super');
        }
    }

    handleFormSubmissions(e) {
        // Handle AJAX form submissions
        if (e.target.matches('.ajax-form')) {
            e.preventDefault();
            this.submitAjaxForm(e.target);
        }
    }

    async submitAjaxForm(form) {
        const formData = new FormData(form);
        formData.append('csrf_token', this.csrfToken);
        
        try {
            showLoading();
            
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.notifications.show(data.message || 'Success!', 'success');
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            } else {
                this.notifications.show(data.message || 'An error occurred', 'error');
            }
            
        } catch (error) {
            this.notifications.show('Network error. Please try again.', 'error');
            console.error('Form submission error:', error);
        } finally {
            hideLoading();
        }
    }

    handleScroll() {
        // Add scroll-based animations and effects
        const scrolled = window.pageYOffset;
        const nav = document.querySelector('nav');
        
        if (nav) {
            if (scrolled > 100) {
                nav.classList.add('bg-opacity-95', 'shadow-lg');
            } else {
                nav.classList.remove('bg-opacity-95', 'shadow-lg');
            }
        }
    }

    handleResize() {
        // Handle responsive behavior
        this.updateSwipeCardSizes();
    }

    handleVisibilityChange() {
        if (document.hidden) {
            // Pause real-time updates when tab is hidden
            this.pauseRealTimeUpdates();
        } else {
            // Resume real-time updates when tab is visible
            this.resumeRealTimeUpdates();
        }
    }

    // Real-time Updates (simulated)
    pauseRealTimeUpdates() {
        if (this.updateInterval) {
            clearInterval(this.updateInterval);
        }
    }

    resumeRealTimeUpdates() {
        this.updateInterval = setInterval(() => {
            this.checkForUpdates();
        }, 30000); // Check every 30 seconds
    }

    async checkForUpdates() {
        try {
            const response = await fetch('api/updates.php', {
                headers: {
                    'X-CSRF-Token': this.csrfToken
                }
            });
            
            const data = await response.json();
            
            if (data.newMatches > 0) {
                this.notifications.show(`You have ${data.newMatches} new match${data.newMatches > 1 ? 'es' : ''}!`, 'match');
            }
            
            if (data.newMessages > 0) {
                this.notifications.show(`You have ${data.newMessages} new message${data.newMessages > 1 ? 's' : ''}!`, 'message');
            }
            
        } catch (error) {
            console.error('Update check error:', error);
        }
    }

    // Utility Functions
    updateSwipeCardSizes() {
        const cards = document.querySelectorAll('.swipe-card');
        const containerWidth = window.innerWidth - 32; // Account for padding
        
        cards.forEach(card => {
            const maxWidth = Math.min(containerWidth, 400);
            card.style.width = maxWidth + 'px';
        });
    }

    loadNextCard() {
        // Load next card in discovery
        if (window.location.pathname.includes('discover')) {
            fetch('api/discover.php?next=1')
                .then(response => response.json())
                .then(data => {
                    if (data.user) {
                        this.addCardToStack(data.user);
                    }
                })
                .catch(error => console.error('Load next card error:', error));
        }
    }

    addCardToStack(userData) {
        const cardContainer = document.querySelector('.card-stack');
        if (!cardContainer) return;
        
        const card = document.createElement('div');
        card.className = 'swipe-card';
        card.dataset.userId = userData.id;
        card.innerHTML = `
            <img src="${userData.photo}" alt="${userData.name}" class="profile-photo">
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent text-white p-4">
                <h3 class="text-xl font-bold">${userData.name}, ${userData.age}</h3>
                <p class="text-sm opacity-90">${userData.distance}km away</p>
            </div>
        `;
        
        cardContainer.appendChild(card);
    }
}

// Utility Functions (Global)
function showLoading() {
    const overlay = document.getElementById('loading-overlay');
    if (overlay) {
        overlay.classList.remove('hidden');
    }
}

function hideLoading() {
    const overlay = document.getElementById('loading-overlay');
    if (overlay) {
        overlay.classList.add('hidden');
    }
}

// Initialize the app when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.datingApp = new DatingApp();
});

// Export for other modules
window.DatingApp = DatingApp;