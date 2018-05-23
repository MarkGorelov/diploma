<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/education">Управление учебными учреждениями</a></li>
                        <li class="active">Редактировать учебное учреждение</li>
                    </ol>
                </div>

                <h4>Редактировать учебное учреждение №<?php echo $id; ?></h4>

                <br/>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <p>Название учебного учреждения</p>
                            <input type="text" class="form-control" name="school_name" placeholder=""
                                   value="<?php echo $education['school_name']; ?>">

                            <p>Степень образования</p>
                            <input type="text" class="form-control" name="degree" placeholder="" value="<?php echo $education['degree']; ?>">

                            <p>Отделение</p>
                            <input type="text" class="form-control" name="branch" placeholder=""
                                   value="<?php echo $education['branch']; ?>">

                            <p>Год начала и окончания обученияи</p>
                            <input type="text" class="form-control" name="date_of_education" placeholder=""
                                   value="<?php echo $education['date_of_education']; ?>">

                            <p>Краткое описание</p>
                            <input type="text" class="form-control" name="short_description" placeholder=""
                                   value="<?php echo $education['short_description']; ?>">

                            <br/><br/>

                            <p>Изображение вакансии</p>
                            <img src="<?php echo AdminEducation::getImage($education['id']); ?>" width="200" alt=""/>
                            <input type="file" name="img" placeholder="" value="<?php echo $education['img']; ?>">

                            <br/><br/>

                            <p>Статус</p>
                            <select class="form-control selectpicker" name="status">
                                <option value="1" <?php if ($education['status'] == 1) echo ' selected="selected"'; ?>>
                                    Отображается
                                </option>
                                <option value="0" <?php if ($education['status'] == 0) echo ' selected="selected"'; ?>>
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