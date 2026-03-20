<?php
declare(strict_types=1);

class Feedback
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(int $userId, array $data): bool
    {
        $sql = "INSERT INTO feedback (user_id, subject, message, priority, topics, category) 
                VALUES (:user_id, :subject, :message, :priority, :topics, :category)";

        $stmt = $this->pdo->prepare($sql);
        $topicsJson = json_encode($data['topics'] ?? []);

        return $stmt->execute([
            ':user_id' => $userId,
            ':subject' => htmlspecialchars($data['subject']),
            ':message' => htmlspecialchars($data['message']),
            ':priority' => $data['priority'],
            ':topics' => $topicsJson,
            ':category' => $data['category']
        ]);
    }
}