<?php require BASE_PATH . '/views/layout/header.php'; ?>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Регистрация</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form action="index.php?action=register" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email адрес *</label>
                            <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    required
                                    placeholder="name@example.com"
                                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль *</label>
                            <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    required
                                    minlength="6"
                            >
                            <div class="form-text">Минимум 6 символов</div>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Подтверждение пароля *</label>
                            <input
                                    type="password"
                                    class="form-control"
                                    id="password_confirm"
                                    name="password_confirm"
                                    required
                            >
                        </div>
                        <button type="submit" class="btn btn-success w-100">Зарегистрироваться</button>
                    </form>
                    <div class="mt-3 text-center">
                        <span class="text-muted">Уже есть аккаунт?</span>
                        <a href="index.php?action=login">Войти</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require BASE_PATH . '/views/layout/footer.php'; ?>