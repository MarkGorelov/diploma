<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/tag">Управление тегами</a></li>
                        <li class="active">Редактировать тег</li>
                    </ol>
                </div>

                <h4>Редактировать тег №<?php echo $id; ?></h4>

                <br/>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <p>Название тега</p>
                            <input type="text" class="form-control" name="name" placeholder=""
                                   value="<?php echo $tag['name']; ?>">

                            <br/><br/>

                            <p>Статус</p>
                            <select class="form-control selectpicker" name="status">
                                <option value="1" <?php if ($tag['status'] == 1) echo ' selected="selected"'; ?>>
                                    Отображается
                                </option>
                                <option value="0" <?php if ($tag['status'] == 0) echo ' selected="selected"'; ?>>Скрыт
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