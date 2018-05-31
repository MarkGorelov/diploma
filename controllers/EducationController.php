<?php

class EducationController extends UserBase
{
    public function actionManage()
    {
        self::checkAspirant();

        $educationsUser = array();
        $educationsUser = Education::getEducationsByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/education/manage.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAspirant();

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
                $id = Education::createEducation($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/education/{$id}.jpg");
                    }
                };
                header("Location: /education-manage/");
            }
        }
        require_once(ROOT . '/views/education/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAspirant();

        $education = Education::getEducationById($id);

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

            if (Education::updateEducationById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/education/{$id}.jpg");
                }
            }
            header("Location: /education-manage/");
        }
        require_once(ROOT . '/views/education/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAspirant();

        if (isset($_POST['submit'])) {
            Education::deleteEducationById($id);

            header("Location: /education-manage/");
        }
        require_once(ROOT . '/views/education/delete.php');
        return true;
    }
}