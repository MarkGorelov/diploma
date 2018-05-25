<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <form action="#" method="post" enctype="multipart/form-data">
        <!-- Page header -->
        <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner.jpg);">
            <div class="container page-name">
                <h1 class="text-center">Обновите свое резюме</h1>
            </div>

            <div class="container">

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            <input type="file" name="img" class="dropify" src="<?php echo Resume::getImage($resume['id']); ?>"
                                   value="<?php echo $resume['img']; ?>" >
                            <span class="help-block">Пожалуйста выберите фотографию 4:6</span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-8">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control input-lg"
                                   placeholder="Введите имя, фамилию" value="<?php echo $resume['name']; ?>">
                        </div>

                        <div class="form-group">
                            <input type="text" name="headline" class="form-control" placeholder="Желаемую должность"
                                   value="<?php echo $resume['headline']; ?>">
                        </div>

                        <div class="form-group">
                            <select name="category_id" class="form-control selectpicker">
                                <?php if (is_array($categoriesList)): ?>
                                    <?php foreach ($categoriesList as $category): ?>
                                        <option value="<?php echo $category['id']; ?>">
                                            <?php echo $category['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="short_description"
                                      placeholder="Расскажите о себе"><?php echo $resume['short_description']; ?></textarea>
                        </div>

                        <hr class="hr-lg">

                        <h6>Основная информация</h6>
                        <div class="row">

                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" name="location" class="form-control"
                                           placeholder="Местоположение" value="<?php echo $resume['location']; ?>">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                    <input type="text" name="website_address" class="form-control"
                                           placeholder="Ваш личный сайт"
                                           value="<?php echo $resume['website_address']; ?>">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                    <input type="text" name="salary" class="form-control"
                                           placeholder="Желаемый заработок" value="<?php echo $resume['salary']; ?>">
                                    <span class="input-group-addon">В месяц</span>
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                                    <input type="text" name="age" class="form-control" placeholder="Ваш возраст"
                                           value="<?php echo $resume['age']; ?>">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" name="phone_number" class="form-control"
                                           placeholder="Номер телефона" value="<?php echo $resume['phone_number']; ?>">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="text" name="email_address" class="form-control"
                                           placeholder="Адрес электронной почти" value="<?php echo $resume['email_address']; ?>">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
                                    <select class="form-control selectpicker" name="gender">
                                        <option selected>Мужчина</option>
                                        <option>Женщина</option>
                                    </select>
                                    <span class="input-group-addon">Ваш пол</span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </header>
        <!-- END Page header -->

        <!-- Submit -->
        <section class="bg-white">
            <div class="container">
                <header class="section-header">
                    <span>Вы закончили?</span>
                    <h2>Создайте резюме</h2>
                    <p>Пожалуйста, просмотрите всю указанную информацию еще раз и нажмите на кнопку ниже, чтобы
                        создать резюме</p>
                </header>

                <p class="text-center">
                    <input type="hidden" name="status" class="btn btn-success btn-xl btn-round"
                           value="1">
                    <input type="hidden" name="user_id" class="btn btn-success btn-xl btn-round"
                           value=<?php echo $_SESSION['user']; ?>>
                    <input type="submit" name="submit" class="btn btn-success btn-xl btn-round"
                           value="Обновить резюме">
                </p>

            </div>
        </section>
    </form>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>