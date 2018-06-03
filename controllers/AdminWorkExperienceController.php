<?php

class AdminWorkExperienceController extends UserBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $listOfWorkExperiences = AdminWorkExperience::getListOfWorkExperiences();

        require_once(ROOT . '/views/admin_work_experience/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        $resumesList = Resume::getResumesByUser($userID = $_SESSION['user']);

        if (isset($_POST['submit'])) {
            $options['company_name'] = $_POST['company_name'];
            $options['position'] = $_POST['position'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
            $options['date_of_experience'] = $_POST['date_of_experience'];
            $options['short_description'] = $_POST['short_description'];
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['company_name']) || empty($options['company_name'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['position']) || empty($options['position'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['date_of_experience']) || empty($options['date_of_experience'])) {
                $errors[] = 'Заполните поля';
            }
            if (!isset($options['short_description']) || empty($options['short_description'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = AdminWorkExperience::createWorkExperience($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/work_experience/{$id}.jpg");
                    }
                };
                header("Location: /admin/work-experience");
            }
        }
        require_once(ROOT . '/views/admin_work_experience/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $workExperience = AdminWorkExperience::getWorkExperienceById($id);

        if (isset($_POST['submit'])) {
            $options['company_name'] = $_POST['company_name'];
            $options['position'] = $_POST['position'];
            $options['date_of_experience'] = $_POST['date_of_experience'];
            $options['short_description'] = $_POST['short_description'];
            $options['status'] = $_POST['status'];

            if (AdminWorkExperience::updateWorkExperienceById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/work_experience/{$id}.jpg");
                }
            }
            header("Location: /admin/work-experience");
        }
        require_once(ROOT . '/views/admin_work_experience/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            AdminWorkExperience::deleteWorkExperienceById($id);

            header("Location: /admin/work-experience");
        }
        require_once(ROOT . '/views/admin_work_experience/delete.php');
        return true;
    }
}