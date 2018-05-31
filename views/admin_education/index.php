<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление учебными учреждениями</li>
                    </ol>
                </div>

                <a href="/admin/education/create" class="btn btn-default back"><i class="fa fa-plus"></i>Создать учебное
                    учреждение</a>

                <h4>Список учебных учреждений</h4>

                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th class="text-center">ID учебного учереждения</th>
                        <th class="text-center">Название учебного учреждения</th>
                        <th class="text-center">Краткое описание</th>
                        <th class="text-center">Год начала и окончания обучения</th>
                        <th class="text-center">Степень образования</th>
                        <th></th>
                        <th></th>
                    </tr>

                    <?php foreach ($listOfEducations as $education): ?>
                        <tr>
                            <td class="text-center"><?php echo $education['id']; ?></td>
                            <td class="text-center"><?php echo $education['school_name']; ?></td>
                            <td><?php echo $education['short_description']; ?></td>
                            <td class="text-center"><?php echo $education['date_of_education']; ?></td>
                            <td class="text-center"><?php echo $education['degree']; ?></td>
                            <td class="text-center"><a href="/admin/education/update/<?php echo $education['id']; ?>"
                                                       title="Редактировать"><i class="fa fa-pencil-square-o"></i></a>
                            </td>
                            <td class="text-center"><a href="/admin/education/delete/<?php echo $education['id']; ?>"
                                                       title="Удалить"><i class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>