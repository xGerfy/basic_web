<?php
declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require BASE_PATH . '/config/db.php';

if (!isset($pdo)) {
    throw new Exception('Database connection failed: $pdo is not defined');
}

require BASE_PATH . '/models/User.php';
require BASE_PATH . '/models/Feedback.php';
require BASE_PATH . '/controllers/AuthController.php';
require BASE_PATH . '/controllers/FeedbackController.php';

$userModel = new User($pdo);
$feedbackModel = new Feedback($pdo);
$authController = new AuthController($userModel);
$feedbackController = new FeedbackController($userModel, $feedbackModel);

$action = $_GET['action'] ?? '';
$page = $_GET['page'] ?? 'login';

try {
    if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $authController->login();
    } elseif ($action === 'login') {
        $authController->showLogin();
    } elseif ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $authController->register();
    } elseif ($action === 'register') {
        $authController->showRegister();
    } elseif ($action === 'logout') {
        $authController->logout();
    } elseif ($action === 'store') {
        $feedbackController->store();
    } elseif ($page === 'feedback') {
        $feedbackController->index();
    } else {
        $authController->showLogin();
    }
} catch (Exception $e) {
    echo "<h1>Ошибка: " . htmlspecialchars($e->getMessage()) . "</h1>";
}