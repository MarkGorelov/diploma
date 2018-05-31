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

                <h4>Добавить новый опыт работы</h4>

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
                            <input type="text" class="form-control" name="company_name" placeholder="" value="">

                            <p>Кем работал</p>
                            <input type="text" class="form-control" name="position" placeholder="" value="">

                            <p>Год начала и окончания работы в компании</p>
                            <input type="text" class="form-control" name="date_of_experience" placeholder="" value="">

                            <p>Краткое содержание вашей деятельности в данной компании</p>
                            <input type="text" class="form-control" name="short_description" placeholder="" value="">

                            <p>Изображение компании в которой работал</p>
                            <img src="<?php echo AdminWorkExperience::getImage($workExperience['id']); ?>" width="200"
                                 alt=""/>
                            <input type="file" name="img" placeholder="" value="<?php echo $workExperience['img']; ?>">

                            <br/><br/>
                            <p>Резюме</p>
                            <select class="form-control selectpicker" name="resume_id">
                                <?php if (is_array($resumesList)): ?>
                                    <?php foreach ($resumesList as $resume): ?>
                                        <option value="<?php echo $resume['id']; ?>">
                                            <?php echo $resume['headline']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <p>Статус</p>
                            <select class="form-control selectpicker" name="status">
                                <option value="1" selected="selected">Отображается</option>
                                <option value="0">Скрыт</option>
                            </select>

                            <br/><br/>
                            <input type="hidden" name="user_id" class="btn btn-success btn-xl btn-round"
                                   value=<?php echo $_SESSION['user']; ?>>
                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                            <br/><br/>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>