<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/work-experience">Управление опытом работы</a></li>
                        <li class="active">Удалить опыт работы</li>
                    </ol>
                </div>

                <h4>Удалить опыт работы №<?php echo $id; ?></h4>

                <p>Вы действительно хотите удалить этот опыт работы?</p>

                <form method="post">
                    <input type="submit" class="btn btn-default" name="submit" value="Удалить"/>
                </form>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>