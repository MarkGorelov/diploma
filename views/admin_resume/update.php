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


            <h4>Редактировать резюме #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Имя, Фамилия</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $resume['name']; ?>">

                        <p>Должность</p>
                        <input type="text" name="headline" placeholder="" value="<?php echo $resume['headline']; ?>">

                        <p>О себе</p>
                        <input type="text" name="short_description" placeholder=""
                               value="<?php echo $resume['short_description']; ?>">

                        <p>Местоположение</p>
                        <input type="text" name="location" placeholder="" value="<?php echo $resume['location']; ?>">

                        <p>Личный сайт</p>
                        <input type="text" name="website_address" placeholder=""
                               value="<?php echo $resume['website_address']; ?>">

                        <p>Желаемый заработок</p>
                        <input type="text" name="salary" placeholder="" value="<?php echo $resume['salary']; ?>">

                        <p>Возраст</p>
                        <input type="text" name="age" placeholder=""
                               value="<?php echo $resume['age']; ?>">

                        <p>Номер телефона</p>
                        <input type="text" name="phone_number" placeholder=""
                               value="<?php echo $resume['phone_number']; ?>">

                        <p>Почта</p>
                        <input type="text" name="email_address" placeholder=""
                               value="<?php echo $resume['email_address']; ?>">

                        <p>Пол</p>
                        <input type="text" name="gender" placeholder=""
                               value="<?php echo $resume['gender']; ?>">

                        <br/><br/>

                        <p>Изображение резюме</p>
                        <img src="<?php echo Resume::getImage($resume['id']); ?>" width="200" alt="" />
                        <input type="file" name="img" placeholder="" value="<?php echo $resume['img']; ?>">

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

                        <p>Тег</p>
                        <select name="tag_id">
                            <?php if (is_array($tagsList)): ?>
                                <?php foreach ($tagsList as $tag): ?>
                                    <option value="<?php echo $tag['id']; ?>">
                                        <?php echo $tag['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <p>Образование</p>
                        <select name="education_id">
                            <?php if (is_array($listOfEducation)): ?>
                                <?php foreach ($listOfEducation as $education): ?>
                                    <option value="<?php echo $education['id']; ?>">
                                        <?php echo $education['school_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <p>Опыт работы</p>
                        <select name="work_experience_id">
                            <?php if (is_array($workExperienceList)): ?>
                                <?php foreach ($workExperienceList as $workExperience): ?>
                                    <option value="<?php echo $workExperience['id']; ?>">
                                        <?php echo $workExperience['company_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>


                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($resume['status'] == 1) echo ' selected="selected"'; ?>>
                                Отображается
                            </option>
                            <option value="0" <?php if ($resume['status'] == 0) echo ' selected="selected"'; ?>>Скрыт
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

