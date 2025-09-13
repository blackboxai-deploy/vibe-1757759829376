-- Dating Network Database Schema
-- Create Database
CREATE DATABASE IF NOT EXISTS dating_network CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE dating_network;

-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    birthdate DATE NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    interested_in ENUM('male', 'female', 'both') NOT NULL,
    location_city VARCHAR(100),
    location_country VARCHAR(100),
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    is_verified BOOLEAN DEFAULT FALSE,
    is_premium BOOLEAN DEFAULT FALSE,
    premium_expires_at DATETIME NULL,
    profile_photo VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    last_seen DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_location (latitude, longitude),
    INDEX idx_gender (gender, interested_in),
    INDEX idx_active (is_active, last_seen)
);

-- User Profiles Table
CREATE TABLE user_profiles (
    user_id INT PRIMARY KEY,
    bio TEXT,
    occupation VARCHAR(255),
    education VARCHAR(255),
    height INT, -- in cm
    relationship_type ENUM('casual', 'serious', 'friendship', 'marriage') DEFAULT 'serious',
    smoking ENUM('never', 'sometimes', 'regularly') DEFAULT 'never',
    drinking ENUM('never', 'socially', 'regularly') DEFAULT 'socially',
    has_children BOOLEAN DEFAULT FALSE,
    wants_children BOOLEAN DEFAULT FALSE,
    languages JSON,
    personality_type VARCHAR(20),
    zodiac_sign VARCHAR(20),
    instagram_username VARCHAR(100),
    spotify_connected BOOLEAN DEFAULT FALSE,
    spotify_data JSON,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- User Photos Table
CREATE TABLE user_photos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    photo_url VARCHAR(255) NOT NULL,
    is_primary BOOLEAN DEFAULT FALSE,
    order_position INT DEFAULT 0,
    is_verified BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_photos (user_id, order_position)
);

-- Interests Table
CREATE TABLE interests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) UNIQUE NOT NULL,
    category VARCHAR(50),
    icon VARCHAR(50),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- User Interests Table
CREATE TABLE user_interests (
    user_id INT NOT NULL,
    interest_id INT NOT NULL,
    PRIMARY KEY (user_id, interest_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (interest_id) REFERENCES interests(id) ON DELETE CASCADE
);

-- Swipes Table (Likes/Passes)
CREATE TABLE swipes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    swiper_id INT NOT NULL,
    swiped_id INT NOT NULL,
    action ENUM('like', 'pass', 'super_like') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (swiper_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (swiped_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_swipe (swiper_id, swiped_id),
    INDEX idx_swipes (swiped_id, action)
);

-- Matches Table
CREATE TABLE matches (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user1_id INT NOT NULL,
    user2_id INT NOT NULL,
    matched_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE,
    last_message_at DATETIME NULL,
    FOREIGN KEY (user1_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (user2_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_match (LEAST(user1_id, user2_id), GREATEST(user1_id, user2_id)),
    INDEX idx_matches (user1_id, is_active),
    INDEX idx_matches_user2 (user2_id, is_active)
);

-- Messages Table
CREATE TABLE messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    match_id INT NOT NULL,
    sender_id INT NOT NULL,
    message_text TEXT,
    message_type ENUM('text', 'image', 'voice', 'gif') DEFAULT 'text',
    media_url VARCHAR(255),
    is_read BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (match_id) REFERENCES matches(id) ON DELETE CASCADE,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_messages (match_id, created_at),
    INDEX idx_unread (match_id, is_read)
);

-- Posts Table (Social Feed)
CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    content TEXT,
    image_url VARCHAR(255),
    post_type ENUM('text', 'image', 'story') DEFAULT 'text',
    is_story BOOLEAN DEFAULT FALSE,
    story_expires_at DATETIME NULL,
    likes_count INT DEFAULT 0,
    comments_count INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_posts (created_at, is_active),
    INDEX idx_stories (is_story, story_expires_at)
);

-- Post Likes Table
CREATE TABLE post_likes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_like (post_id, user_id),
    INDEX idx_post_likes (post_id)
);

-- Post Comments Table
CREATE TABLE post_comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    comment_text TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_comments (post_id, created_at)
);

