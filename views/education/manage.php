<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-manage-company.png)">
        <div class="container no-shadow">
            <h1 class="text-center">Управление образованием</h1>
            <p class="lead text-center">Ниже представлен список образований для резюме, вы можете их
                редактировать, удалять или создать новое</p>
        </div>
    </header>

    <main>
        <section class="no-padding-top bg-alt">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <br>
                        <a class="btn btn-primary btn-sm" href="/education-manage/create/">Добавить образование</a>
                    </div>

                    <?php foreach ($educationsUser as $educations): ?>
                        <div class="col-xs-12">
                            <div class="item-block">
                                <header>
                                    <img src="<?php echo Education::getImage($educations['id']); ?>" alt="">
                                    <div class="hgroup">
                                        <h4>
                                            <?php echo $educations['degree']; ?>
                                            <small><?php echo $educations['branch']; ?></small>
                                        </h4>
                                        <h5><?php echo $educations['school_name']; ?></h5>
                                    </div>
                                </header>

                                <div class="item-body">
                                    <p><?php echo $educations['short_description']; ?></p>
                                </div>

                                <footer>

                                    <div class="action-btn">
                                        <a class="btn btn-xs btn-gray"
                                           href="/education-manage/update/<?php echo $educations['id']; ?>">Редактировать</a>
                                        <a class="btn btn-xs btn-danger"
                                           href="/education-manage/delete/<?php echo $educations['id']; ?>">Удалить</a>
                                    </div>

                                </footer>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </section>
    </main>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>