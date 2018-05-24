<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <!-- Site header -->
    <header class="site-header size-lg text-center" style="background-image: url(/template/img/bg-banner.jpg)">
        <div class="container">
            <div class="col-xs-12">
                <br><br>
                <h2>
                    Мы предлагаем
                    <mark>1 290</mark>
                    вакансий прямо сейчас!
                </h2>
                <h5 class="font-alt">Найди работу своей мечты.</h5>
                <br><br><br>
                <form class="header-job-search">
                    <div class="input-keyword">
                        <input type="text" class="form-control" placeholder="Название должности или компании">
                    </div>

                    <div class="input-location">
                        <input type="text" class="form-control" placeholder="Страну, город">
                    </div>

                    <div class="btn-search">
                        <button class="btn btn-primary" type="submit">Найти работу</button>
                        <a href="/vacancies/">Расширенный поиск работы</a>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <!-- END Site header -->

    <!-- Main container -->
    <main>

        <!-- Recent jobs -->
        <section>
            <div class="container">
                <header class="section-header">
                    <h2>Последние вакансии</h2>
                </header>

                <div class="row item-blocks-connected">
                    <?php foreach ($latestVacancies as $vacancy): ?>
                        <!-- Job item -->
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
                        <!-- END Job item -->
                    <?php endforeach; ?>
                </div>

                <br><br>
                <p class="text-center"><a class="btn btn-info" href="/vacancies/">Просмотреть всё</a></p>
            </div>
        </section>
        <!-- END Recent jobs -->

        <!-- Facts -->
        <section class="bg-img bg-repeat no-overlay section-sm">
            <div class="container">

                <div class="row">
                    <div class="counter col-md-3 col-sm-6">
                        <p><span data-from="0" data-to="6890"></span>+</p>
                        <h6>Вакансий</h6>
                    </div>

                    <div class="counter col-md-3 col-sm-6">
                        <p><span data-from="0" data-to="1200"></span>+</p>
                        <h6>Пользователей</h6>
                    </div>

                    <div class="counter col-md-3 col-sm-6">
                        <p><span data-from="0" data-to="36800"></span>+</p>
                        <h6>Резюме</h6>
                    </div>

                    <div class="counter col-md-3 col-sm-6">
                        <p><span data-from="0" data-to="15400"></span>+</p>
                        <h6>Компаний</h6>
                    </div>
                </div>

            </div>
        </section>
        <!-- END Facts -->

        <!-- Newsletter -->
        <section class="bg-img text-center" style="background-image: url(/template/img/bg-facts.png)">
            <div class="container">
                <h2><strong>ПОДПИШИСЬ</strong></h2>
                <h6 class="font-alt">Получайте еженедельно новые вакансии, на свой почтовый ящик</h6>
                <br><br>
                <form class="form-subscribe" action="#">
                    <div class="input-group">
                        <input type="text" class="form-control input-lg" placeholder="Ваш email">
                        <span class="input-group-btn">
                <button class="btn btn-success btn-lg" type="submit">Подписаться</button>
              </span>
                    </div>
                </form>
            </div>
        </section>
        <!-- END Newsletter -->

    </main>
    <!-- END Main container -->

<?php include ROOT . '/views/layouts/footer_main.php'; ?>