<?php

class AdminResumeController extends UserBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $listResumes = AdminResume::getListResumes();

        require_once(ROOT . '/views/admin_resume/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        $categoriesList = AdminCategory::getCategoriesList();

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['headline'] = $_POST['headline'];
            $options['short_description'] = $_POST['short_description'];
            $options['location'] = $_POST['location'];
            $options['website_address'] = $_POST['website_address'];
            $options['salary'] = $_POST['salary'];
            $options['age'] = $_POST['age'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['email_address'] = $_POST['email_address'];
            $options['gender'] = $_POST['gender'];
            $options['category_id'] = $_POST['category_id'];
            $options['user_id'] = $_POST['user_id'];
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
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
            if (!isset($options['website_address']) || empty($options['website_address'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['salary']) || empty($options['salary'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['age']) || empty($options['age'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = AdminResume::createResume($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/resume/{$id}.jpg");
                    }
                };
                header("Location: /admin/resume");
            }
        }
        require_once(ROOT . '/views/admin_resume/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $categoriesList = AdminCategory::getCategoriesList();

        $resume = Resume::getResumeById($id);

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['headline'] = $_POST['headline'];
            $options['short_description'] = $_POST['short_description'];
            $options['location'] = $_POST['location'];
            $options['website_address'] = $_POST['website_address'];
            $options['salary'] = $_POST['salary'];
            $options['age'] = $_POST['age'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['email_address'] = $_POST['email_address'];
            $options['gender'] = $_POST['gender'];
            $options['category_id'] = $_POST['category_id'];
            $options['user_id'] = $_POST['user_id'];
            $options['status'] = $_POST['status'];

            if (AdminResume::updateResumeById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/resume/{$id}.jpg");
                }
            }
            header("Location: /admin/resume");
        }
        require_once(ROOT . '/views/admin_resume/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            AdminResume::deleteResumeById($id);

            header("Location: /admin/resume");
        }
        require_once(ROOT . '/views/admin_resume/delete.php');
        return true;
    }
}