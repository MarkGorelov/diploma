<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <form action="#" method="post" enctype="multipart/form-data">

        <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner.jpg);">
            <div class="container page-name">
                <h1 class="text-center">Редактирование компании № <?php echo $id ?></h1>
                <p class="lead text-center">Здесь вы можете изменить данные о компании</p>
            </div>

            <div class="container">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <?php if (isset($errors) && is_array($errors)): ?>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li> - <?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <div class="col-xs-12 col-sm-4 col-lg-2">
                                <div class="form-group">
                                    <input type="file" name="img" class="dropify"
                                           value="<?php echo $company['img']; ?>">
                                    <span class="help-block">Добавьте логотип компании</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-8 col-lg-10">

                                <div class="form-group">
                                    <input type="text" name="company_name" class="form-control input-lg"
                                           placeholder="Название компании"
                                           value="<?php echo $company['company_name']; ?>">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="headline" class="form-control"
                                           placeholder="Вид деятельности"
                                           value="<?php echo $company['headline']; ?>">
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

                                <input type="hidden" name="status" class="btn btn-success btn-xl btn-round"
                                       value="1">

                                <div class="form-group">
                                    <textarea class="form-control" name="short_description" rows="3"
                                              placeholder="Краткое описание"><?php echo $company['short_description']; ?></textarea>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="row">

                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" name="location" class="form-control"
                                           placeholder="Местоположение"
                                           value="<?php echo $company['location']; ?>">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                    <select class="form-control selectpicker" name="employees">
                                        <option>0 - 9</option>
                                        <option selected>10 - 99</option>
                                        <option>100 - 999</option>
                                        <option>1,000 - 9,999</option>
                                        <option>10,000 - 99,999</option>
                                        <option>100,000 - 999,999</option>
                                    </select>
                                    <span class="input-group-addon">Работников</span>
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                    <input type="text" name="website_address" class="form-control"
                                           placeholder="Сайт компании"
                                           value="<?php echo $company['website_address']; ?>">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                                    <input type="text" name="founded" class="form-control" placeholder="Дата основания"
                                           value="<?php echo $company['founded']; ?>">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" name="phone_number" class="form-control "
                                           placeholder="Номер телефона"
                                           value="<?php echo $company['phone_number']; ?>">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="text" name="email_address" class="form-control"
                                           placeholder="Email компании"
                                           value="<?php echo $company['email_address']; ?>">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </header>

        <main>
            <section class=" bg-alt">
                <div class="container">
                    <header class="section-header">
                        <h2>О компании</h2>
                        <p>Напишите о своей компании, культуре, коллективе, преимуществах работы в компании и т.д.</p>
                    </header>

                    <textarea class="summernote-editor"
                              name="company_detail"><?php echo $company['company_detail']; ?></textarea>
                </div>
            </section>

            <section>
                <div class="container">
                    <header class="section-header">
                        <span>Вы закончили?</span>
                        <h2>Обновите данные</h2>
                        <p>Пожалуйста, просмотрите всю указанную информацию еще раз и нажмите на кнопку ниже, чтобы
                            обновить данные компании</p>
                    </header>

                    <p class="text-center">
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