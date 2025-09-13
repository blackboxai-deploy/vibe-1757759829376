<?php 
$page_title = "Dashboard - LoveConnect";
require_once 'includes/header.php';

// Redirect if not logged in
if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$user = get_current_user();
?>

<div class="min-h-screen bg-gradient-to-br from-pink-50 to-rose-100">
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            
            <!-- Left Sidebar - Profile & Navigation -->
            <div class="lg:col-span-1">
                <!-- Profile Card -->
                <div class="card-dating mb-6">
                    <div class="text-center">
                        <div class="relative inline-block">
                            <img src="https://placehold.co/120x120?text=👤" alt="Profile" class="w-20 h-20 rounded-full mx-auto mb-3">
                            <div class="absolute -top-1 -right-1 w-6 h-6 bg-green-400 rounded-full border-2 border-white"></div>
                        </div>
                        <h3 class="font-bold text-dating-700"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h3>
                        <p class="text-sm text-gray-600"><?php echo calculate_age($user['birthdate']); ?> years old</p>
                        
                        <!-- Profile Completion -->
                        <div class="mt-4">
                            <div class="flex items-center justify-between text-sm mb-2">
                                <span class="text-gray-600">Profile Completion</span>
                                <span class="font-semibold text-dating-600">85%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-dating-500 to-rose-500 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Add more photos to complete</p>
                        </div>
                        
                        <a href="profile.php" class="btn-dating-outline w-full mt-4">
                            Edit Profile
                        </a>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="card-dating mb-6">
                    <h4 class="font-bold text-gray-800 mb-4">Your Stats</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-xl mr-2">👁️</span>
                                <span class="text-sm">Profile Views</span>
                            </div>
                            <span class="font-semibold text-dating-600">127</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-xl mr-2">💖</span>
                                <span class="text-sm">Likes Received</span>
                            </div>
                            <span class="font-semibold text-dating-600">89</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-xl mr-2">💕</span>
                                <span class="text-sm">Matches</span>
                            </div>
                            <span class="font-semibold text-dating-600">23</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-xl mr-2">💬</span>
                                <span class="text-sm">Messages</span>
                            </div>
                            <span class="font-semibold text-dating-600">156</span>
                        </div>
                    </div>
                </div>
                
                <!-- Premium Upsell -->
                <div class="premium-card">
                    <div class="premium-badge">✨ Premium</div>
                    <h4 class="font-bold text-amber-800 mb-2">Upgrade to Premium</h4>
                    <ul class="text-sm text-amber-700 space-y-1 mb-4">
                        <li>✓ Unlimited likes</li>
                        <li>✓ See who liked you</li>
                        <li>✓ Advanced filters</li>
                        <li>✓ Read receipts</li>
                    </ul>
                    <a href="premium.php" class="btn-dating w-full">
                        Upgrade Now 💎
                    </a>
                </div>
            </div>
            
            <!-- Main Content Area -->
            <div class="lg:col-span-2">
                <!-- Welcome Message -->
                <div class="card-dating mb-6 text-center">
                    <h2 class="text-2xl font-bold text-gradient-pink mb-2">Welcome back, <?php echo htmlspecialchars($user['first_name']); ?>! 💕</h2>
                    <p class="text-gray-600">Ready to find your perfect match today?</p>
                    
                    <!-- Quick Actions -->
                    <div class="flex justify-center space-x-4 mt-6">
                        <a href="discover.php" class="btn-dating">
                            Start Swiping 💖
                        </a>
                        <a href="matches.php" class="btn-dating-outline">
                            View Matches
                        </a>
                    </div>
                </div>
                
                <!-- Create Post -->
                <div class="card-dating mb-6">
                    <div class="flex items-start space-x-3">
                        <img src="https://placehold.co/50x50?text=👤" alt="You" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <form class="ajax-form" action="api/posts.php" method="POST">
                                <input type="hidden" name="action" value="create">
                                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                                
                                <textarea 
                                    name="content" 
                                    class="form-input resize-none" 
                                    placeholder="What's on your mind? Share your thoughts with the community..."
                                    rows="3"
                                ></textarea>
                                
                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex space-x-2">
                                        <button type="button" class="text-gray-400 hover:text-dating-600 p-2 rounded-lg hover:bg-pink-50">
                                            <span class="text-xl">📸</span>
                                        </button>
                                        <button type="button" class="text-gray-400 hover:text-dating-600 p-2 rounded-lg hover:bg-pink-50">
                                            <span class="text-xl">😊</span>
                                        </button>
                                        <button type="button" class="text-gray-400 hover:text-dating-600 p-2 rounded-lg hover:bg-pink-50">
                                            <span class="text-xl">📍</span>
                                        </button>
                                    </div>
                                    <button type="submit" class="btn-dating px-6 py-2">
                                        Share 💕
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Feed -->
                <div id="feed-container" class="space-y-6">
                    <!-- Sample Posts -->
                    <div class="card-dating hover-glow">
                        <!-- Post Header -->
                        <div class="flex items-center space-x-3 mb-4">
                            <img src="https://placehold.co/50x50?text=👩🏻" alt="Emma" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2">
                                    <h4 class="font-semibold text-gray-800">Emma Johnson</h4>
                                    <span class="verified-badge">✓</span>
                                </div>
                                <p class="text-sm text-gray-500">2 hours ago • Istanbul</p>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Post Content -->
                        <div class="mb-4">
                            <p class="text-gray-800 mb-3">Just finished an amazing yoga session at sunset! 🧘‍♀️ There's something magical about connecting with yourself while watching the sky paint itself in beautiful colors. Who else loves evening workouts? 💕</p>
                            <img src="https://placehold.co/600x400?text=Beautiful+sunset+yoga+session+on+beach+peaceful+woman+silhouette" alt="Sunset yoga" class="rounded-xl w-full object-cover h-64">
                        </div>
                        
                        <!-- Post Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex space-x-6">
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-red-500 transition-colors">
                                    <span class="text-xl">❤️</span>
                                    <span class="text-sm">42</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500 transition-colors">
                                    <span class="text-xl">💬</span>
                                    <span class="text-sm">12</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-green-500 transition-colors">
                                    <span class="text-xl">🔄</span>
                                    <span class="text-sm">5</span>
                                </button>
                            </div>
                            <button class="text-gray-500 hover:text-dating-600 transition-colors">
                                <span class="text-xl">📤</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Another Sample Post -->
                    <div class="card-dating hover-glow">
                        <div class="flex items-center space-x-3 mb-4">
                            <img src="https://placehold.co/50x50?text=👨🏻" alt="Alex" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2">
                                    <h4 class="font-semibold text-gray-800">Alex Miller</h4>
                                    <span class="verified-badge">✓</span>
                                </div>
                                <p class="text-sm text-gray-500">4 hours ago • New York</p>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-gray-800">Cooked my first homemade pasta from scratch today! 🍝 It wasn't perfect, but the journey was so much fun. Looking for someone who'd love to cook together and explore new recipes. Food is definitely a love language! 👨‍🍳💕</p>
                        </div>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex space-x-6">
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-red-500 transition-colors">
                                    <span class="text-xl">❤️</span>
                                    <span class="text-sm">28</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-blue-500 transition-colors">
                                    <span class="text-xl">💬</span>
                                    <span class="text-sm">8</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 hover:text-green-500 transition-colors">
                                    <span class="text-xl">🔄</span>
                                    <span class="text-sm">3</span>
                                </button>
                            </div>
                            <button class="text-gray-500 hover:text-dating-600 transition-colors">
                                <span class="text-xl">📤</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Load More -->
                    <div class="text-center py-6">
                        <button onclick="loadMorePosts()" class="btn-dating-outline">
                            Load More Posts
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Right Sidebar - Suggestions & Activity -->
            <div class="lg:col-span-1">
                <!-- Match Suggestions -->
                <div class="card-dating mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-gray-800">Perfect Matches</h4>
                        <a href="discover.php" class="text-sm text-dating-600 hover:text-dating-700">See All</a>
                    </div>
                    
                    <div class="space-y-3">
                        <!-- Match Suggestion 1 -->
                        <div class="flex items-center space-x-3">
                            <img src="https://placehold.co/50x50?text=👩🏽" alt="Sarah" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <h5 class="font-semibold text-sm">Sarah, 26</h5>
                                <p class="text-xs text-gray-500">2.3 km away</p>
                                <div class="flex text-xs mt-1">
                                    <span class="interest-badge mr-1">🎵 Music</span>
                                    <span class="interest-badge">🍕 Food</span>
                                </div>
                            </div>
                            <button class="btn-like p-2 rounded-full bg-pink-100 hover:bg-pink-200 transition-colors" data-user-id="123">
                                <span class="text-xl">💖</span>
                            </button>
                        </div>
                        
                        <!-- Match Suggestion 2 -->
                        <div class="flex items-center space-x-3">
                            <img src="https://placehold.co/50x50?text=👩🏼" alt="Lisa" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <h5 class="font-semibold text-sm">Lisa, 24</h5>
                                <p class="text-xs text-gray-500">1.8 km away</p>
                                <div class="flex text-xs mt-1">
                                    <span class="interest-badge mr-1">📸 Photography</span>
                                    <span class="interest-badge">✈️ Travel</span>
                                </div>
                            </div>
                            <button class="btn-like p-2 rounded-full bg-pink-100 hover:bg-pink-200 transition-colors" data-user-id="124">
                                <span class="text-xl">💖</span>
                            </button>
                        </div>
                        
                        <!-- Match Suggestion 3 -->
                        <div class="flex items-center space-x-3">
                            <img src="https://placehold.co/50x50?text=👩🏻" alt="Anna" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <h5 class="font-semibold text-sm">Anna, 28</h5>
                                <p class="text-xs text-gray-500">3.1 km away</p>
                                <div class="flex text-xs mt-1">
                                    <span class="interest-badge mr-1">🧘 Yoga</span>
                                    <span class="interest-badge">🍷 Wine</span>
                                </div>
                            </div>
                            <button class="btn-like p-2 rounded-full bg-pink-100 hover:bg-pink-200 transition-colors" data-user-id="125">
                                <span class="text-xl">💖</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="card-dating mb-6">
                    <h4 class="font-bold text-gray-800 mb-4">Recent Activity</h4>
                    
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center">
                                <span class="text-sm">💖</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">
                                    <span class="font-semibold">Emma</span> liked your photo
                                </p>
                                <p class="text-xs text-gray-500">10 minutes ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-sm">💬</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">
                                    <span class="font-semibold">Alex</span> sent you a message
                                </p>
                                <p class="text-xs text-gray-500">1 hour ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-sm">👁️</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">
                                    <span class="font-semibold">5 people</span> viewed your profile
                                </p>
                                <p class="text-xs text-gray-500">3 hours ago</p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="activity.php" class="block text-center text-sm text-dating-600 hover:text-dating-700 mt-4">
                        View All Activity
                    </a>
                </div>
                
                <!-- Online Friends -->
                <div class="card-dating">
                    <h4 class="font-bold text-gray-800 mb-4">Online Now</h4>
                    
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <img src="https://placehold.co/40x40?text=👩🏼" alt="Maria" class="w-10 h-10 rounded-full">
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-sm">Maria</h5>
                                <p class="text-xs text-gray-500">Active now</p>
                            </div>
                            <a href="chat.php?user=maria" class="text-dating-600 hover:text-dating-700">
                                <span class="text-lg">💬</span>
                            </a>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <img src="https://placehold.co/40x40?text=👨🏽" alt="David" class="w-10 h-10 rounded-full">
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-sm">David</h5>
                                <p class="text-xs text-gray-500">Active 2m ago</p>
                            </div>
                            <a href="chat.php?user=david" class="text-dating-600 hover:text-dating-700">
                                <span class="text-lg">💬</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Load more posts
