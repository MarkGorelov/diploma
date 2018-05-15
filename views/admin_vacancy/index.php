<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление вакансиями</li>
                </ol>
            </div>

            <a href="/admin/vacancy/create" class="btn btn-default back"><i class="fa fa-plus"></i>Создать вакансию</a>
            
            <h4>Список вакансий</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID вакансии</th>
                    <th>Название компании</th>
                    <th>Должность</th>
                    <th>Сайт компании</th>
                    <th>О работе</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($vacanciesList as $vacancy): ?>
                    <tr>
                        <td><?php echo $vacancy['id']; ?></td>
                        <td><?php echo $vacancy['company_name']; ?></td>
                        <td><?php echo $vacancy['job_title']; ?></td>
                        <td><?php echo $vacancy['website_address']; ?></td>
                        <td><?php echo $vacancy['job_detail']; ?></td>
                        <td><a href="/admin/vacancy/update/<?php echo $vacancy['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/vacancy/delete/<?php echo $vacancy['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

