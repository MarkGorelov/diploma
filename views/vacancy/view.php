<?php include ROOT . '/views/layouts/header_main.php'; ?>
    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-banner1.jpg)">
        <div class="container">
            <div class="header-detail">
                <img class="logo" src="<?php echo Vacancy::getImage($vacancy['id']); ?>" alt="">
                <div class="hgroup">
                    <h1><?php echo $vacancy['job_title']; ?></h1>
                    <h3><a href="/"><?php echo $vacancy['company_name']; ?></a></h3>
                </div>
                <hr>
                <p class="lead"><?php echo $vacancy['short_description']; ?></p>

                <ul class="details cols-3">
                    <li>
                        <i class="fa fa-map-marker"></i>
                        <span><?php echo $vacancy['location']; ?></span>
                    </li>

                    <li>
                        <i class="fa fa-briefcase"></i>
                        <span><?php echo $vacancy['type_of_employment']; ?></span>
                    </li>

                    <li>
                        <i class="fa fa-money"></i>
                        <span><?php echo $vacancy['salary']; ?></span>
                    </li>

                    <li>
                        <i class="fa fa-clock-o"></i>
                        <span><?php echo $vacancy['working']; ?></span>
                    </li>

                    <li>
                        <i class="fa fa-flask"></i>
                        <span><?php echo $vacancy['experince']; ?></span>
                    </li>

                    <li>
                        <i class="fa fa-certificate"></i>
                        <a href="#"><?php echo $vacancy['gender']; ?></a>
                    </li>
                </ul>


            </div>
        </div>
    </header>
    <!-- END Page header -->


    <!-- Main container -->
    <main>

        <!-- Job detail -->
        <section>
            <div class="container">
                <p><?php echo $vacancy['job_detail']; ?></p>
            </div>
        </section>
        <!-- END Job detail -->

    </main>
    <!-- END Main container -->
<?php include ROOT . '/views/layouts/footer_main.php'; ?>