<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-manage-company.png)">
        <div class="container no-shadow">
            <h1 class="text-center">Управление резюме</h1>
            <p class="lead text-center">Ниже представлен список созданных вами резюме, вы можете их
                редактировать, удалять или создать новое</p>
        </div>
    </header>

    <main>
        <section class="no-padding-top bg-alt">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 text-right">
                        <br>
                        <a class="btn btn-primary btn-sm" href="/resume-manage/create/">Создать новое резюме</a>
                    </div>

                    <?php foreach ($resumesUser as $resumes): ?>
                        <div class="col-xs-12">
                            <div class="item-block">
                                <header>
                                    <a href="/resume/<?php echo $resumes['id']; ?>"><img
                                                src="<?php echo Resume::getImage($resumes['id']); ?>" height="70"  alt=""></a>
                                    <div class="hgroup">
                                        <h4>
                                            <a href="/resume/<?php echo $resumes['id']; ?>">
                                                <?php echo $resumes['name']; ?>
                                            </a>
                                        </h4>
                                        <h5><?php echo $resumes['headline']; ?></h5>
                                    </div>
                                    <div class="header-meta">
                                        <span class="location"><?php echo $resumes['location']; ?></span>
                                        <span class="rate"><?php echo $resumes['salary']; ?> Рублей</span>
                                    </div>
                                </header>

                                <footer>
                                    <div class="action-btn">
                                        <a class="btn btn-xs btn-gray"
                                           href="/resume-manage/update/<?php echo $resumes['id']; ?>">Редактировать</a>
                                        <a class="btn btn-xs btn-danger"
                                           href="/resume-manage/delete/<?php echo $resumes['id']; ?>">Удалить</a>
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