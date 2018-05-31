<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <form action="#" method="post" enctype="multipart/form-data">
        <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner.jpg);">
            <div class="container page-name">
                <h1 class="text-center">Добавте опыт работы для резюме</h1>
                <p class="lead text-center">Добавте опыт работы для резюме и разместите её на сайте</p>
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
                                   value="<?php echo $workExperience['img']; ?>">
                            <span class="help-block">Добавьте изображение бывшего места работы</span>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-lg-10">
                        <p class="help-block">Выберите резюме для которого будем добавлять информацию об опыте работы</p>
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
                        <input type="text" name="company_name" class="form-control input-lg"
                               placeholder="Название компании в которой работали">
                    </div>

                    <div class="form-group col-xs-12 col-lg-10">
                        <input type="text" name="position" class="form-control input-lg" placeholder="Какую должность в этой компании вы занимали">
                    </div>

                    <div class="form-group col-xs-12 col-lg-10">
                        <input type="text" name="date_of_experience" class="form-control input-lg" placeholder="Дата начала и окончания работы">
                    </div>

                    <div class="form-group col-xs-12">
                        <textarea class="form-control" name="short_description" rows="3"
                                  placeholder="Краткое описание того, чем вы занимались и почему перестали работать в данной компании"></textarea>
                    </div>

                </div>
            </div>
        </header>

        <main>
            <section class="bg-white">
                <div class="container">
                    <header class="section-header">
                        <span>Вы закончили?</span>
                        <h2>Добавте опыт работы для резюме</h2>
                        <p>Пожалуйста, просмотрите всю указанную информацию еще раз и нажмите на кнопку ниже, чтобы
                            добавить опыт работы для резюме</p>
                    </header>

                    <p class="text-center">
                        <input type="hidden" name="status" class="btn btn-success btn-xl btn-round"
                               value="1">
                        <input type="hidden" name="user_id" class="btn btn-success btn-xl btn-round"
                               value=<?php echo $_SESSION['user']; ?>>
                        <input type="submit" name="submit" class="btn btn-success btn-xl btn-round"
                               value="Добавить">
                    </p>

                </div>
            </section>
        </main>
    </form>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>