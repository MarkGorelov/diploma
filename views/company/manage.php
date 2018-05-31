<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-manage-company.png)">
        <div class="container no-shadow">
            <h1 class="text-center">Управление компаниями</h1>
            <p class="lead text-center">Ниже представлен список созданных вами компаний, вы можете их
                редактировать, удалять или создать новую</p>
        </div>
    </header>

    <main>
        <section class="no-padding-top bg-alt">
            <div class="container">
                <div class="row item-blocks-condensed">

                    <div class="col-xs-12 text-right">
                        <br>
                        <a class="btn btn-primary btn-sm" href="/company-manage/create/">Создать новую компанию</a>
                    </div>

                    <?php foreach ($companiesUser as $companies): ?>
                        <div class="col-xs-12">
                            <div class="item-block">
                                <header>

                                    <a href="/company/<?php echo $companies['id']; ?>"><img
                                                src="<?php echo Company::getImage($companies['id']); ?>" alt=""></a>
                                    <div class="hgroup">
                                        <h4>
                                            <a href="/company/<?php echo $companies['id']; ?>">
                                                <?php echo $companies['company_name']; ?>
                                            </a>
                                        </h4>
                                        <h5>
                                            <?php echo $companies['headline']; ?>
                                        </h5>
                                    </div>

                                    <div class="action-btn">
                                        <a class="btn btn-xs btn-gray"
                                           href="/company-manage/update/<?php echo $companies['id']; ?>">Редактировать</a>
                                        <a class="btn btn-xs btn-danger"
                                           href="/company-manage/delete/<?php echo $companies['id']; ?>">Удалить</a>
                                    </div>

                                </header>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </section>
    </main>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>