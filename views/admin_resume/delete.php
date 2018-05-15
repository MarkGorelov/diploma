<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/resume">Управление резюме</a></li>
                    <li class="active">Удалить резюме</li>
                </ol>
            </div>


            <h4>Удалить резюме #<?php echo $id; ?></h4>


            <p>Вы действительно хотите удалить это резюме?</p>

            <form method="post">
                <input type="submit" name="submit" value="Удалить" />
            </form>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

