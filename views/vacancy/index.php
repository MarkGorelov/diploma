<?php include ROOT . '/views/layouts/header_main.php'; ?>

<!-- Page header -->
<header class="page-header bg-img" style="background-image: url(/template/img/bg-banner1.jpg);">
    <div class="container page-name">
        <h1 class="text-center">Поиск работы</h1>
        <p class="lead text-center">Используйте поиск, чтобы найти нужную вам вакансию</p>
    </div>

    <div class="container">
        <form action="#">

            <div class="row">
                <div class="form-group col-xs-12 col-sm-4">
                    <input type="text" class="form-control" placeholder="Название компании">
                </div>

                <div class="form-group col-xs-12 col-sm-4">
                    <input type="text" class="form-control" placeholder="Страна, город">
                </div>

                <div class="form-group col-xs-12 col-sm-4">
                    <select class="form-control selectpicker" multiple>
                        <?php foreach ($categories as $categoryItem): ?>
                            <option><?php echo $categoryItem['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <div class="button-group">
                <div class="action-buttons">
                    <button class="btn btn-primary">Найти</button>
                </div>
            </div>

        </form>

    </div>

</header>
<!-- END Page header -->


<!-- Main container -->
<main>
    <section class="no-padding-top bg-alt">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">
                    <br>
                    <h5>Мы нашли <strong>86</strong> вакансий, вы просматриваете <strong>10</strong> из
                        <strong>15</strong></h5>
                </div>

                <?php foreach ($latestVacancies as $vacancy): ?>
                    <!-- Job item -->
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
                    <!-- END Job item -->
                <?php endforeach; ?>

            </div>

            <!-- Page navigation -->
            <nav class="text-center">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <i class="ti-angle-left"></i>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <i class="ti-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- END Page navigation -->

        </div>
    </section>
</main>
<!-- END Main container -->
<?php include ROOT . '/views/layouts/footer_main.php'; ?>
