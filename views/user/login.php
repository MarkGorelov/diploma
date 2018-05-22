<?php include ROOT . '/views/layouts/header_login.php'; ?>

    <main>

        <div class="login-block">
            <img src="/template/img/logo.png" alt="">
            <h1>Авторизация</h1>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="#" method="post">

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ti-email"></i></span>
                        <input class="form-control" type="email" name="email" placeholder="Email"
                               value="<?php echo $email; ?>">
                    </div>
                </div>

                <hr class="hr-xs">

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ti-unlock"></i></span>
                        <input class="form-control" type="password" name="password" placeholder="Пароль"
                               value="<?php echo $password; ?>">
                    </div>
                </div>

                <input class="btn btn-primary btn-block" type="submit" name="submit" value="Вход"/>

            </form>
        </div>

        <div class="login-links">
            <a class="pull-left" href="/user/cabinet/">Забыли пароль?</a>
            <a class="pull-right" href="/user/register/">Регистрация</a>
        </div>

    </main>

<?php include ROOT . '/views/layouts/footer_login.php'; ?>