<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <!-- Page header -->
    <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner1.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <img src="<?php echo Resume::getImage($resume['id']); ?>" alt="">
                </div>

                <div class="col-xs-12 col-sm-8 header-detail">
                    <div class="hgroup">
                        <h1><?php echo $resume['name']; ?></h1>
                        <h3><?php echo $resume['headline']; ?></h3>
                    </div>
                    <hr>
                    <p class="lead"><?php echo $resume['short_description']; ?></p>

                    <ul class="details cols-2">
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <span><?php echo $resume['location']; ?></span>
                        </li>

                        <li>
                            <i class="fa fa-globe"></i>
                            <a href="#"><?php echo $resume['website_address']; ?></a>
                        </li>

                        <li>
                            <i class="fa fa-money"></i>
                            <span><?php echo $resume['salary']; ?> Рублей</span>
                        </li>

                        <li>
                            <i class="fa fa-birthday-cake"></i>
                            <span><?php echo $resume['age']; ?> лет</span>
                        </li>

                        <li>
                            <i class="fa fa-phone"></i>
                            <span><?php echo $resume['phone_number']; ?></span>
                        </li>

                        <li>
                            <i class="fa fa-envelope"></i>
                            <a href="#"><?php echo $resume['email_address']; ?></a>
                        </li>
                    </ul>

                    <div class="tag-list">
                        <?php foreach ($tagsResume as $tag): ?>
                            <span><?php echo $tag['name']; ?></span>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

        </div>
    </header>
    <!-- END Page header -->

    <!-- Main container -->
    <main>

        <!-- Education -->
        <section>
            <div class="container">

                <header class="section-header">
                    <h2>Образование</h2>
                </header>

                <div class="row">
                    <div class="col-xs-12">
                        <?php foreach ($educationResume as $education): ?>
                            <div class="item-block">

                                <header>
                                    <img src="<?php echo Education::getImage($education['id']); ?>" alt="">
                                    <div class="hgroup">
                                        <h4><?php echo $education['degree']; ?>
                                            <small><?php echo $education['branch']; ?></small>
                                        </h4>
                                        <h5><?php echo $education['school_name']; ?></h5>
                                    </div>
                                    <h6 class="time"><?php echo $education['date_of_education']; ?></h6>
                                </header>
                                <div class="item-body">
                                    <p><?php echo $education['short_description']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

            </div>
        </section>
        <!-- END Education -->

        <!-- Work Experience -->
        <section class="bg-alt">
            <div class="container">
                <header class="section-header">
                    <h2>Опыт работы</h2>
                </header>

                <div class="row">

                    <!-- Work item -->
                    <div class="col-xs-12">
                        <?php foreach ($workExperienceResume as $workExperience): ?>
                            <div class="item-block">
                                <header>
                                    <img src="<?php echo WorkExperience::getImage($workExperience['id']); ?>" alt="">
                                    <div class="hgroup">
                                        <h4><?php echo $workExperience['company_name']; ?></h4>
                                        <h5><?php echo $workExperience['position']; ?></h5>
                                    </div>
                                    <h6 class="time"><?php echo $workExperience['date_of_experience']; ?></h6>
                                </header>
                                <div class="item-body">
                                    <p><?php echo $workExperience['short_description']; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- END Work item -->

                </div>

            </div>
        </section>
        <!-- END Work Experience -->

    </main>
    <!-- END Main container -->

<?php include ROOT . '/views/layouts/footer_main.php'; ?>