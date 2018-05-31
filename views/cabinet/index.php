<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-banner2.png)">
        <div class="container no-shadow">
            <h1 class="text-center">Здраствуйте, <?php echo $user['name']; ?>!</h1>
            <p class="lead text-center">Вы находитесь в личном кабинете, пролестайте ниже, чтобы узнать что вы можете
                сделать</p>
        </div>
    </header>

    <main>
        <section>
            <div class="container">

                <?php if ($user['role'] == 'admin'): ?>

                    <h4>Административная панель</h4>
                    <p>Перейдя по ссылке ниже вы попадете в административную панель</p>
                    <a href="/admin/">Административная панель</a>
                    <hr>

                <?php elseif ($user['role'] == 'employer'): ?>

                    <h4>Управление компаниями</h4>
                    <p>Перейдя по ссылке ниже вы сможете создать свою компанию, а так же ее редактировать и удалять</p>
                    <a href="/company-manage/">Управление компаниями</a>
                    <hr>

                    <h4>Управление вакансиями</h4>
                    <p>Перейдя по ссылке ниже вы сможете создать свою вакансию, а так же ее редактировать и удалять</p>
                    <a href="/vacancy-manage/">Управление вакансиями</a>
                    <hr>

                <?php elseif ($user['role'] == 'aspirant'): ?>

                    <h4>Управление резюме</h4>
                    <p>Перейдя по ссылке ниже вы сможете создать своё резюме, а так же его редактировать и удалять</p>
                    <a href="/resume-manage/">Управление резюме</a>
                    <hr>

                    <h4>Управление образованием</h4>
                    <p>Перейдя по ссылке ниже вы сможете дополнить своё резюме образованием, а также если будет нужно,
                        его отредактировать или вовсе удалить</p>
                    <a href="/education-manage/">Управление образованием</a>
                    <hr>

                    <h4>Управление опытом работы</h4>
                    <p>Перейдя по ссылке ниже вы сможете дополнить своё резюме опытом работы с прошлых мест работы, а
                        также если будет нужно, его отредактировать или вовсе удалить</p>
                    <a href="/work-experience-manage/">Управление опытом работы</a>
                    <hr>

                    <h4>Управление тегами</h4>
                    <p>Перейдя по ссылке ниже вы сможете дополнить своё резюме тегами, а также если будет нужно, их
                        отредактировать или вовсе удалить</p>
                    <a href="/tag-manage/">Управление тегами</a>

                <?php else: ?>

                <?php endif ?>

            </div>
        </section>
    </main>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>