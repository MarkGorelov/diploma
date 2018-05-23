<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/work-experience">Управление опытом работы</a></li>
                        <li class="active">Редактировать опыт работы</li>
                    </ol>
                </div>

                <h4>Редактировать опыт работы #<?php echo $id; ?></h4>

                <br/>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <p>Название компании</p>
                            <input type="text" class="form-control" name="company_name" placeholder=""
                                   value="<?php echo $workExperience['company_name']; ?>">

                            <p>Кем работал</p>
                            <input type="text" class="form-control" name="position" placeholder=""
                                   value="<?php echo $workExperience['position']; ?>">

                            <p>Год начала и окончания работы в компании</p>
                            <input type="text" class="form-control" name="date_of_experience" placeholder=""
                                   value="<?php echo $workExperience['date_of_experience']; ?>">

                            <p>Краткое описание</p>
                            <input type="text" class="form-control" name="short_description" placeholder=""
                                   value="<?php echo $workExperience['short_description']; ?>">

                            <br/><br/>

                            <p>Изображение компании в которой работал</p>
                            <img src="<?php echo WorkExperience::getImage($workExperience['id']); ?>" width="200"
                                 alt=""/>
                            <input type="file" name="img" placeholder="" value="<?php echo $workExperience['img']; ?>">

                            <br/><br/>

                            <p>Статус</p>
                            <select class="form-control selectpicker" name="status">
                                <option value="1" <?php if ($workExperience['status'] == 1) echo ' selected="selected"'; ?>>
                                    Отображается
                                </option>
                                <option value="0" <?php if ($workExperience['status'] == 0) echo ' selected="selected"'; ?>>
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