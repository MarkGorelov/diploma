<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Административная панель</a></li>
                        <li class="active">Управление компаниями</li>
                    </ol>
                </div>

                <a href="/admin/company/create" class="btn btn-gray"><i class="fa fa-plus"></i>Создать компанию</a>

                <h4>Список компаний</h4>

                <br/>

                <table class="table table-bordered table-striped ">
                    <tr>
                        <th class="text-center">ID компании</th>
                        <th class="text-center">ID пользователя</th>
                        <th class="text-center">ID категории</th>
                        <th class="text-center">Название компании</th>
                        <th class="text-center">Web-site компании</th>
                        <th class="text-center">Email компании</th>
                        <th class="text-center">Номер телефона</th>
                        <th class="text-center">Статус</th>
                        <th></th>
                        <th></th>
                    </tr>

                    <?php foreach ($companiesList as $company): ?>
                        <tr>
                            <td class="text-center"><?php echo $company['id']; ?></td>
                            <td class="text-center"><?php echo $company['user_id']; ?></td>
                            <td class="text-center"><?php echo $company['category_id']; ?></td>
                            <td class="text-center"><?php echo $company['company_name']; ?></td>
                            <td class="text-center"><?php echo $company['website_address']; ?></td>
                            <td class="text-center"><?php echo $company['email_address']; ?></td>
                            <td class="text-center"><?php echo $company['phone_number']; ?></td>
                            <td class="text-center"><?php echo AdminCompany::getStatusText($company['status']); ?></td>
                            <td class="text-center"><a href="/admin/company/update/<?php echo $company['id']; ?>"
                                                       title="Редактировать"><i
                                            class="fa fa-pencil-square-o"></i></a></td>
                            <td class="text-center"><a href="/admin/company/delete/<?php echo $company['id']; ?>"
                                                       title="Удалить"><i
                                            class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>