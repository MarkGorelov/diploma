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


                <h4>Редактировать вакансию №<?php echo $id; ?></h4>

                <br/>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <p>Название компании</p>
                            <input type="text" class="form-control" name="company_name" placeholder=""
                                   value="<?php echo $vacancy['company_name']; ?>">

                            <p>Должность</p>
                            <input type="text" class="form-control" name="job_title" placeholder=""
                                   value="<?php echo $vacancy['job_title']; ?>">

                            <p>Краткое описание</p>
                            <input type="text" class="form-control" name="short_description" placeholder=""
                                   value="<?php echo $vacancy['short_description']; ?>">

                            <p>Сайт компании</p>
                            <input type="text" class="form-control" name="website_address" placeholder=""
                                   value="<?php echo $vacancy['website_address']; ?>">

                            <p>Местоположение</p>
                            <input type="text" class="form-control" name="location" placeholder=""
                                   value="<?php echo $vacancy['location']; ?>">

                            <p>Тип занятости</p>
                            <input type="text" class="form-control" name="type_of_employment" placeholder=""
                                   value="<?php echo $vacancy['type_of_employment']; ?>">

                            <p>Зарпалата</p>
                            <input type="text" class="form-control" name="salary" placeholder=""
                                   value="<?php echo $vacancy['salary']; ?>">

                            <p>Режим работы</p>
                            <input type="text" class="form-control" name="working" placeholder=""
                                   value="<?php echo $vacancy['working']; ?>">

                            <p>Опыт работы</p>
                            <input type="text" class="form-control" name="experince" placeholder=""
                                   value="<?php echo $vacancy['experince']; ?>">

                            <p>Пол</p>
                            <input type="text" class="form-control" name="gender" placeholder=""
                                   value="<?php echo $vacancy['gender']; ?>">

                            <p>О работе</p>
                            <input type="text" class="form-control" name="job_detail" placeholder=""
                                   value="<?php echo $vacancy['job_detail']; ?>">

                            <p>Категория</p>
                            <select class="form-control selectpicker" name="category_id">
                                <?php if (is_array($categoriesList)): ?>
                                    <?php foreach ($categoriesList as $category): ?>
                                        <option value="<?php echo $category['id']; ?>"
                                            <?php if ($vacancy['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                            <?php echo $category['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <p>Компания</p>
                            <select class="form-control selectpicker" name="company_id">
                                <?php if (is_array($companiesList)): ?>
                                    <?php foreach ($companiesList as $company): ?>
                                        <option value="<?php echo $company['id']; ?>"
                                            <?php if ($vacancy['company_id'] == $company['id']) echo ' selected="selected"'; ?>>
                                            <?php echo $company['company_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <br/><br/>

                            <p>Изображение вакансии</p>
                            <img src="<?php echo AdminVacancy::getImage($vacancy['id']); ?>" width="200" alt=""/>
                            <input type="file" name="img" placeholder="" value="<?php echo $vacancy['img']; ?>">

                            <br/><br/>

                            <p>Статус</p>
                            <select class="form-control selectpicker" name="status">
                                <option value="1" <?php if ($vacancy['status'] == 1) echo ' selected="selected"'; ?>>
                                    Отображается
                                </option>
                                <option value="0" <?php if ($vacancy['status'] == 0) echo ' selected="selected"'; ?>>
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