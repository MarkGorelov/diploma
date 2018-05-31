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