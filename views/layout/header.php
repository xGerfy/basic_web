<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php?page=feedback">Basic web</a>
        <div class="d-flex">
            <?php if (isset($_SESSION['user_email'])): ?>
                <span class="navbar-text text-white me-3">
                    Привет, <?= htmlspecialchars($_SESSION['user_email']) ?>
                </span>
                <a href="index.php?action=logout" class="btn btn-outline-light btn-md">Выход</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">