<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/company">Управление компаниями</a></li>
                        <li class="active">Редактировать компанию</li>
                    </ol>
                </div>

                <h4>Редактировать компанию #<?php echo $id; ?></h4>

                <br/>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <p>Название компании</p>
                            <input type="text" name="company_name" class="form-control" placeholder=""
                                   value="<?php echo $company['company_name']; ?>">

                            <p>Вид деятельности</p>
                            <input type="text" name="headline" class="form-control" placeholder=""
                                   value="<?php echo $company['headline']; ?>">

                            <p>Краткое описание</p>
                            <div class="form-group">
                                    <textarea class="form-control" name="short_description" rows="3"
                                              placeholder=""><?php echo $company['short_description']; ?></textarea>
                            </div>

                            <p>Местоположение</p>
                            <input type="text" name="location" class="form-control" placeholder=""
                                   value="<?php echo $company['location']; ?>">

                            <p>Дата основания</p>
                            <input type="text" name="founded" class="form-control" placeholder=""
                                   value="<?php echo $company['founded']; ?>">

                            <p>Работников компании</p>
                            <input type="text" name="employees" class="form-control" placeholder=""
                                   value="<?php echo $company['employees']; ?>">

                            <p>Количество сотрудников</p>
                            <input type="text" name="website_address" class="form-control" placeholder=""
                                   value="<?php echo $company['website_address']; ?>">

                            <p>Номер телефона</p>
                            <input type="text" name="phone_number" class="form-control" placeholder=""
                                   value="<?php echo $company['phone_number']; ?>">

                            <p>Email</p>
                            <input type="text" name="email_address" class="form-control" placeholder=""
                                   value="<?php echo $company['email_address']; ?>">

                            <p>О компании</p>
                            <div class="form-group">
                                    <textarea class="form-control" name="company_detail" rows="3"
                                              placeholder=""><?php echo $company['company_detail']; ?></textarea>
                            </div>

                            <p>Категория</p>
                            <select name="category_id" class="form-control selectpicker">
                                <?php if (is_array($categoriesList)): ?>
                                    <?php foreach ($categoriesList as $category): ?>
                                        <option value="<?php echo $category['id']; ?>"
                                            <?php if ($company['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                            <?php echo $category['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <br/><br/>

                            <p>Изображение компании</p>
                            <img src="<?php echo AdminCompany::getImage($company['id']); ?>" width="200" alt=""/>
                            <input type="file" name="img" placeholder="" value="<?php echo $company['img']; ?>">

                            <br/><br/>

                            <p>Статус</p>
                            <select name="status" class="form-control selectpicker">
                                <option value="1" <?php if ($company['status'] == 1) echo ' selected="selected"'; ?>>
                                    Отображается
                                </option>
                                <option value="0" <?php if ($company['status'] == 0) echo ' selected="selected"'; ?>>
                                    Скрыт
                                </option>
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