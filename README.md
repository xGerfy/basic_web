# Basic Web — PHP приложение с Docker

Веб-приложение на PHP с системой аутентификации и формой обратной связи, развёрнутое в Docker-контейнерах.

## 📋 Возможности

- Регистрация и авторизация пользователей
- Форма отправки обратной связи с полями:
  - Тема сообщения
  - Текст сообщения
  - Приоритет (low/medium/high)
  - Темы (множественный выбор)
  - Категория
- Сессионная аутентификация
- Хранение паролей в хешированном виде (bcrypt)

## 🏗 Архитектура проекта

```
basic_web/
├── config/          # Конфигурация (подключение к БД)
├── controllers/     # Контроллеры (AuthController, FeedbackController)
├── models/          # Модели (User, Feedback)
├── views/           # Представления (auth, feedback, layout)
├── public/          # Точка входа (index.php)
├── sql/             # SQL-скрипты (schema.sql)
├── nginx/           # Конфигурация nginx
├── docker-compose.yaml
├── Dockerfile
└── .env             # Переменные окружения
```

## 🚀 Быстрый старт

### Требования

- Docker и Docker Compose

### Установка

1. Клонируйте репозиторий
2. Проверьте файл `.env` (при необходимости измените пароли)
3. Запустите контейнеры:

```bash
docker-compose up -d --build
```

4. Откройте в браузере: **http://localhost**

### Тестовые учётные данные

После развёртывания создаётся тестовый пользователь:

- **Email:** `admin@test.com`
- **Пароль:** `password`

## 🛠 Технологический стек

- **PHP 8.5** (FPM)
- **Nginx** (веб-сервер)
- **MySQL 9.6** (СУБД)
- **PDO** (работа с БД)
- **Docker & Docker Compose**

## 📊 Структура базы данных

### Таблица `users`
| Поле | Тип | Описание |
|------|-----|----------|
| id | INT | ID пользователя |
| email | VARCHAR(255) | Email (уникальный) |
| password | VARCHAR(255) | Хеш пароля |
| created_at | TIMESTAMP | Дата создания |

### Таблица `feedback`
| Поле | Тип | Описание |
|------|-----|----------|
| id | INT | ID записи |
| user_id | INT | Ссылка на пользователя |
| subject | VARCHAR(255) | Тема |
| message | TEXT | Сообщение |
| priority | ENUM | Приоритет (low/medium/high) |
| topics | TEXT | Темы (JSON) |
| category | VARCHAR(50) | Категория |
| created_at | TIMESTAMP | Дата создания |

## 🔧 Конфигурация

Переменные окружения (файл `.env`):

```env
DB_ROOT_PASSWORD=rootpassword
DB_DATABASE=basic_web
DB_USER=user
DB_PASSWORD=password
```

## 📝 Маршруты

| URL | Описание |
|-----|----------|
| `?page=login` | Страница входа |
| `?page=register` | Страница регистрации |
| `?page=feedback` | Форма обратной связи (требует авторизации) |
| `?action=login` | Обработка входа (POST) |
| `?action=register` | Обработка регистрации (POST) |
| `?action=logout` | Выход из системы |
| `?action=store` | Отправка формы обратной связи (POST) |

## 🧹 Остановка

```bash
docker-compose down
```

Для удаления данных БД:

```bash
docker-compose down -v
```

## 📄 Лицензия

MIT
