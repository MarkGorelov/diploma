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
                    <div class="form-group col-xs-12 col-sm-4">
                        <input type="text" class="form-control" placeholder="Имя, теги, образование">
                    </div>

                    <div class="form-group col-xs-12 col-sm-4">
                        <input type="text" class="form-control" placeholder="Местоположение">
                    </div>

                    <div class="form-group col-xs-12 col-sm-4">

                        <select class="form-control selectpicker">
                            <?php foreach ($categories as $categoryItem): ?>
                                <option><?php echo $categoryItem['name']; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>


                    <div class="form-group col-xs-12 col-sm-4">
                        <h6>Уровень дохода</h6>
                        <div class="checkall-group">
                            <div class="checkbox">
                                <input type="checkbox" id="rate1" name="rate" checked>
                                <label for="rate1">По договоренности</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox" id="rate2" name="rate">
                                <label for="rate2">До 45,000 руб.
                                    <small>(364)</small>
                                </label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox" id="rate3" name="rate">
                                <label for="rate3">От 45,000 до 65,000 руб.
                                    <small>(684)</small>
                                </label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox" id="rate4" name="rate">
                                <label for="rate4">От 65,000 до 85,000 руб.
                                    <small>(195)</small>
                                </label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox" id="rate5" name="rate">
                                <label for="rate5">От 85,000 до 105,000 руб.
                                    <small>(39)</small>
                                </label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox" id="rate5" name="rate">
                                <label for="rate5">От 105,000 руб.
                                    <small>(39)</small>
                                </label>
                            </div>

                        </div>

                    </div>


                    <div class="form-group col-xs-12 col-sm-4">
                        <h6>Возраст</h6>
                        <div class="checkall-group">
                            <div class="checkbox">
                                <input type="checkbox" id="degree1" name="degree" checked>
                                <label for="degree1">До 30 лет</label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox" id="degree2" name="degree">
                                <label for="degree2">От 30 до 35 лет
                                    <small>(216)</small>
                                </label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox" id="degree3" name="degree">
                                <label for="degree3">От 35 до 40 лет
                                    <small>(569)</small>
                                </label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox" id="degree4" name="degree">
                                <label for="degree4">От 40 до 45 лет
                                    <small>(439)</small>
                                </label>
                            </div>

                            <div class="checkbox">
                                <input type="checkbox" id="degree5" name="degree">
                                <label for="degree5">От 45 лет
                                    <small>(84)</small>
                                </label>
                            </div>
                        </div>
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

                                    <div class="tag-list">
                                        <?php foreach ($tagsResume as $tag): ?>
                                            <span><?php echo $tag['name']; ?></span>
                                        <?php endforeach; ?>
                                    </div>
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