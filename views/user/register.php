<?php include ROOT . '/views/layouts/header_register.php'; ?>

    <main>

        <div class="login-block">
            <img src="/template/img/logo.png" alt="">
            <h1>Регистрация аккаунта</h1>

            <?php if ($result): ?>
                <h1>Вы зарегистрированы!</h1>
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
                            <input type="text" class="form-control" name="name" placeholder="Введите логин">
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

                    <input class="btn btn-primary btn-block" type="submit" name="submit" value="Регистрация"/>

                    <div class="login-footer">
                        <h6>зарегистрироваться через</h6>
                        <ul class="social-icons">
                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>

                </form>
            <?php endif; ?>
        </div>

        <div class="login-links">
            <p class="text-center">Уже имеете аккаунт? <a class="txt-brand" href="/user/login/">Войти</a></p>
        </div>

    </main>

<?php include ROOT . '/views/layouts/footer_register.php'; ?>