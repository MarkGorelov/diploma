<?php

class CompanyController extends UserBase
{
    public function actionView($companyId)
    {
        $company = Company::getCompanyById($companyId);

        $jobsCompany = array();
        $jobsCompany = Vacancy::getVacanciesListByCompany($companyId);

        require_once(ROOT . '/views/company/view.php');
        return true;
    }

    public function actionManage()
    {
        self::checkEmployer();

        $companiesUser = array();
        $companiesUser = Company::getCompaniesByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/company/manage.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkEmployer();

        $categoriesList = AdminCategory::getCategoriesList();

        if (isset($_POST['submit'])) {
            $options['company_name'] = strip_tags($_POST['company_name']);
            $options['user_id'] = strip_tags($_POST['user_id']);
            $options['category_id'] = strip_tags($_POST['category_id']);
            $options['headline'] = strip_tags($_POST['headline']);
            $options['short_description'] = strip_tags($_POST['short_description']);
            $options['location'] = strip_tags($_POST['location']);
            $options['founded'] = strip_tags($_POST['founded']);
            $options['employees'] = strip_tags($_POST['employees']);
            $options['website_address'] = strip_tags($_POST['website_address']);
            $options['phone_number'] = strip_tags($_POST['phone_number']);
            $options['email_address'] = strip_tags($_POST['email_address']);
            $options['company_detail'] = strip_tags($_POST['company_detail']);
            $options['status'] = strip_tags($_POST['status']);

            $errors = false;

            if (!isset($options['company_name']) || empty($options['company_name'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['headline']) || empty($options['headline'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['short_description']) || empty($options['short_description'])) {
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
            if (!isset($options['website_address']) || empty($options['website_address'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['phone_number']) || empty($options['phone_number'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['email_address']) || empty($options['email_address'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = Company::createCompany($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/company/{$id}.jpg");
                    }
                };
                header("Location: /company-manage/");
            }
        }
        require_once(ROOT . '/views/company/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkEmployer();

        $categoriesList = AdminCategory::getCategoriesList();
        $company = Company::getCompanyById($id);

        if (isset($_POST['submit'])) {
            $options['company_name'] = strip_tags($_POST['company_name']);
            $options['user_id'] = strip_tags($_POST['user_id']);
            $options['category_id'] = strip_tags($_POST['category_id']);
            $options['headline'] = strip_tags($_POST['headline']);
            $options['short_description'] = strip_tags($_POST['short_description']);
            $options['location'] = strip_tags($_POST['location']);
            $options['founded'] = strip_tags($_POST['founded']);
            $options['employees'] = strip_tags($_POST['employees']);
            $options['website_address'] = strip_tags($_POST['website_address']);
            $options['phone_number'] = strip_tags($_POST['phone_number']);
            $options['email_address'] = strip_tags($_POST['email_address']);
            $options['company_detail'] = strip_tags($_POST['company_detail']);
            $options['status'] = strip_tags($_POST['status']);

            if (Company::updateCompanyById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/company/{$id}.jpg");
                }
            }
            header("Location: /company-manage/");
        }
        require_once(ROOT . '/views/company/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkEmployer();

        if (isset($_POST['submit'])) {
            Company::deleteCompanyById($id);

            header("Location: /company-manage/");
        }
        require_once(ROOT . '/views/company/delete.php');
        return true;
    }
}