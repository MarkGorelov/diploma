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

                <h4>Добавить новое учебное учреждение</h4>

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

                            <p>Степень образования</p>
                            <input type="text" class="form-control" name="degree" placeholder="" value="">

                            <p>Отделение</p>
                            <input type="text" class="form-control" name="branch" placeholder="" value="">

                            <p>Название учебного учреждения</p>
                            <input type="text" class="form-control" name="school_name" placeholder="" value="">

                            <p>Год начала и окончания обучения</p>
                            <input type="text" class="form-control" name="date_of_education" placeholder="" value="">

                            <p>Краткое описание</p>
                            <input type="text" class="form-control" name="short_description" placeholder="" value="">

                            <p>Изображение учебного учреждения</p>
                            <img src="<?php echo AdminEducation::getImage($education['id']); ?>" width="200" alt=""/>
                            <input type="file" name="img" placeholder="" value="<?php echo $education['img']; ?>">

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