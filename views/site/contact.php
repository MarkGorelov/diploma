<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-banner.jpg)">
        <div class="container no-shadow">
            <h1 class="text-center">Контактная информация</h1>
        </div>
    </header>

    <main>
        <?php if ($result): ?>
            <p class="lead text-center">Сообщение отправлено! Мы ответим Вам на указанный email.</p>
        <?php else: ?>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <h4>Есть вопрос? Напишите нам</h4>
                            <form action="#" method="post" class="center-block">
                                <div class="form-group">
                                    <input type="text" name="userEmail" class="form-control input-lg"
                                           placeholder="Email"
                                           value="<?php echo $userEmail; ?>"/>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="userText" class="form-control" placeholder="Сообщение"
                                           value="<?php echo $userText; ?>"/>
                                </div>

                                <input type="submit" name="submit" class="btn btn-primary" value="Отправить"/>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>
    </main>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>