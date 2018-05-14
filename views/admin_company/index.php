<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление компаниями</li>
                </ol>
            </div>

            <a href="/admin/company/create" class="btn btn-default back"><i class="fa fa-plus"></i> Зарегистрировать компанию</a>
            
            <h4>Список компаний</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID компании</th>
                    <th>Название компании</th>
                    <th>website компании</th>
                    <th>Номер телефона</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($companiesList as $company): ?>
                    <tr>
                        <td><?php echo $company['id']; ?></td>
                        <td><?php echo $company['company_name']; ?></td>
                        <td><?php echo $company['website_address']; ?></td>
                        <td><?php echo $company['phone_number']; ?></td>
                        <td><?php echo $company['email_address']; ?></td>
                        <td><a href="/admin/company/update/<?php echo $company['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/company/delete/<?php echo $company['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
