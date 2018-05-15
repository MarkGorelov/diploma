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

            <a href="/admin/work-experience/create" class="btn btn-default back"><i class="fa fa-plus"></i>Создать опыт работы</a>
            
            <h4>Список опыта работы</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID опыта работы</th>
                    <th>Название компании</th>
                    <th>Должность на которой работали</th>
                    <th>Год начала и заверщения карьеры</th>
                    <th>Краткое описание вашей деятельности в данной компании</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($listOfWorkExperience as $workExperience): ?>
                    <tr>
                        <td><?php echo $workExperience['id']; ?></td>
                        <td><?php echo $workExperience['company_name']; ?></td>
                        <td><?php echo $workExperience['position']; ?></td>
                        <td><?php echo $workExperience['date_of_experience']; ?></td>
                        <td><?php echo $workExperience['short_description']; ?></td>
                        <td><a href="/admin/work-experience/update/<?php echo $workExperience['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/work-experience/delete/<?php echo $workExperience['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

