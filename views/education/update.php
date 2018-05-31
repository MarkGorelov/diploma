<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <form action="#" method="post" enctype="multipart/form-data">
        <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner.jpg);">
            <div class="container page-name">
                <h1 class="text-center">Обновите информацию об образовании</h1>
                <p class="lead text-center">Обновите информацию об образовании для своего резюме</p>
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
                    <div class="col-xs-12 col-sm-4 col-lg-2">
                        <div class="form-group">
                            <input type="file" name="img" class="dropify"
                                   value="<?php echo $education['img']; ?>">
                            <span class="help-block">Вы можете изменить изображение учебного заведения</span>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-lg-10">
                        <p class="help-block">Выберите резюме</p>
                        <select name="resume_id" class="form-control selectpicker">
                            <?php if (is_array($resumesList)): ?>
                                <?php foreach ($resumesList as $resume): ?>
                                    <option value="<?php echo $resume['id']; ?>">
                                        <?php echo $resume['headline']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group col-xs-12 col-lg-10">
                        <input type="text" name="degree" class="form-control input-lg"
                               placeholder="Академическая степень" value="<?php echo $education['degree']; ?>">
                    </div>

                    <div class="form-group col-xs-12 col-lg-10">
                        <input type="text" name="branch" class="form-control input-lg" placeholder="Отделение"
                               value="<?php echo $education['branch']; ?>">
                    </div>

                    <div class="form-group col-xs-12 col-lg-10">
                        <input type="text" name="school_name" class="form-control input-lg"
                               placeholder="Название учебного учреждения"
                               value="<?php echo $education['school_name']; ?>">
                    </div>

                    <div class="form-group col-xs-12">
                        <input type="text" name="date_of_education" class="form-control input-lg"
                               placeholder="Дата начала и окончания обучения"
                               value="<?php echo $education['date_of_education']; ?>">
                    </div>

                    <div class="form-group col-xs-12">
                        <textarea class="form-control" name="short_description" rows="3"
                                  placeholder="Краткое описание"><?php echo $education['short_description']; ?></textarea>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="bg-white">
                <div class="container">
                    <header class="section-header">
                        <span>Вы закончили?</span>
                        <h2>Обновить информацию об образование для резюме</h2>
                        <p>Пожалуйста, просмотрите всю указанную информацию еще раз и нажмите на кнопку ниже, чтобы
                            добавить образование для резюме</p>
                    </header>

                    <p class="text-center">
                        <input type="hidden" name="status" class="btn btn-success btn-xl btn-round"
                               value="1">
                        <input type="hidden" name="user_id" class="btn btn-success btn-xl btn-round"
                               value=<?php echo $_SESSION['user']; ?>>
                        <input type="submit" name="submit" class="btn btn-success btn-xl btn-round"
                               value="Обновить">
                    </p>

                </div>
            </section>
        </main>
    </form>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>