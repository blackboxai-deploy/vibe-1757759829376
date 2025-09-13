<?php
require_once '../includes/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['error' => 'Method not allowed'], 405);
}

// Verify CSRF token
if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
    json_response(['error' => 'Invalid CSRF token'], 403);
}

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'login':
        handleLogin();
        break;
    case 'register':
        handleRegister();
        break;
    case 'logout':
        handleLogout();
        break;
    case 'verify_email':
        handleEmailVerification();
        break;
    default:
        json_response(['error' => 'Invalid action'], 400);
}

function handleLogin() {
    global $pdo;
    
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember_me']);
    
    // Validation
    if (empty($email) || empty($password)) {
        json_response(['error' => 'Email and password are required'], 400);
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        json_response(['error' => 'Invalid email format'], 400);
    }
    
    try {
        // Find user
        $stmt = $pdo->prepare("SELECT id, email, password_hash, first_name, is_active FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if (!$user || !password_verify($password, $user['password_hash'])) {
            // Log failed login attempt
            error_log("Failed login attempt for email: $email from IP: " . $_SERVER['REMOTE_ADDR']);
            json_response(['error' => 'Invalid email or password'], 401);
        }
        
        if (!$user['is_active']) {
            json_response(['error' => 'Account is deactivated. Please contact support.'], 403);
        }
        
        // Update last seen
        $stmt = $pdo->prepare("UPDATE users SET last_seen = NOW() WHERE id = ?");
        $stmt->execute([$user['id']]);
        
        // Create session
        login_user($user['id']);
        
        // Set remember me cookie if requested
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', true, true); // 30 days
            
            // Store token in database (would need remember_tokens table)
            // For demo, we'll skip this implementation
        }
        
        json_response([
            'success' => true,
            'message' => 'Welcome back, ' . $user['first_name'] . '! 💕',
            'redirect' => 'dashboard.php'
        ]);
        
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        json_response(['error' => 'Login failed. Please try again.'], 500);
    }
}

