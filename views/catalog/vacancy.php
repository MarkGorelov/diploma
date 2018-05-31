<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner.jpg);">
        <div class="container page-name">
            <h1 class="text-center">Поиск работы</h1>
            <p class="lead text-center">Используйте выпадающий список, чтобы найти нужную вам вакансию по выбранной вами
                категории</p>
        </div>

        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12">
                        <p>Выберите категорию</p>
                        <select class="form-control selectpicker"
                                onchange="if (this.value) window.location.href = this.value">
                            <?php foreach ($categories as $categoryItem): ?>
                                <option></option>
                                <option value="/vacancies-category/<?php echo $categoryItem['id']; ?>/page-1"><?php echo $categoryItem['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <section class="bg-white">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12">
                        <br>
                        <h5>Мы нашли вакансий по вашим запросам</h5>
                    </div>

                    <?php foreach ($categoryVacancies as $vacancy): ?>
                        <div class="col-xs-12">
                            <a class="item-block" href="/vacancy/<?php echo $vacancy['id']; ?>">
                                <header>
                                    <img src="<?php echo Vacancy::getImage($vacancy['id']); ?>" alt="">
                                    <div class="hgroup">
                                        <h4><?php echo $vacancy['job_title']; ?></h4>
                                        <h5>
                                            <?php echo $vacancy['company_name']; ?>
                                            <span class="label label-success"><?php echo $vacancy['type_of_employment']; ?></span>
                                        </h5>
                                    </div>
                                </header>

                                <div class="item-body">
                                    <p><?php echo $vacancy['short_description']; ?></p>
                                </div>

                                <footer>
                                    <ul class="details cols-3">
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                            <span><?php echo $vacancy['location']; ?></span>
                                        </li>

                                        <li>
                                            <i class="fa fa-money"></i>
                                            <span><?php echo $vacancy['salary']; ?> рублей</span>
                                        </li>

                                        <li>
                                            <i class="fa fa-certificate"></i>
                                            <span>Пол: <?php echo $vacancy['gender']; ?></span>
                                        </li>
                                    </ul>
                                </footer>
                            </a>
                        </div>
                    <?php endforeach; ?>

                </div>

                <nav class="text-center">
                    <?php echo $pagination->get(); ?>
                </nav>

            </div>
        </section>
    </header>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>