<?php include ROOT . '/views/layouts/header_main.php'; ?>
    <!-- Page header -->
    <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner1.jpg);">
        <div class="container page-name">
            <h1 class="text-center">Поиск резюме</h1>
            <p class="lead text-center">Используйте поиск чтобы найти подходящее резюме для позиции в вашей компании</p>
        </div>

        <div class="container">
            <form action="#">

                <div class="row">

                    <div class="form-group col-xs-12 col-sm-8">
                        <input type="text" class="form-control" placeholder="Имя, теги, образование">
                    </div>

                    <div class="form-group col-xs-12 col-sm-4">

                        <select class="form-control selectpicker">
                            <?php foreach ($categories as $categoryItem): ?>
                                <option><?php echo $categoryItem['name']; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>

                </div>

                <div class="button-group">
                    <div class="action-buttons">
                        <button class="btn btn-primary" >Найти</button>
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
                        <h5>Мы нашли <strong>86</strong> резюме, вы просматриваете <strong>10</strong> из
                            <strong>15</strong></h5>
                    </div>
                    <?php foreach ($latestResumes as $resume): ?>
                        <!-- Resume detail -->
                        <div class="col-xs-12">
                            <a class="item-block" href="/resume/<?php echo $resume['id']; ?>">
                                <header>
                                    <img class="resume-avatar" src="<?php echo Resume::getImage($resume['id']); ?>"
                                         alt="">
                                    <div class="hgroup">
                                        <h4><?php echo $resume['name']; ?></h4>
                                        <h5><?php echo $resume['headline']; ?></h5>
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
                                            <span><?php echo $resume['salary']; ?> Рублей</span>
                                        </li>

                                        <li>
                                            <i class="fa fa-certificate"></i>
                                            <span>Пол: <?php echo $resume['gender']; ?></span>
                                        </li>
                                    </ul>
                                </footer>
                            </a>
                        </div>
                        <!-- END Resume detail -->
                    <?php endforeach; ?>
                </div>

                <!-- Page navigation -->
                <nav class="text-center">
                        <?php echo $pagination->get(); ?>
                </nav>
                <!-- END Page navigation -->


            </div>
        </section>
    </main>
    <!-- END Main container -->
<?php include ROOT . '/views/layouts/footer_main.php'; ?>