<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <!-- Page header -->
    <header class="page-header bg-img" style="background-image: url(/template/img/bg-banner.jpg);">
        <div class="container page-name">
            <h1 class="text-center">Поиск компаний</h1>
            <p class="lead text-center">Используйте выпадающий список, чтобы найти нужную вам компанию по выбранной вами
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
                                <option value="/companies-category/<?php echo $categoryItem['id']; ?>/page-1"><?php echo $categoryItem['name']; ?></option>
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
                        <h5>Мы нашли данные компании по указанной вами сфере</h5>
                    </div>

                    <?php foreach ($categoryCompanies as $company): ?>
                        <!-- Job item -->
                        <div class="col-xs-12">
                            <a class="item-block" href="/company/<?php echo $company['id']; ?>">
                                <header>
                                    <img src="<?php echo Company::getImage($company['id']); ?>" alt="">
                                    <div class="hgroup">
                                        <h4><?php echo $company['company_name']; ?></h4>
                                        <h5>
                                            <?php echo $company['headline']; ?>
                                        </h5>
                                    </div>
                                </header>

                                <div class="item-body">
                                    <p><?php echo $company['short_description']; ?></p>
                                </div>

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