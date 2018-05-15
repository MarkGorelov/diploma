<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление образованием</li>
                </ol>
            </div>

            <a href="/admin/education/create" class="btn btn-default back"><i class="fa fa-plus"></i>Создать учебное учреждение</a>
            
            <h4>Список учебных учереждений</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID учебного учереждения</th>
                    <th>Название учебного учреждения</th>
                    <th>Краткое описание</th>
                    <th>Год начала и окончания обучения</th>
                    <th>Степень образования</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($listOfEducation as $education): ?>
                    <tr>
                        <td><?php echo $education['id']; ?></td>
                        <td><?php echo $education['school_name']; ?></td>
                        <td><?php echo $education['short_description']; ?></td>
                        <td><?php echo $education['date_of_education']; ?></td>
                        <td><?php echo $education['degree']; ?></td>
                        <td><a href="/admin/education/update/<?php echo $education['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/education/delete/<?php echo $education['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

