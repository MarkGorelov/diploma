<?php

class AdminVacancyController extends UserBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $vacanciesList = AdminVacancy::getVacanciesList();

        require_once(ROOT . '/views/admin_vacancy/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        $categoriesList = AdminCategory::getCategoriesList();
        $companiesList = AdminCompany::getCompaniesList();

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

            if (!isset($options['company_name']) || empty($options['company_name'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['job_title']) || empty($options['job_title'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['short_description']) || empty($options['short_description'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['website_address']) || empty($options['website_address'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['location']) || empty($options['location'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['salary']) || empty($options['salary'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['working']) || empty($options['working'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['experince']) || empty($options['experince'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['gender']) || empty($options['gender'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = AdminVacancy::createVacancy($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/vacancy/{$id}.jpg");
                    }
                };
                header("Location: /admin/vacancy");
            }
        }
        require_once(ROOT . '/views/admin_vacancy/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $categoriesList = AdminCategory::getCategoriesList();
        $companiesList = AdminCompany::getCompaniesList();

        $vacancy = AdminVacancy::getVacancyById($id);

        if (isset($_POST['submit'])) {
            $options['company_name'] = $_POST['company_name'];
            $options['job_title'] = $_POST['job_title'];
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

            if (AdminVacancy::updateVacancyById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/vacancy/{$id}.jpg");
                }
            }
            header("Location: /admin/vacancy");
        }
        require_once(ROOT . '/views/admin_vacancy/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            AdminVacancy::deleteVacancyById($id);

            header("Location: /admin/vacancy");
        }
        require_once(ROOT . '/views/admin_vacancy/delete.php');
        return true;
    }
}