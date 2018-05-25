<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-manage-company.png)">
        <div class="container no-shadow">
            <h1 class="text-center">Управление вакансиями</h1>
            <p class="lead text-center">Ниже представлен список созданных вами вакансий, вы можете их
                редактировать, удалять или создать новую</p>
        </div>
    </header>
    <!-- END Page header -->

    <!-- Main container -->
    <main>
        <section class="no-padding-top bg-alt">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 text-right">
                        <br>
                        <a class="btn btn-primary btn-sm" href="/vacancy-manage/create/">Добавить вакансию</a>
                    </div>

                    <?php foreach ($vacanciesUser as $vacancies): ?>
                        <!-- Job detail -->
                        <div class="col-xs-12">
                            <div class="item-block">
                                <header>
                                    <a href="/company/<?php echo $vacancies['id']; ?>"><img
                                                src="<?php echo Vacancy::getImage($vacancies['id']); ?>" alt=""></a>
                                    <div class="hgroup">
                                        <h4>
                                            <a href="/vacancy/<?php echo $vacancies['id']; ?>">
                                                <?php echo $vacancies['job_title']; ?>
                                            </a>
                                        </h4>
                                        <h5>
                                            <a href="/company/<?php echo $vacancies['id']; ?>">
                                                <?php echo $vacancies['company_name']; ?>
                                            </a>
                                        </h5>
                                    </div>
                                    <div class="header-meta">
                                        <span class="location"><?php echo $vacancies['location']; ?></span>
                                    </div>
                                </header>

                                <footer>
                                    <p class="status"><strong>Статус: </strong><?php echo $vacancies['status']; ?></p>

                                    <div class="action-btn">
                                        <a class="btn btn-xs btn-gray"
                                           href="/vacancy-manage/update/<?php echo $vacancies['id']; ?>">Редактировать</a>
                                        <a class="btn btn-xs btn-danger"
                                           href="/vacancy-manage/delete/<?php echo $vacancies['id']; ?>">Удалить</a>
                                    </div>

                                </footer>
                            </div>
                        </div>
                        <!-- END Job detail -->
                    <?php endforeach; ?>

                </div>
            </div>
        </section>
    </main>
    <!-- END Main container -->

<?php include ROOT . '/views/layouts/footer_main.php'; ?>