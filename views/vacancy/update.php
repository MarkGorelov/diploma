<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <form action="#" method="post" enctype="multipart/form-data">
        <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner.jpg);">
            <div class="container page-name">
                <h1 class="text-center">Редактирование вакансии № <?php echo $id ?></h1>
                <p class="lead text-center">Здесь вы можете изменить данные о вакансии</p>
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
                                   value="<?php echo $vacancy['img']; ?>">
                            <span class="help-block">Добавьте логотип компании для вакансии</span>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-lg-10">
                        <input type="text" name="company_name" class="form-control input-lg"
                               placeholder="Название компании" value="<?php echo $vacancy['company_name']; ?>">
                    </div>

                    <div class="form-group col-xs-12 col-lg-10">
                        <input type="text" name="job_title" class="form-control input-lg" placeholder="Должность"
                               value="<?php echo $vacancy['job_title']; ?>">
                    </div>

                    <div class="form-group col-xs-12 col-lg-10">
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

                    <div class="form-group col-xs-12 col-lg-10">
                        <select name="company_id" class="form-control selectpicker">
                            <?php if (is_array($companiesList)): ?>
                                <?php foreach ($companiesList as $company): ?>
                                    <option value="<?php echo $company['id']; ?>">
                                        <?php echo $company['company_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>


                    <div class="form-group col-xs-12">
                        <textarea class="form-control" name="short_description" rows="3"
                                  placeholder="Краткое описание"><?php echo $vacancy['short_description']; ?></textarea>
                    </div>

                    <div class="form-group col-xs-12">
                        <input type="text" name="website_address" class="form-control" placeholder="Ссылка на сайта"
                               value="<?php echo $vacancy['website_address']; ?>">
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" name="location" class="form-control" placeholder="Местоположение"
                                   value="<?php echo $vacancy['location']; ?>">
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                            <select class="form-control selectpicker" name="type_of_employment">
                                <option>На постоянной основе</option>
                                <option>Неполная занятость</option>
                                <option>Стажировка</option>
                                <option>Без договора</option>
                                <option>Удаленно</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" name="salary" class="form-control" placeholder="Зарплата"
                                   value="<?php echo $vacancy['salary']; ?>">
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                            <input type="text" name="working" class="form-control" placeholder="График работы"
                                   value="<?php echo $vacancy['working']; ?>">
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="fa fa-flask"></i></span>
                            <input type="text" name="experince" class="form-control"
                                   placeholder="Опыт работы, например 5 лет"
                                   value="<?php echo $vacancy['experince']; ?>">
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-sm-6 col-md-4">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
                            <select class="form-control selectpicker" name="gender">
                                <option selected>Мужчина</option>
                                <option>Женщина</option>
                                <option>Не важно</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <main>
            <section>
                <div class="container">

                    <header class="section-header">
                        <span>Описание</span>
                        <h2>Детали работы</h2>
                        <p>Напишите о своей компании, описание работы, требуемых навыках, преимуществах и т.д.</p>
                    </header>

                    <textarea class="summernote-editor"
                              name="job_detail"><?php echo $vacancy['job_detail']; ?></textarea>

                </div>
            </section>

            <section class="bg-alt">
                <div class="container">
                    <header class="section-header">
                        <span>Вы закончили?</span>
                        <h2>Обновите вакансию</h2>
                        <p>Пожалуйста, просмотрите всю указанную информацию еще раз и нажмите на кнопку ниже, чтобы
                            создать вакансию</p>
                    </header>

                    <p class="text-center">
                        <input type="hidden" name="status" class="btn btn-success btn-xl btn-round"
                               value="1">
                        <input type="hidden" name="user_id" class="btn btn-success btn-xl btn-round"
                               value=<?php echo $_SESSION['user']; ?>>
                        <input type="submit" name="submit" class="btn btn-success btn-xl btn-round"
                               value="Обновить данные">
                    </p>
                </div>
            </section>
        </main>
    </form>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>