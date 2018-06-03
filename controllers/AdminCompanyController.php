<?php

class AdminCompanyController extends UserBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $companiesList = AdminCompany::getCompaniesList();

        require_once(ROOT . '/views/admin_company/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        $categoriesList = AdminCategory::getCategoriesList();

        if (isset($_POST['submit'])) {
            $options['company_name'] = $_POST['company_name'];
            $options['user_id'] = $_POST['user_id'];
            $options['category_id'] = $_POST['category_id'];
            $options['headline'] = $_POST['headline'];
            $options['short_description'] = $_POST['short_description'];
            $options['location'] = $_POST['location'];
            $options['founded'] = $_POST['founded'];
            $options['employees'] = $_POST['employees'];
            $options['website_address'] = $_POST['website_address'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['email_address'] = $_POST['email_address'];
            $options['company_detail'] = $_POST['company_detail'];
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['company_name']) || empty($options['company_name'])) {
                $errors[] = 'Заполните поля';
            }

            if (!isset($options['headline']) || empty($options['headline'])) {
                $errors[] = 'Заполните поля';
            }

            if (!isset($options['location']) || empty($options['location'])) {
                $errors[] = 'Заполните поля';
            }

            if (!isset($options['founded']) || empty($options['founded'])) {
                $errors[] = 'Заполните поля';
            }

            if (!isset($options['employees']) || empty($options['employees'])) {
                $errors[] = 'Заполните поля';
            }

            if (!isset($options['phone_number']) || empty($options['phone_number'])) {
                $errors[] = 'Заполните поля';
            }

            if (!isset($options['email_address']) || empty($options['email_address'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = AdminCompany::createCompany($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/company/{$id}.jpg");
                    }
                };
                header("Location: /admin/company");
            }
        }
        require_once(ROOT . '/views/admin_company/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $categoriesList = AdminCategory::getCategoriesList();
        $company = AdminCompany::getCompanyById($id);

        if (isset($_POST['submit'])) {
            $options['company_name'] = $_POST['company_name'];
            $options['category_id'] = $_POST['category_id'];
            $options['headline'] = $_POST['headline'];
            $options['short_description'] = $_POST['short_description'];
            $options['location'] = $_POST['location'];
            $options['founded'] = $_POST['founded'];
            $options['employees'] = $_POST['employees'];
            $options['website_address'] = $_POST['website_address'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['email_address'] = $_POST['email_address'];
            $options['company_detail'] = $_POST['company_detail'];
            $options['status'] = $_POST['status'];

            if (AdminCompany::updateCompanyById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/company/{$id}.jpg");
                }
            }
            header("Location: /admin/company");
        }
        require_once(ROOT . '/views/admin_company/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            AdminCompany::deleteCompanyById($id);

            header("Location: /admin/company");
        }
        require_once(ROOT . '/views/admin_company/delete.php');
        return true;
    }
}