<?php
declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

class AuthController
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function showLogin(): void
    {
        if ($this->userModel->isLoggedIn()) {
            header('Location: index.php?page=feedback');
            exit;
        }
        require BASE_PATH . '/views/auth/login.php';
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $this->userModel->createSession($user);
            header('Location: index.php?page=feedback');
            exit;
        }

        $error = "Неверный email или пароль";
        require BASE_PATH . '/views/auth/login.php';
    }

    #[NoReturn]
    public function logout(): void
    {
        $this->userModel->logout();
        header('Location: index.php?page=login');
        exit;
    }

    public function showRegister(): void
    {
        if ($this->userModel->isLoggedIn()) {
            header('Location: index.php?page=feedback');
            exit;
        }
        require BASE_PATH . '/views/auth/register.php';
    }

    public function register(): void
    {
        if ($this->userModel->isLoggedIn()) {
            header('Location: index.php?page=feedback');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        // Валидация
        $errors = [];

        if (empty($email)) {
            $errors[] = "Введите email";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Некорректный email";
        }

        if (empty($password)) {
            $errors[] = "Введите пароль";
        } elseif (strlen($password) < 6) {
            $errors[] = "Пароль должен быть не менее 6 символов";
        }

        if ($password !== $passwordConfirm) {
            $errors[] = "Пароли не совпадают";
        }

        // Проверяем, есть ли уже такой пользователь
        if (empty($errors)) {
            $existingUser = $this->userModel->findByEmail($email);
            if ($existingUser) {
                $errors[] = "Пользователь с таким email уже существует";
            }
        }

        // Если есть ошибки — показываем форму снова
        if (!empty($errors)) {
            require BASE_PATH . '/views/auth/register.php';
            exit;
        }

        // Создаём пользователя
        $hash = password_hash($password, PASSWORD_DEFAULT);

        if ($this->userModel->create($email, $hash)) {
            // Автоматически входим после регистрации
            $user = $this->userModel->findByEmail($email);
            $this->userModel->createSession($user);
            header('Location: index.php?page=feedback');
            exit;
        }

        $errors[] = "Ошибка при регистрации";
        require BASE_PATH . '/views/auth/register.php';
    }
}