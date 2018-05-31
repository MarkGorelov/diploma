<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-manage-company.png)">
        <div class="container no-shadow">
            <h1 class="text-center">Управление опытом работы</h1>
            <p class="lead text-center">Ниже представлен список вашей информации об опыте работы для резюме, вы можете ее
                редактировать, удалять или создать новое</p>
        </div>
    </header>

    <main>
        <section class="no-padding-top bg-alt">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 text-right">
                        <br>
                        <a class="btn btn-primary btn-sm" href="/work-experience-manage/create/">Добавить опыт работы</a>
                    </div>

                    <?php foreach ($workExperienceUser as $workExperience): ?>
                        <div class="col-xs-12">
                            <div class="item-block">
                                <header>
                                    <img src="<?php echo WorkExperience::getImage($workExperience['id']); ?>" alt="">
                                    <div class="hgroup">
                                        <h4>
                                            <?php echo $workExperience['company_name']; ?>
                                            <small><?php echo $workExperience['date_of_experience']; ?></small>
                                        </h4>
                                        <h5><?php echo $workExperience['position']; ?></h5>
                                    </div>
                                </header>

                                <div class="item-body">
                                    <p><?php echo $workExperience['short_description']; ?></p>
                                </div>

                                <footer>

                                    <div class="action-btn">
                                        <a class="btn btn-xs btn-gray"
                                           href="/work-experience-manage/update/<?php echo $workExperience['id']; ?>">Редактировать</a>
                                        <a class="btn btn-xs btn-danger"
                                           href="/work-experience-manage/delete/<?php echo $workExperience['id']; ?>">Удалить</a>
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