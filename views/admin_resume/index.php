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
                    <th>ID резюме</th>
                    <th>Имя пользователя</th>
                    <th>Должность</th>
                    <th>О себе</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($resumesList as $resume): ?>
                    <tr>
                        <td><?php echo $resume['id']; ?></td>
                        <td><?php echo $resume['name']; ?></td>
                        <td><?php echo $resume['headline']; ?></td>
                        <td><?php echo $resume['short_description']; ?></td>
                        <td><?php echo $resume['email_address']; ?></td>
                        <td><a href="/admin/resume/update/<?php echo $resume['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/resume/delete/<?php echo $resume['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

