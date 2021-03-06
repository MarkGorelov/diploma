<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <form action="#" method="post" enctype="multipart/form-data">
        <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner.jpg);">
            <div class="container page-name">
                <h1 class="text-center">Добавте тег для резюме</h1>
                <p class="lead text-center">Добавте тег для резюме и разместите её на сайте</p>
            </div>

            <div class="container">

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="row">

                    <div class="form-group col-xs-12 ">
                        <p class="help-block">Выберите резюме для которого будем добавлять тег</p>
                        <select name="resume_id" class="form-control selectpicker">
                            <?php if (is_array($resumesList)): ?>
                                <?php foreach ($resumesList as $resume): ?>
                                    <option value="<?php echo $resume['id']; ?>">
                                        <?php echo $resume['headline']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group col-xs-12 ">
                        <input type="text" name="name" class="form-control input-lg"
                               placeholder="Имя тега, например #программист и т.д.">
                    </div>

                    <p class="text-center">
                        <input type="hidden" name="status" class="btn btn-success btn-xl btn-round"
                               value="1">
                        <input type="hidden" name="user_id" class="btn btn-success btn-xl btn-round"
                               value=<?php echo $_SESSION['user']; ?>>
                        <input type="submit" name="submit" class="btn btn-success btn-xl btn-round"
                               value="Добавить">
                    </p>
                </div>
            </div>
        </header>
    </form>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>