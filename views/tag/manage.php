<?php include ROOT . '/views/layouts/header_main.php'; ?>

    <!-- Page header -->
    <header class="page-header bg-img size-lg" style="background-image: url(/template/img/bg-manage-company.png)">
        <div class="container no-shadow">
            <h1 class="text-center">Управление тегами</h1>
            <p class="lead text-center">Ниже представлен список тегов для вашего резюме, вы можете
                их редактировать, удалять или создать новый</p>
        </div>
    </header>
    <!-- END Page header -->

    <!-- Main container -->
    <main>
        <section class="no-padding-top bg-alt">
            <div class="container">
                <div class="row">

                    <div class="col-xs-12 text-right">
                        <br>
                        <a class="btn btn-primary btn-sm" href="/tag-manage/create/">Добавить тег</a>
                    </div>
                    <br><br><br>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="text-center">Название тега</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php foreach ($tagsUser as $tag): ?>
                            <tr>
                                <td class="text-center"><?php echo $tag['name']; ?></td>
                                <td class="text-center"><a href="/tag-manage/update/<?php echo $tag['id']; ?>"
                                                           title="Редактировать"><i
                                                class="fa fa-pencil-square-o"></i></a></td>
                                <td class="text-center"><a href="/tag-manage/delete/<?php echo $tag['id']; ?>"
                                                           title="Удалить"><i
                                                class="fa fa-times"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                </div>
            </div>
        </section>
    </main>
    <!-- END Main container -->

<?php include ROOT . '/views/layouts/footer_main.php'; ?>