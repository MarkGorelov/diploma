<?php

class WorkExperienceController extends UserBase
{
    public function actionManage()
    {
        self::checkAspirant();

        $workExperienceUser = array();
        $workExperienceUser = WorkExperience::getWorkExperienceByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/work_experience/manage.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAspirant();

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

            if ($errors == false) {
                $id = WorkExperience::createWorkExperience($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/work_experience/{$id}.jpg");
                    }
                };
                header("Location: /work-experience-manage/");
            }
        }
        require_once(ROOT . '/views/work_experience/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAspirant();

        $workExperience = WorkExperience::getWorkExperienceById($id);

        $resumesList = Resume::getResumesByUser($userID = $_SESSION['user']);

        if (isset($_POST['submit'])) {
            $options['company_name'] = $_POST['company_name'];
            $options['position'] = $_POST['position'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
            $options['date_of_experience'] = $_POST['date_of_experience'];
            $options['short_description'] = $_POST['short_description'];
            $options['status'] = $_POST['status'];

            if (WorkExperience::updateWorkExperienceById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/work_experience/{$id}.jpg");
                }
            }
            header("Location: /work-experience-manage/");
        }
        require_once(ROOT . '/views/work_experience/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAspirant();

        if (isset($_POST['submit'])) {
            WorkExperience::deleteWorkExperienceById($id);

            header("Location: /work-experience-manage/");
        }
        require_once(ROOT . '/views/work_experience/delete.php');
        return true;
    }
}