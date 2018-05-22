<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление категориями</li>
                    </ol>
                </div>

                <a href="/admin/category/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить
                    категорию</a>

                <h4>Список категорий</h4>

                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th class="text-center">ID категории</th>
                        <th class="text-center">Название категории</th>
                        <th class="text-center">Порядковый номер</th>
                        <th class="text-center">Статус</th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                    </tr>
                    <?php foreach ($categoriesList as $category): ?>
                        <tr>
                            <td class="text-center"><?php echo $category['id']; ?></td>
                            <td><?php echo $category['name']; ?></td>
                            <td class="text-center"><?php echo $category['sort_order']; ?></td>
                            <td class="text-center"><?php echo AdminCategory::getStatusText($category['status']); ?></td>
                            <td class="text-center"><a href="/admin/category/update/<?php echo $category['id']; ?>"
                                                       title="Редактировать"><i
                                            class="fa fa-pencil-square-o"></i></a></td>
                            <td class="text-center"><a href="/admin/category/delete/<?php echo $category['id']; ?>"
                                                       title="Удалить"><i
                                            class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>