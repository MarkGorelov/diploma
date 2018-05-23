<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/resume">Управление резюме</a></li>
                        <li class="active">Редактировать резюме</li>
                    </ol>
                </div>

                <h4>Добавить новое резюме</h4>

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

                            <p>Имя, Фамилия</p>
                            <input type="text" class="form-control" name="name" placeholder="" value="">

                            <p>Должность</p>
                            <input type="text" class="form-control" name="headline" placeholder="" value="">

                            <p>О себе</p>
                            <input type="text" class="form-control" name="short_description" placeholder="" value="">

                            <p>Местоположение</p>
                            <input type="text" class="form-control" name="location" placeholder="" value="">

                            <p>Личный сайт</p>
                            <input type="text" class="form-control" name="website_address" placeholder="" value="">

                            <p>Желаемый заработок</p>
                            <input type="text" class="form-control" name="salary" placeholder="" value="">

                            <p>Возраст</p>
                            <input type="text" class="form-control" name="age" placeholder="" value="">

                            <p>Номер телефона</p>
                            <input type="text" class="form-control" name="phone_number" placeholder="" value="">

                            <p>Email</p>
                            <input type="text" class="form-control" name="email_address" placeholder="" value="">

                            <p>Пол</p>
                            <input type="text" class="form-control" name="gender" placeholder="" value="">

                            <p>Изображение резюме</p>
                            <img src="<?php echo AdminResume::getImage($resume['id']); ?>" width="200" alt=""/>
                            <input type="file" name="img" placeholder="" value="<?php echo $resume['img']; ?>">

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

                            <p>Тег</p>
                            <select class="form-control selectpicker" name="tag_id">
                                <?php if (is_array($tagsList)): ?>
                                    <?php foreach ($tagsList as $tag): ?>
                                        <option value="<?php echo $tag['id']; ?>">
                                            <?php echo $tag['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <p>Образование</p>
                            <select class="form-control selectpicker" name="education_id">
                                <?php if (is_array($listOfEducations)): ?>
                                    <?php foreach ($listOfEducations as $education): ?>
                                        <option value="<?php echo $education['id']; ?>">
                                            <?php echo $education['school_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <p>Опыт работы</p>
                            <select class="form-control selectpicker" name="work_experience_id">
                                <?php if (is_array($listOfWorkExperiences)): ?>
                                    <?php foreach ($listOfWorkExperiences as $workExperience): ?>
                                        <option value="<?php echo $workExperience['id']; ?>">
                                            <?php echo $workExperience['company_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <br/><br/>

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