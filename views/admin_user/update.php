<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/user">Управление пользователями</a></li>
                    <li class="active">Редактировать данные пользователя</li>
                </ol>
            </div>


            <h4>Редактировать данные пользователя #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Имя</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $user['name']; ?>">

                        <p>Email</p>
                        <input type="email" name="email" placeholder="" value="<?php echo $user['email']; ?>">

                        <p>Пароль</p>
                        <input type="password" name="password" placeholder="" value="<?php echo $user['password']; ?>">

                        <br/><br/>

                        <p>Аватар пользователя</p>
                        <img src="<?php echo User::getImage($user['id']); ?>" width="200" alt="" />
                        <input type="file" name="img" placeholder="" value="<?php echo $user['img']; ?>">

                        <p>Тип пользователя</p>
                        <select name="role">
                            <option value="<?php echo $user['role']; ?>">Администратор</option>
                            <option value="<?php echo $user['role']; ?>">Соискатель</option>
                            <option value="<?php echo $user['role']; ?>">Работодатель</option>
                        </select>

                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

