<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление пользователями</li>
                </ol>
            </div>

            <a href="/admin/user/create" class="btn btn-default back"><i class="fa fa-plus"></i>Добавить пользователя</a>

            <h4>Список пользователей</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID пользователя</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Тип пользователя</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($usersList as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td><a href="/admin/user/update/<?php echo $user['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/user/delete/<?php echo $user['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

