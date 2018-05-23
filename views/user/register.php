<?php include ROOT . '/views/layouts/header_register.php'; ?>

    <main>

        <div class="login-block">
            <img src="/template/img/logo.png" alt="">
            <h1>Регистрация аккаунта</h1>

            <?php if ($result): ?>
                <h1>Вы зарегистрированы!</h1>
                <a href="/">Перейти на сайт</a>
            <?php else: ?>

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
                            <span class="input-group-addon"><i class="ti-user"></i></span>
                            <input type="text" class="form-control" name="name" placeholder="Введите ваше имя">
                        </div>
                    </div>

                    <hr class="hr-xs">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="ti-email"></i></span>
                            <input type="text" class="form-control" name="email" placeholder="Введите email">
                        </div>
                    </div>

                    <hr class="hr-xs">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="ti-unlock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Введите пароль">
                        </div>
                    </div>

                    <hr class="hr-xs">
                    <br>
                    <select class="form-control selectpicker" name="role">
                        <option value="aspirant" selected="selected">Ищу работу</option>
                        <option value="employer">Ищу работников</option>
                    </select>

                    <input class="btn btn-primary btn-block" type="submit" name="submit" value="Регистрация"/>

                </form>
            <?php endif; ?>
        </div>

        <div class="login-links">
            <p class="text-center">Уже имеете аккаунт? <a class="txt-brand" href="/user/login/">Войти</a></p>
        </div>

    </main>

<?php include ROOT . '/views/layouts/footer_register.php'; ?>