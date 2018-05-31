<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/user">Управление пользователями</a></li>
                        <li class="active">Добавить пользователя</li>
                    </ol>
                </div>


                <h4>Добавить нового пользователя</h4>

                <br/>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post">

                            <p>Имя</p>
                            <input type="text" name="name" placeholder="Имя пользователя" value="">

                            <p>Email</p>
                            <input type="text" name="email" placeholder="Email" value="">

                            <p>Пароль</p>
                            <input type="password" name="password" placeholder="Пароль" value="">

                            <p>Тип пользователя</p>
                            <select name="role">
                                <option value="admin" selected="selected">Администратор</option>
                                <option value="aspirant">Соискатель</option>
                                <option value="employer">Работодатель</option>
                            </select>

                            <br><br>

                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>