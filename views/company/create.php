<?php include ROOT . '/views/layouts/header_main.php'; ?>


    <form action="#" method="post">

        <!-- Page header -->
        <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner1.jpg);">
            <div class="container page-name">
                <h1 class="text-center">Зарегистрировать компанию</h1>
                <p class="lead text-center">Создайте профиль своей компании и разместите его на сайте</p>
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
                    <div class="col-xs-12">
                        <div class="row">

                            <div class="col-xs-12 col-sm-4 col-lg-2">
                                <div class="form-group">
                                    <img src="<?php echo Company::getImage($company['id']); ?>" width="200" alt=""/>
                                    <input type="file" class="dropify" name="img"
                                           value="<?php echo $company['img']; ?>">
                                    <span class="help-block">Добавьте логотип компании</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-8 col-lg-10">

                                <div class="form-group">
                                    <input type="text" name="company_name" class="form-control input-lg"
                                           placeholder="Название компании">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="headline" class="form-control"
                                           placeholder="Вид деятельности">
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


                                <select class="form-control selectpicker" name="status">
                                    <option value="1" selected="selected">Отображается</option>
                                    <option value="0">Скрыт</option>
                                </select>
                                </br> </br>

                                <div class="form-group">
                                    <textarea class="form-control" name="short_description" rows="3"
                                              placeholder="Краткое описание"></textarea>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row">

                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" name="location" class="form-control"
                                           placeholder="Местоположение">
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
                                           placeholder="Сайт компании">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                                    <input type="text" name="founded" class="form-control" placeholder="Дата основания">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" name="phone_number" class="form-control"
                                           placeholder="Номер телефона">
                                </div>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6 col-md-4">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="text" name="email_address" class="form-control"
                                           placeholder="Email компании">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </header>
        <!-- END Page header -->


        <!-- Main container -->
        <main>

            <!-- Company detail -->
            <section class=" bg-alt">
                <div class="container">

                    <header class="section-header">
                        <h2>О компании</h2>
                        <p>Напишите о своей компании, культуре, коллективе, преимуществах работы в компании и т.д.</p>
                    </header>

                    <textarea class="summernote-editor" name="company_detail"></textarea>

                </div>
            </section>
            <!-- END Company detail -->


            <!-- Submit -->
            <section>
                <div class="container">
                    <header class="section-header">
                        <span>Вы закончили?</span>
                        <h2>Зарегистрируйте компанию</h2>
                        <p>Пожалуйста, просмотрите всю указанную информацию еще раз и нажмите на кнопку ниже, чтобы
                            зарегистрировать свою компанию</p>
                    </header>

                    <p class="text-center">
                        <input type="submit" name="submit" class="btn btn-success btn-xl btn-round"
                               value="Зарегистрировать">
                    </p>

                </div>
            </section>
            <!-- END Submit -->


        </main>
        <!-- END Main container -->

    </form>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>