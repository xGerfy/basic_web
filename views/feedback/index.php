<?php require BASE_PATH . '/views/layout/header.php'; ?>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Форма обратной связи</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['error'];
                            unset($_SESSION['error']); ?></div>
                    <?php endif; ?>
                    <form action="index.php?action=store" method="POST">
                        <div class="mb-3">
                            <label for="subject" class="form-label">Тема обращения *</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Сообщение *</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Категория</label>
                                <select class="form-select" id="category" name="category">
                                    <option value="support">Техническая поддержка</option>
                                    <option value="sales">Отдел продаж</option>
                                    <option value="billing">Бухгалтерия</option>
                                    <option value="other">Другое</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label d-block">Приоритет</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="priority" id="prio_low"
                                           value="low">
                                    <label class="form-check-label" for="prio_low">Низкий</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="priority" id="prio_med"
                                           value="medium" checked>
                                    <label class="form-check-label" for="prio_med">Средний</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="priority" id="prio_high"
                                           value="high">
                                    <label class="form-check-label" for="prio_high">Высокий</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Темы</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="topics[]" value="bug"
                                       id="topic_bug">
                                <label class="form-check-label" for="topic_bug">Сообщить об ошибке</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="topics[]" value="feature"
                                       id="topic_feature">
                                <label class="form-check-label" for="topic_feature">Предложить идею</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="topics[]" value="question"
                                       id="topic_question">
                                <label class="form-check-label" for="topic_question">Задать вопрос</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-secondary me-md-2">Сбросить</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php require BASE_PATH . '/views/layout/footer.php'; ?>