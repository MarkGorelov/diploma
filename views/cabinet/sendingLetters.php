<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-banner.jpg)">
        <div class="container no-shadow">
            <h2 class="text-center">Хотите предложить пользователям работу?</h2>
            <p class="text-center">Просто напишите им на почту.</p>
        </div>
    </header>

    <main>
        <?php if ($result): ?>
            <p class="lead text-center">Сообщение отправлено!</p>
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
                            <h4>Для отправки сообщения нескольким пользователям напишите их почту через запятую вот так:
                                test@test.test, test@test.test</h4>
                            <form action="#" method="post" class="center-block">
                                <div class="form-group">
                                    <input type="email" name="toUsers" class="form-control input-lg"
                                           placeholder="Кому"
                                           value="<?php echo $toUsers; ?>"/>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="userEmail" class="form-control input-lg"
                                           placeholder="Ваш email"
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