<?php
declare(strict_types=1);

class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public function create(string $email, string $passwordHash): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        return $stmt->execute([$email, $passwordHash]);
    }

    public function createSession(array $user): void
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
    }
}