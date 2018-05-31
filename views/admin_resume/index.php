<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление резюме</li>
                    </ol>
                </div>

                <a href="/admin/resume/create" class="btn btn-default back"><i class="fa fa-plus"></i>Создать резюме</a>

                <h4>Список резюме</h4>

                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th class="text-center">ID резюме</th>
                        <th class="text-center">Имя пользователя</th>
                        <th class="text-center">Должность</th>
                        <th class="text-center">О себе</th>
                        <th class="text-center">Email</th>
                        <th></th>
                        <th></th>
                    </tr>

                    <?php foreach ($listResumes as $resume): ?>
                        <tr>
                            <td class="text-center"><?php echo $resume['id']; ?></td>
                            <td class="text-center"><?php echo $resume['name']; ?></td>
                            <td class="text-center"><?php echo $resume['headline']; ?></td>
                            <td><?php echo $resume['short_description']; ?></td>
                            <td class="text-center"><?php echo $resume['email_address']; ?></td>
                            <td class="text-center"><a href="/admin/resume/update/<?php echo $resume['id']; ?>"
                                                       title="Редактировать"><i class="fa fa-pencil-square-o"></i></a>
                            </td>
                            <td class="text-center"><a href="/admin/resume/delete/<?php echo $resume['id']; ?>"
                                                       title="Удалить"><i class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>