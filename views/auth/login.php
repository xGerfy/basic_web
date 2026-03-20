<?php require BASE_PATH . '/views/layout/header.php'; ?>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Вход в систему</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form action="index.php?action=login" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email адрес</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                   placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Войти</button>
                    </form>
                    <div class="mt-3 text-center">
                        <span class="text-muted">Нет аккаунта?</span>
                        <a href="index.php?action=register">Зарегистрироваться</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require BASE_PATH . '/views/layout/footer.php'; ?>