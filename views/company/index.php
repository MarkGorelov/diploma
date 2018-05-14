<?php include ROOT . '/views/layouts/header_main.php'; ?>


<!-- Page header -->
<header class="page-header bg-img" style="background-image: url(/template/img/bg-banner1.jpg);">
    <div class="container page-name">
        <h1 class="text-center">Просмотр всех компаний</h1>
        <p class="lead text-center">Используйте поиск чтобы найти нужную вам компанию</p>
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
                        <option selected>Все категории</option>
                        <option>Разработчик</option>
                        <option>ДиЗаЙнЕр</option>
                        <option>Пидор</option>
                        <option>Шелуха</option>
                        <option>Другое</option>
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
                    <h5>Мы нашли <strong>86</strong> компаний, вы просматриваете <strong>10</strong> из
                        <strong>15</strong></h5>
                </div>

                <?php foreach ($latestCompanies as $company): ?>
                    <!-- Company detail -->
                    <div class="col-xs-12">
                        <a class="item-block" href="/company/<?php echo $company['id']; ?>">
                            <header>
                                <img src="<?php echo Company::getImage($company['id']); ?>" alt="">
                                <div class="hgroup">
                                    <h4><?php echo $company['company_name']; ?></h4>
                                    <h5><?php echo $company['headline']; ?></h5>
                                </div>
                            </header>

                            <div class="item-body">
                                <p><?php echo $company['short_description']; ?></p>
                            </div>
                        </a>
                    </div>
                    <!-- END Company detail -->
                <?php endforeach; ?>

            </div>
        </div>
    </section>
</main>
<!-- END Main container -->

<?php include ROOT . '/views/layouts/footer_main.php'; ?>
