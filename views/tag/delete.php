<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-manage-company.png)">
        <div class="container no-shadow">
            <h1 class="text-center">Удалить тег № <?php echo $id; ?></h1>
            <p class="lead text-center">Вы действительно хотите удалить этот тег?</p>
            <form method="post">
                <input class="btn btn-xs btn-danger center-block" type="submit" name="submit" value="Удалить"/>
            </form>
        </div>
    </header>

<?php include ROOT . '/views/layouts/footer_main.php'; ?>