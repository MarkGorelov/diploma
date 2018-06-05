<?php

class VacancyController extends UserBase
{
    public function actionIndex()
    {
        $latestVacancies = array();
        $latestVacancies = Vacancy::getLatestVacancy();

        $categories = array();
        $categories = AdminCategory::getCategoriesList();

        require_once(ROOT . '/views/vacancy/index.php');
        return true;
    }

    public function actionView($vacancyId)
    {
        $vacancy = Vacancy::getVacancyById($vacancyId);

        require_once(ROOT . '/views/vacancy/view.php');
        return true;
    }

    public function actionManage()
    {
        self::checkEmployer();

        $vacanciesUser = array();
        $vacanciesUser = Vacancy::getVacanciesByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/vacancy/manage.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkEmployer();

        $categoriesList = AdminCategory::getCategoriesList();

        $companiesList = Company::getCompaniesListByUser($userID = $_SESSION['user']);

        if (isset($_POST['submit'])) {
            $options['company_name'] = strip_tags($_POST['company_name']);
            $options['job_title'] = strip_tags($_POST['job_title']);
            $options['user_id'] = strip_tags($_POST['user_id']);
            $options['company_id'] = strip_tags($_POST['company_id']);
            $options['short_description'] = strip_tags($_POST['short_description']);
            $options['website_address'] = strip_tags($_POST['website_address']);
            $options['location'] = strip_tags($_POST['location']);
            $options['type_of_employment'] = strip_tags($_POST['type_of_employment']);
            $options['salary'] = strip_tags($_POST['salary']);
            $options['working'] = strip_tags($_POST['working']);
            $options['experince'] = strip_tags($_POST['experince']);
            $options['gender'] = strip_tags($_POST['gender']);
            $options['job_detail'] = strip_tags($_POST['job_detail']);
            $options['category_id'] = strip_tags($_POST['category_id']);
            $options['status'] = strip_tags($_POST['status']);

            $errors = false;

            if ($errors == false) {
                $id = Vacancy::createVacancy($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/vacancy/{$id}.jpg");
                    }
                };
                header("Location: /vacancy-manage/");
            }
        }
        require_once(ROOT . '/views/vacancy/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkEmployer();

        $categoriesList = AdminCategory::getCategoriesList();

        $companiesList = Company::getCompaniesListByUser($userID = $_SESSION['user']);
        $vacancy = Vacancy::getVacancyById($id);

        if (isset($_POST['submit'])) {
            $options['company_name'] = strip_tags($_POST['company_name']);
            $options['job_title'] = strip_tags($_POST['job_title']);
            $options['user_id'] = strip_tags($_POST['user_id']);
            $options['company_id'] = strip_tags($_POST['company_id']);
            $options['short_description'] = strip_tags($_POST['short_description']);
            $options['website_address'] = strip_tags($_POST['website_address']);
            $options['location'] = strip_tags($_POST['location']);
            $options['type_of_employment'] = strip_tags($_POST['type_of_employment']);
            $options['salary'] = strip_tags($_POST['salary']);
            $options['working'] = strip_tags($_POST['working']);
            $options['experince'] = strip_tags($_POST['experince']);
            $options['gender'] = strip_tags($_POST['gender']);
            $options['job_detail'] = strip_tags($_POST['job_detail']);
            $options['category_id'] = strip_tags($_POST['category_id']);
            $options['status'] = strip_tags($_POST['status']);

            if (Vacancy::updateVacancyById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/vacancy/{$id}.jpg");
                }
            }
            header("Location: /vacancy-manage/");
        }
        require_once(ROOT . '/views/vacancy/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkEmployer();

        if (isset($_POST['submit'])) {
            Vacancy::deleteVacancyById($id);

            header("Location: /vacancy-manage/");
        }
        require_once(ROOT . '/views/vacancy/delete.php');
        return true;
    }
}