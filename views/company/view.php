<?php include ROOT . '/views/layouts/header_main.php'; ?>
    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-banner1.jpg)">
        <div class="container">
            <div class="header-detail">
                <img class="logo" src="<?php echo Company::getImage($company['id']); ?>" alt="">
                <div class="hgroup">
                    <h1><?php echo $company['company_name']; ?></h1>
                    <h3><?php echo $company['headline']; ?></h3>
                </div>
                <hr>
                <p class="lead"><?php echo $company['short_description']; ?>.</p>

                <ul class="details cols-3">
                    <li>
                        <i class="fa fa-map-marker"></i>
                        <span><?php echo $company['location']; ?></span>
                    </li>

                    <li>
                        <i class="fa fa-globe"></i>
                        <a href="#"><?php echo $company['website_address']; ?></a>
                    </li>

                    <li>
                        <i class="fa fa-users"></i>
                        <span><?php echo $company['employees']; ?></span>
                    </li>

                    <li>
                        <i class="fa fa-birthday-cake"></i>
                        <span><?php echo $company['founded']; ?></span>
                    </li>

                    <li>
                        <i class="fa fa-phone"></i>
                        <span><?php echo $company['phone_number']; ?></span>
                    </li>

                    <li>
                        <i class="fa fa-envelope"></i>
                        <a href="#"><?php echo $company['email_address']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- END Page header -->

    <!-- Main container -->
    <main>

        <!-- Company detail -->
        <section>
            <div class="container">

                <header class="section-header">
                    <h2>О компании</h2>
                </header>

                <p><?php echo $company['company_detail']; ?></p>

            </div>
        </section>
        <!-- END Company detail -->

        <!-- Open positions -->
        <section id="open-positions" class="bg-alt">
            <div class="container">
                <header class="section-header">
                    <h2>Вакансии</h2>
                </header>

                <div class="row">
                    <?php foreach ($jobsCompany as $vacancies): ?>
                        <!-- Job item -->
                        <div class="col-xs-12">
                            <a class="item-block" href="/vacancy/<?php echo $vacancies['id']; ?>">
                                <header>
                                    <img src="/template/img/logo-google.jpg" alt="">
                                    <div class="hgroup">
                                        <h4><?php echo $vacancies['job_title']; ?></h4>
                                        <h5>
                                            <?php echo $vacancies['company_name']; ?>
                                            <span class="label label-success">
                                                <?php echo $vacancies['type_of_employment']; ?>
                                            </span>
                                        </h5>
                                    </div>
                                </header>

                                <div class="item-body">
                                    <p><?php echo $vacancies['short_description']; ?></p>
                                </div>

                                <footer>
                                    <ul class="details cols-3">
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                            <span><?php echo $vacancies['location']; ?></span>
                                        </li>

                                        <li>
                                            <i class="fa fa-money"></i>
                                            <span><?php echo $vacancies['salary']; ?> рублей</span>
                                        </li>

                                        <li>
                                            <i class="fa fa-certificate"></i>
                                            <span>Пол: <?php echo $vacancies['gender']; ?></span>
                                        </li>
                                    </ul>
                                </footer>
                            </a>
                        </div>
                        <!-- END Job item -->
                    <?php endforeach; ?>
                </div>

            </div>
        </section>
        <!-- END Open positions -->

    </main>
    <!-- END Main container -->

<?php include ROOT . '/views/layouts/footer_main.php'; ?>