function loadMorePosts() {
    showLoading();
    
    // Simulate API call
    setTimeout(() => {
        hideLoading();
        
        if (window.datingApp && window.datingApp.notifications) {
            window.datingApp.notifications.show('More posts loaded! 📝', 'success');
        }
    }, 1000);
}

// Auto-refresh activity
setInterval(() => {
    // Check for new activity every 30 seconds
    fetch('api/activity.php?check=true')
        .then(response => response.json())
        .then(data => {
            if (data.newActivity) {
                // Update activity section
                updateActivityFeed(data.activities);
            }
        })
        .catch(error => console.error('Activity check error:', error));
}, 30000);

function updateActivityFeed(activities) {
    // Implementation would update the activity feed with new items
    console.log('New activities:', activities);
}

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
    // Add heart animation to like buttons
    document.querySelectorAll('.btn-like').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const rect = this.getBoundingClientRect();
            
            // Create floating heart
            const heart = document.createElement('div');
            heart.className = 'fixed pointer-events-none z-50 text-4xl animate-bounce-heart';
            heart.innerHTML = '💖';
            heart.style.left = rect.left + rect.width/2 + 'px';
            heart.style.top = rect.top + 'px';
            
            document.body.appendChild(heart);
            
            setTimeout(() => heart.remove(), 1000);
            
            // Send like action
            const userId = this.dataset.userId;
            if (window.datingApp) {
                window.datingApp.sendSwipeAction(userId, 'like');
            }
        });
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>