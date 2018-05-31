<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <header class="site-header size-lg text-center" style="background-image: url(/template/img/bg-banner.jpg)">
        <div class="container">
            <div class="col-xs-12">
                <br><br>
                <h2>
                    Мы предлагаем
                    <mark><?php echo Vacancy::getCountVacancies() ?></mark>
                    вакансий прямо сейчас!
                </h2>
                <h5 class="font-alt">Найди работу своей мечты.</h5>
                <br><br><br>
            </div>
        </div>
    </header>

    <main>
        <section>
            <div class="container">
                <header class="section-header">
                    <h2>Последние вакансии</h2>
                </header>

                <div class="row item-blocks-connected">
                    <?php foreach ($latestVacancies as $vacancy): ?>
                        <div class="col-xs-12">
                            <a class="item-block" href="/vacancy/<?php echo $vacancy['id']; ?>">
                                <header>
                                    <img src="<?php echo Vacancy::getImage($vacancy['id']); ?>" alt="">
                                    <div class="hgroup">
                                        <h4><?php echo $vacancy['job_title']; ?></h4>
                                        <h5><?php echo $vacancy['company_name']; ?></h5>
                                    </div>
                                    <div class="header-meta">
                                        <span class="location"><?php echo $vacancy['location']; ?></span>
                                        <span class="label label-success"><?php echo $vacancy['type_of_employment']; ?></span>
                                    </div>
                                </header>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <br><br>
                <p class="text-center"><a class="btn btn-info" href="/vacancies-category/3/page-1">Просмотреть всё</a></p>
            </div>
        </section>

        <section>
            <div class="container">

                <div class="row">
                    <div class="counter col-md-3 col-sm-6">
                        <p><span data-from="0" data-to="<?php echo Vacancy::getCountVacancies() ?>"></span>+</p>
                        <h6>Вакансий</h6>
                    </div>

                    <div class="counter col-md-3 col-sm-6">
                        <p><span data-from="0" data-to="<?php echo User::getCountUsers() ?>"></span>+</p>
                        <h6>Пользователей</h6>
                    </div>

                    <div class="counter col-md-3 col-sm-6">
                        <p><span data-from="0" data-to="<?php echo Resume::getCountResumes() ?>"></span>+</p>
                        <h6>Резюме</h6>
                    </div>

                    <div class="counter col-md-3 col-sm-6">
                        <p><span data-from="0" data-to="<?php echo Company::getCountCompanies() ?>"></span>+</p>
                        <h6>Компаний</h6>
                    </div>
                </div>

            </div>
        </section>

        <section class="bg-alt">
            <div class="container">
                <header class="section-header">
                    <span>Категории вакансий</span>
                    <h2>Популярные категории</h2>
                </header>

                <div class="category-grid">
                    <?php foreach ($categories as $categoryItem): ?>
                        <a href="/vacancies-category/<?php echo $categoryItem['id']; ?>/page-1">
                            <img width="120" src="/template/img/category_avatar.png">
                            <h6><?php echo $categoryItem['name']; ?></h6>
                        </a>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>

        <section class="bg-img text-center" style="background-image: url(/template/img/bg-facts.png)">
            <div class="container">
                <h2><strong>ПОДПИШИСЬ</strong></h2>
                <h6 class="font-alt">Получайте еженедельно новые вакансии, на свой почтовый ящик</h6>
                <br><br>
                <form class="form-subscribe" action="/" method="post">
                    <div class="input-group">
                        <input type="text" name="email" class="form-control input-lg" placeholder="Ваш email">
                        <span class="input-group-btn">
                            <input class="btn btn-success btn-lg" type="submit" name="submit" value="Подписаться"/>
                        </span>
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>