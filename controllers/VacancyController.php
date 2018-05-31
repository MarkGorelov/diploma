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
            $options['company_name'] = $_POST['company_name'];
            $options['job_title'] = $_POST['job_title'];
            $options['user_id'] = $_POST['user_id'];
            $options['company_id'] = $_POST['company_id'];
            $options['short_description'] = $_POST['short_description'];
            $options['website_address'] = $_POST['website_address'];
            $options['location'] = $_POST['location'];
            $options['type_of_employment'] = $_POST['type_of_employment'];
            $options['salary'] = $_POST['salary'];
            $options['working'] = $_POST['working'];
            $options['experince'] = $_POST['experince'];
            $options['gender'] = $_POST['gender'];
            $options['job_detail'] = $_POST['job_detail'];
            $options['category_id'] = $_POST['category_id'];
            $options['status'] = $_POST['status'];

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
            $options['company_name'] = $_POST['company_name'];
            $options['job_title'] = $_POST['job_title'];
            $options['user_id'] = $_POST['user_id'];
            $options['company_id'] = $_POST['company_id'];
            $options['short_description'] = $_POST['short_description'];
            $options['website_address'] = $_POST['website_address'];
            $options['location'] = $_POST['location'];
            $options['type_of_employment'] = $_POST['type_of_employment'];
            $options['salary'] = $_POST['salary'];
            $options['working'] = $_POST['working'];
            $options['experince'] = $_POST['experince'];
            $options['gender'] = $_POST['gender'];
            $options['job_detail'] = $_POST['job_detail'];
            $options['category_id'] = $_POST['category_id'];
            $options['status'] = $_POST['status'];

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