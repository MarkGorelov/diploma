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

                <a href="/admin/work-experience/create" class="btn btn-default back"><i class="fa fa-plus"></i>Создать
                    опыт работы</a>

                <h4>Список опыта работы</h4>

                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th class="text-center">ID опыта работы</th>
                        <th class="text-center">Название компании</th>
                        <th class="text-center">Должность на которой работали</th>
                        <th class="text-center">Год начала и заверщения карьеры</th>
                        <th class="text-center">Краткое описание вашей деятельности в данной компании</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($listOfWorkExperiences as $workExperience): ?>
                        <tr>
                            <td class="text-center"><?php echo $workExperience['id']; ?></td>
                            <td class="text-center"><?php echo $workExperience['company_name']; ?></td>
                            <td class="text-center"><?php echo $workExperience['position']; ?></td>
                            <td class="text-center"><?php echo $workExperience['date_of_experience']; ?></td>
                            <td><?php echo $workExperience['short_description']; ?></td>
                            <td class="text-center"><a
                                        href="/admin/work-experience/update/<?php echo $workExperience['id']; ?>"
                                        title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td class="text-center"><a
                                        href="/admin/work-experience/delete/<?php echo $workExperience['id']; ?>"
                                        title="Удалить"><i class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>