-- Profile Visits Table
CREATE TABLE profile_visits (
    id INT PRIMARY KEY AUTO_INCREMENT,
    visitor_id INT NOT NULL,
    visited_id INT NOT NULL,
    visited_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (visitor_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (visited_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_visits (visited_id, visited_at),
    INDEX idx_visitor (visitor_id, visited_at)
);

-- Bots Table
CREATE TABLE bots (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    bot_name VARCHAR(255) NOT NULL,
    personality_traits JSON,
    activity_schedule JSON,
    is_active BOOLEAN DEFAULT TRUE,
    auto_like_enabled BOOLEAN DEFAULT TRUE,
    auto_message_enabled BOOLEAN DEFAULT TRUE,
    chatgpt_model VARCHAR(50) DEFAULT 'gpt-3.5-turbo',
    conversation_context TEXT,
    daily_activity_limit INT DEFAULT 50,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_bots (is_active)
);

-- Bot Activities Table
CREATE TABLE bot_activities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bot_id INT NOT NULL,
    activity_type ENUM('like', 'message', 'visit', 'post') NOT NULL,
    target_user_id INT,
    activity_data JSON,
    scheduled_at DATETIME NOT NULL,
    executed_at DATETIME NULL,
    status ENUM('pending', 'executed', 'failed') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (bot_id) REFERENCES bots(id) ON DELETE CASCADE,
    FOREIGN KEY (target_user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_bot_schedule (scheduled_at, status),
    INDEX idx_bot_activities (bot_id, activity_type)
);

-- Events Table
CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    event_type ENUM('speed_dating', 'group_activity', 'party', 'workshop') NOT NULL,
    location VARCHAR(255),
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    event_date DATETIME NOT NULL,
    max_participants INT,
    price DECIMAL(10, 2) DEFAULT 0,
    is_premium_only BOOLEAN DEFAULT FALSE,
    created_by INT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_events (event_date, is_active)
);

-- Event Participants Table
CREATE TABLE event_participants (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT NOT NULL,
    user_id INT NOT NULL,
    status ENUM('interested', 'going', 'maybe') DEFAULT 'interested',
    registered_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_participation (event_id, user_id)
);

-- Notifications Table
CREATE TABLE notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type ENUM('match', 'message', 'like', 'visit', 'event') NOT NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT,
    data JSON,
    is_read BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_notifications (user_id, is_read, created_at)
);

-- Premium Subscriptions Table
CREATE TABLE premium_subscriptions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    plan_type ENUM('monthly', 'yearly') NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'USD',
    payment_method VARCHAR(50),
    payment_id VARCHAR(255),
    starts_at DATETIME NOT NULL,
    expires_at DATETIME NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_subscriptions (user_id, is_active)
);

-- Reports Table
CREATE TABLE reports (
    id INT PRIMARY KEY AUTO_INCREMENT,
    reporter_id INT NOT NULL,
    reported_id INT NOT NULL,
    report_type ENUM('inappropriate_content', 'fake_profile', 'harassment', 'spam', 'other') NOT NULL,
    description TEXT,
    status ENUM('pending', 'reviewed', 'resolved') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    reviewed_at DATETIME NULL,
    FOREIGN KEY (reporter_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (reported_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_reports (status, created_at)
);

-- Insert Default Interests
INSERT INTO interests (name, category, icon) VALUES
('Travel', 'lifestyle', '✈️'),
('Photography', 'hobbies', '📸'),
('Cooking', 'hobbies', '🍳'),
('Music', 'entertainment', '🎵'),
('Movies', 'entertainment', '🎬'),
('Fitness', 'lifestyle', '💪'),
('Reading', 'hobbies', '📚'),
('Dancing', 'hobbies', '💃'),
('Hiking', 'sports', '🥾'),
('Yoga', 'lifestyle', '🧘'),
('Gaming', 'hobbies', '🎮'),
('Art', 'creativity', '🎨'),
('Wine', 'lifestyle', '🍷'),
('Coffee', 'lifestyle', '☕'),
('Pets', 'lifestyle', '🐕'),
('Technology', 'interests', '💻'),
('Fashion', 'lifestyle', '👗'),
('Food', 'lifestyle', '🍕'),
('Beach', 'lifestyle', '🏖️'),
('Adventure', 'lifestyle', '🏔️');