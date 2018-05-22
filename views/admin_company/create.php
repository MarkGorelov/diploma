<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/company">Управление компаниями</a></li>
                        <li class="active">Регистрация компании</li>
                    </ol>
                </div>

                <h4>Регистрация новой компании</h4>

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
                        <form action="#" method="post" enctype="multipart/form-data">

                            <p>Название компании</p>
                            <input type="text" class="form-control" name="company_name" placeholder="" value="">

                            <p>Вид деятельности</p>
                            <input type="text" class="form-control" name="headline" placeholder="" value="">

                            <p>Краткое описание</p>
                            <div class="form-group">
                                    <textarea class="form-control" name="short_description" rows="3"
                                              placeholder=""></textarea>
                            </div>

                            <p>Местоположение</p>
                            <input type="text" class="form-control" name="location" placeholder="" value="">

                            <p>Дата основания</p>
                            <input type="text" class="form-control" name="founded" placeholder="" value="">

                            <p>Количество сотрудников</p>
                            <select class="form-control selectpicker" name="employees">
                                <option>0 - 9</option>
                                <option selected>10 - 99</option>
                                <option>100 - 999</option>
                                <option>1,000 - 9,999</option>
                                <option>10,000 - 99,999</option>
                                <option>100,000 - 999,999</option>
                            </select>

                            <p>Сайт компании</p>
                            <input type="text" class="form-control" name="website_address" placeholder="" value="">

                            <p>Номер телефона</p>
                            <input type="text" class="form-control" name="phone_number" placeholder="" value="">

                            <p>Email</p>
                            <input type="text" class="form-control" name="email_address" placeholder="" value="">

                            <p>О компании</p>
                            <div class="form-group">
                                    <textarea class="form-control" name="company_detail" rows="3"
                                              placeholder=""></textarea>
                            </div>

                            <p>Изображение компании</p>
                            <img src="<?php echo AdminCompany::getImage($company['id']); ?>" width="200" alt=""/>
                            <input type="file" name="img" placeholder="" value="<?php echo $company['img']; ?>">

                            <p>Категория</p>
                            <select class="form-control selectpicker" name="category_id">
                                <?php if (is_array($categoriesList)): ?>
                                    <?php foreach ($categoriesList as $category): ?>
                                        <option value="<?php echo $category['id']; ?>">
                                            <?php echo $category['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <p>Статус</p>
                            <select class="form-control selectpicker" name="status">
                                <option value="1" selected="selected">Отображается</option>
                                <option value="0">Скрыт</option>
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