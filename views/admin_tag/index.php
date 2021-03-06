<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление опытом работы</li>
                    </ol>
                </div>

                <a href="/admin/tag/create" class="btn btn-default back"><i class="fa fa-plus"></i>Создать тег</a>

                <h4>Список тегов</h4>

                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th class="text-center">ID тега</th>
                        <th class="text-center">Название тега</th>
                        <th class="text-center">Статус</th>
                        <th></th>
                        <th></th>
                    </tr>

                    <?php foreach ($tagsList as $tag): ?>
                        <tr>
                            <td class="text-center"><?php echo $tag['id']; ?></td>
                            <td class="text-center"><?php echo $tag['name']; ?></td>
                            <td class="text-center"><?php echo $tag['status']; ?></td>
                            <td class="text-center"><a href="/admin/tag/update/<?php echo $tag['id']; ?>"
                                                       title="Редактировать"><i
                                            class="fa fa-pencil-square-o"></i></a></td>
                            <td class="text-center"><a href="/admin/tag/delete/<?php echo $tag['id']; ?>"
                                                       title="Удалить"><i
                                            class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>