function handleRegister() {
    global $pdo;
    
    // Get form data
    $first_name = sanitize_input($_POST['first_name'] ?? '');
    $last_name = sanitize_input($_POST['last_name'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $interested_in = $_POST['interested_in'] ?? '';
    $location = sanitize_input($_POST['location'] ?? '');
    $bio = sanitize_input($_POST['bio'] ?? '');
    $agree_terms = isset($_POST['agree_terms']);
    $marketing_consent = isset($_POST['marketing_consent']);
    
    // Validation
    $errors = [];
    
    if (empty($first_name)) $errors[] = 'First name is required';
    if (empty($last_name)) $errors[] = 'Last name is required';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
    if (empty($password) || strlen($password) < 8) $errors[] = 'Password must be at least 8 characters';
    if (empty($birthdate)) $errors[] = 'Date of birth is required';
    if (!in_array($gender, ['male', 'female', 'other'])) $errors[] = 'Please select your gender';
    if (!in_array($interested_in, ['male', 'female', 'both'])) $errors[] = 'Please select your interest';
    if (empty($location)) $errors[] = 'Location is required';
    if (!$agree_terms) $errors[] = 'You must agree to terms and conditions';
    
    // Age validation
    $birth = new DateTime($birthdate);
    $today = new DateTime();
    $age = $birth->diff($today)->y;
    if ($age < 18) $errors[] = 'You must be at least 18 years old';
    
    if (!empty($errors)) {
        json_response(['error' => implode(', ', $errors)], 400);
    }
    
    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            json_response(['error' => 'Email already registered. Please use a different email or try logging in.'], 409);
        }
        
        // Password strength validation
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/', $password)) {
            json_response(['error' => 'Password must contain at least one lowercase letter, one uppercase letter, and one number'], 400);
        }
        
        // Start transaction
        $pdo->beginTransaction();
        
        // Hash password
        $password_hash = password_hash($password, PASSWORD_ARGON2ID);
        
        // Insert user
        $stmt = $pdo->prepare("
            INSERT INTO users (
                email, password_hash, first_name, last_name, birthdate, 
                gender, interested_in, location_city, is_active, created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, NOW())
        ");
        
        $stmt->execute([
            $email, $password_hash, $first_name, $last_name, $birthdate,
            $gender, $interested_in, $location
        ]);
        
        $user_id = $pdo->lastInsertId();
        
        // Insert user profile
        $stmt = $pdo->prepare("
            INSERT INTO user_profiles (user_id, bio, created_at) 
            VALUES (?, ?, NOW())
        ");
        $stmt->execute([$user_id, $bio]);
        
        // Handle photo uploads (simplified for demo)
        if (!empty($_FILES['photos']['name'][0])) {
            foreach ($_FILES['photos']['name'] as $key => $filename) {
                if (!empty($filename)) {
                    $photo_result = upload_image([
                        'name' => $_FILES['photos']['name'][$key],
                        'tmp_name' => $_FILES['photos']['tmp_name'][$key],
                        'error' => $_FILES['photos']['error'][$key],
                        'size' => $_FILES['photos']['size'][$key]
                    ], 'profiles');
                    
                    if (isset($photo_result['success'])) {
                        $is_primary = ($key == 0) ? 1 : 0;
                        $stmt = $pdo->prepare("
                            INSERT INTO user_photos (user_id, photo_url, is_primary, order_position, created_at) 
                            VALUES (?, ?, ?, ?, NOW())
                        ");
                        $stmt->execute([$user_id, $photo_result['filename'], $is_primary, $key]);
                        
                        // Update main profile photo
                        if ($is_primary) {
                            $stmt = $pdo->prepare("UPDATE users SET profile_photo = ? WHERE id = ?");
                            $stmt->execute([$photo_result['filename'], $user_id]);
                        }
                    }
                }
            }
        }
        
        // Commit transaction
        $pdo->commit();
        
        // Send welcome email (would be implemented with actual email service)
        // sendWelcomeEmail($email, $first_name);
        
        // Log successful registration
        error_log("New user registered: $email (ID: $user_id)");
        
        // Auto-login the user
        login_user($user_id);
        
        json_response([
            'success' => true,
            'message' => 'Welcome to LoveConnect, ' . $first_name . '! Your account has been created successfully. 💕',
            'redirect' => 'profile-setup.php' // Redirect to complete profile setup
        ]);
        
    } catch (Exception $e) {
        $pdo->rollback();
        error_log("Registration error: " . $e->getMessage());
        json_response(['error' => 'Registration failed. Please try again.'], 500);
    }
}

function handleLogout() {
    // Clear remember me cookie
    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, '/', '', true, true);
    }
    
    logout_user();
    
    if (isset($_GET['redirect'])) {
        header('Location: ' . $_GET['redirect']);
    } else {
        header('Location: ../index.php');
    }
    exit;
}

function handleEmailVerification() {
    global $pdo;
    
    $token = $_POST['token'] ?? '';
    
    if (empty($token)) {
        json_response(['error' => 'Verification token is required'], 400);
    }
    
    try {
        // In a real implementation, we'd have an email_verifications table
        // For demo purposes, we'll simulate email verification
        
        $stmt = $pdo->prepare("UPDATE users SET is_verified = 1 WHERE id = ?");
        $stmt->execute([get_current_user()['id']]);
        
        json_response([
            'success' => true,
            'message' => 'Email verified successfully! 🎉'
        ]);
        
    } catch (Exception $e) {
        error_log("Email verification error: " . $e->getMessage());
        json_response(['error' => 'Verification failed'], 500);
    }
}

// Helper functions
function sendWelcomeEmail($email, $name) {
    // Implementation would use email service like SendGrid, Mailgun, etc.
    // For demo, we'll just log it
    error_log("Welcome email sent to: $email");
}
?>