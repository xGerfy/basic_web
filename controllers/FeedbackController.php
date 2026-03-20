<?php
declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

class FeedbackController
{
    private User $userModel;
    private Feedback $feedbackModel;

    public function __construct(User $userModel, Feedback $feedbackModel)
    {
        $this->userModel = $userModel;
        $this->feedbackModel = $feedbackModel;
    }

    public function index(): void
    {
        if (!$this->userModel->isLoggedIn()) {
            header('Location: index.php?page=login');
            exit;
        }

        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['success']);

        require BASE_PATH . '/views/feedback/index.php';
    }

    #[NoReturn]
    public function store(): void
    {
        if (!$this->userModel->isLoggedIn()) {
            header('Location: index.php?page=login');
            exit;
        }

        if (empty($_POST['subject']) || empty($_POST['message'])) {
            $_SESSION['error'] = "Заполните обязательные поля";
            header('Location: index.php?page=feedback');
            exit;
        }

        $data = [
            'subject' => $_POST['subject'],
            'message' => $_POST['message'],
            'priority' => $_POST['priority'] ?? 'medium',
            'topics' => $_POST['topics'] ?? [],
            'category' => $_POST['category'] ?? 'general'
        ];

        $userId = $_SESSION['user_id'];

        if ($this->feedbackModel->create($userId, $data)) {
            $_SESSION['success'] = "Сообщение успешно отправлено!";
        } else {
            $_SESSION['error'] = "Ошибка при отправке";
        }

        header('Location: index.php?page=feedback');
        exit;
    }
}