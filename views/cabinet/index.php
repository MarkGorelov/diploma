<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <!-- Site header -->
    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-banner2.png)">
        <div class="container no-shadow">
            <h1 class="text-center">Здраствуйте, <?php echo $user['name'];?>!</h1>
            <p class="lead text-center">Здесь вы можете пойти нахуй</p>
        </div>
    </header>
    <!-- END Site header -->
    <!-- Main container -->
    <main>

        <section>
            <div class="container">

                <h4>Редактирование данных</h4>
                <p>Вы хотите изменить свои личные данные или просто изменить картинку на аккаунте? Не проблема просто
                    перейдите по ссылке ниже.</p>
                <a href="/cabinet/edit/">Редактировать данные</a>

                <hr>
                <hr>
            </div>
        </section>

    </main>
    <!-- END Main container -->

<?php include ROOT . '/views/layouts/footer_main.php'; ?>