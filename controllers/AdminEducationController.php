<?php

class AdminEducationController extends UserBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $listOfEducations = AdminEducation::getListOfEducations();

        require_once(ROOT . '/views/admin_education/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        $resumesList = Resume::getResumesByUser($userID = $_SESSION['user']);

        if (isset($_POST['submit'])) {
            $options['degree'] = $_POST['degree'];
            $options['branch'] = $_POST['branch'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
            $options['school_name'] = $_POST['school_name'];
            $options['date_of_education'] = $_POST['date_of_education'];
            $options['short_description'] = $_POST['short_description'];
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['school_name']) || empty($options['school_name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = AdminEducation::createEducation($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/education/{$id}.jpg");
                    }
                };
                header("Location: /admin/education");
            }
        }
        require_once(ROOT . '/views/admin_education/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $education = AdminEducation::getEducationById($id);

        if (isset($_POST['submit'])) {
            $options['degree'] = $_POST['degree'];
            $options['branch'] = $_POST['branch'];
            $options['school_name'] = $_POST['school_name'];
            $options['date_of_education'] = $_POST['date_of_education'];
            $options['short_description'] = $_POST['short_description'];
            $options['status'] = $_POST['status'];

            if (AdminEducation::updateEducationById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/education/{$id}.jpg");
                }
            }
            header("Location: /admin/education");
        }
        require_once(ROOT . '/views/admin_education/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            AdminEducation::deleteEducationById($id);

            header("Location: /admin/education");
        }
        require_once(ROOT . '/views/admin_education/delete.php');
        return true;
    }
}