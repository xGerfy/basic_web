CREATE DATABASE IF NOT EXISTS basic_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE basic_web;

CREATE TABLE IF NOT EXISTS users
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    email      VARCHAR(255) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS feedback
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT          NOT NULL,
    subject    VARCHAR(255) NOT NULL,
    message    TEXT         NOT NULL,
    priority   ENUM ('low', 'medium', 'high') DEFAULT 'medium',
    topics     TEXT,
    category   VARCHAR(50),
    created_at TIMESTAMP                      DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);
