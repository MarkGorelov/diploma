<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/vacancy">Управление вакансиями</a></li>
                    <li class="active">Редактировать вакансию</li>
                </ol>
            </div>


            <h4>Добавить новую вакансию</h4>

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

                        <p>Должность</p>
                        <input type="text" name="job_title" placeholder="" value="">

                        <p>Краткое описание</p>
                        <input type="text" name="short_description" placeholder="" value="">

                        <p>Сайт компании</p>
                        <input type="text" name="website_address" placeholder="" value="">

                        <p>Местоположение</p>
                        <input type="text" name="location" placeholder="" value="">

                        <p>Тип занятости</p>
                        <input type="text" name="type_of_employment" placeholder="" value="">

                        <p>Зарпалата</p>
                        <input type="text" name="salary" placeholder="" value="">

                        <p>Режим работы</p>
                        <input type="text" name="working" placeholder="" value="">

                        <p>Опыт работы</p>
                        <input type="text" name="experince" placeholder="" value="">

                        <p>Пол</p>
                        <input type="text" name="gender" placeholder="" value="">

                        <p>О работе</p>
                        <input type="text" name="job_detail" placeholder="" value="">

                        <p>Изображение вакансии</p>
                        <img src="<?php echo Vacancy::getImage($vacancy['id']); ?>" width="200" alt="" />
                        <input type="file" name="img" placeholder="" value="<?php echo $vacancy['img']; ?>">

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

                        <p>Компания</p>
                        <select name="company_id">
                            <?php if (is_array($companiesList)): ?>
                                <?php foreach ($companiesList as $company): ?>
                                    <option value="<?php echo $company['id']; ?>">
                                        <?php echo $company['company_name']; ?>
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

