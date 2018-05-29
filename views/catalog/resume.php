<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <!-- Page header -->
    <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner.jpg);">
        <div class="container page-name">
            <h1 class="text-center">Поиск резюме</h1>
            <p class="lead text-center">Используйте выпадающий список, чтобы найти нужного вам специалиста по выбранной вами
                сфере</p>
        </div>

        <div class="container">
            <form action="#">

                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12">
                        <p>Выберите сферу</p>
                        <select class="form-control selectpicker"
                                onchange="if (this.value) window.location.href = this.value">
                            <?php foreach ($categories as $categoryItem): ?>
                                <option></option>
                                <option value="/resumes-category/<?php echo $categoryItem['id']; ?>/page-1"><?php echo $categoryItem['name']; ?></option>
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
                        <h5>Мы нашли данные резюме по указанной вами сферы</h5>
                    </div>

                    <?php foreach ($categoryResumes as $resume): ?>
                        <!-- Job item -->
                        <div class="col-xs-12">
                            <a class="item-block" href="/resume/<?php echo $resume['id']; ?>">
                                <header>
                                    <img src="<?php echo Resume::getImage($resume['id']); ?>" height="70" alt="">
                                    <div class="hgroup">
                                        <h4><?php echo $resume['name']; ?></h4>
                                        <h5>
                                            <?php echo $resume['headline']; ?>
                                        </h5>
                                    </div>
                                </header>

                                <div class="item-body">
                                    <p><?php echo $resume['short_description']; ?></p>
                                </div>

                                <footer>
                                    <ul class="details cols-3">
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                            <span><?php echo $resume['location']; ?></span>
                                        </li>

                                        <li>
                                            <i class="fa fa-money"></i>
                                            <span><?php echo $resume['salary']; ?> рублей</span>
                                        </li>

                                        <li>
                                            <i class="fa fa-certificate"></i>
                                            <span>Пол: <?php echo $resume['gender']; ?></span>
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
                    <?php echo $pagination->get(); ?>
                </nav>
                <!-- END Page navigation -->

            </div>
        </section>

    </header>
    <!-- END Page header -->


<?php include ROOT . '/views/layouts/footer_main.php'; ?>