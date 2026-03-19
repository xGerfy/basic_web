CREATE
DATABASE IF NOT EXIST basic_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE
basic_web;

CREATE TABLE users
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    email      varchar(255) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE feedback
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT          NOT NULL,
    subject    VARCHAR(255) NOT NULL,
    message    TEXT         NOT NULL,
    priority   ENUM('low', 'medium', 'high') DEFAULT 'medium',
    topics     TEXT,
    category   VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);