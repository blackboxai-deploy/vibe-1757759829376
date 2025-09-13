<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'dating_network');
define('DB_USER', 'root');
define('DB_PASS', '');

// Site Configuration
define('SITE_NAME', 'LoveConnect');
define('SITE_URL', 'http://localhost:3000');
define('UPLOAD_PATH', 'assets/uploads/');

// API Keys
define('CHATGPT_API_KEY', 'your_openai_api_key_here');

// Session Configuration
session_start();

// Database Connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // For development - in production, log this error properly
    die("Database connection failed: " . $e->getMessage());
}

// Security Functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// User Authentication Functions
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function get_current_user() {
    global $pdo;
    if (!is_logged_in()) return null;
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}

function login_user($user_id) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['login_time'] = time();
}

function logout_user() {
    session_destroy();
}

// Utility Functions
function upload_image($file, $directory = 'profiles') {
    $upload_dir = UPLOAD_PATH . $directory . '/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    if (!in_array($file_extension, $allowed_extensions)) {
        return ['error' => 'Invalid file type'];
    }
    
    $file_name = uniqid() . '.' . $file_extension;
    $file_path = $upload_dir . $file_name;
    
    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        return ['success' => true, 'filename' => $file_name, 'path' => $file_path];
    }
    
    return ['error' => 'File upload failed'];
}

function calculate_age($birthdate) {
    $birth = new DateTime($birthdate);
    $today = new DateTime('today');
    return $birth->diff($today)->y;
}

function calculate_distance($lat1, $lon1, $lat2, $lon2) {
    $earth_radius = 6371; // km
    
    $lat_diff = deg2rad($lat2 - $lat1);
    $lon_diff = deg2rad($lon2 - $lon1);
    
    $a = sin($lat_diff/2) * sin($lat_diff/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($lon_diff/2) * sin($lon_diff/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    
    return round($earth_radius * $c, 1);
}

function format_time_ago($timestamp) {
    $time_ago = time() - strtotime($timestamp);
    
    if ($time_ago < 60) return 'just now';
    if ($time_ago < 3600) return floor($time_ago / 60) . 'm ago';
    if ($time_ago < 86400) return floor($time_ago / 3600) . 'h ago';
    if ($time_ago < 2592000) return floor($time_ago / 86400) . 'd ago';
    
    return date('M j, Y', strtotime($timestamp));
}

// JSON Response Helper
function json_response($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Error Handler for Production
function handle_error($message, $code = 500) {
    error_log($message);
    json_response(['error' => 'An error occurred'], $code);
}

// CORS Headers for AJAX
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
?>