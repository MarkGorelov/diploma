<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-manage-company.png)">
        <div class="container no-shadow">
            <h1 class="text-center">Удалить образование № <?php echo $id; ?></h1>
            <p class="lead text-center">Вы действительно хотите удалить эту информацию?</p>
            <form method="post">
                <input class="btn btn-xs btn-danger center-block" type="submit" name="submit" value="Удалить"/>
            </form>
        </div>
    </header>
    <!-- END Page header -->

<?php include ROOT . '/views/layouts/footer_main.php'; ?>