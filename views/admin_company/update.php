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
                        <input type="text" name="name" placeholder="" value="<?php echo $company['company_name']; ?>">

                        <p>Вид деятельности</p>
                        <input type="text" name="code" placeholder="" value="<?php echo $company['headline']; ?>">

                        <p>Краткое описание</p>
                        <input type="text" name="price" placeholder=""
                               value="<?php echo $company['short_description']; ?>">

                        <p>Местоположение</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $company['location']; ?>">

                        <p>Дата основания</p>
                        <input type="text" name="code" placeholder="" value="<?php echo $company['founded']; ?>">

                        <p>Штат</p>
                        <input type="text" name="price" placeholder="" value="<?php echo $company['employees']; ?>">

                        <p>Сайт компании</p>
                        <input type="text" name="name" placeholder=""
                               value="<?php echo $company['website_address']; ?>">

                        <p>Номер телефона</p>
                        <input type="text" name="code" placeholder="" value="<?php echo $company['phone_number']; ?>">

                        <p>Email</p>
                        <input type="text" name="price" placeholder="" value="<?php echo $company['email_address']; ?>">

                        <p>О компании</p>
                        <input type="text" name="price" placeholder=""
                               value="<?php echo $company['company_detail']; ?>">

                        <p>Категория</p>
                        <select name="category_id">
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
                        <img src="<?php echo User::getImage($company['id']); ?>" width="200" alt="" />
                        <input type="file" name="img" placeholder="" value="<?php echo $company['img']; ?>">

                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($company['status'] == 1) echo ' selected="selected"'; ?>>
                                Отображается
                            </option>
                            <option value="0" <?php if ($company['status'] == 0) echo ' selected="selected"'; ?>>Скрыт
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

