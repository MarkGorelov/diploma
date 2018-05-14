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


            <h4>Добавить новую компанию</h4>

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
                        <input type="text" name="company_name" placeholder="" value="">

                        <p>Вид деятельности</p>
                        <input type="text" name="headline" placeholder="" value="">

                        <p>Краткое описание</p>
                        <input type="text" name="short_description" placeholder="" value="">

                        <p>Местоположение</p>
                        <input type="text" name="location" placeholder="" value="">

                        <p>Дата основания</p>
                        <input type="text" name="founded" placeholder="" value="">

                        <p>Штат</p>
                        <input type="text" name="employees" placeholder="" value="">

                        <p>Сайт компании</p>
                        <input type="text" name="website_address" placeholder="" value="">

                        <p>Номер телефона</p>
                        <input type="text" name="phone_number" placeholder="" value="">

                        <p>Email</p>
                        <input type="text" name="email_address" placeholder="" value="">

                        <p>О компании</p>
                        <input type="text" name="company_detail" placeholder="" value="">

                        <p>Изображение компании</p>
                        <img src="<?php echo User::getImage($company['id']); ?>" width="200" alt="" />
                        <input type="file" name="img" placeholder="" value="<?php echo $company['img']; ?>">

                        <p>Категория</p>
                        <select name="category_id">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>


                        <p>Статус</p>
                        <select name="status">
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

