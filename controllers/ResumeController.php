<?php

class ResumeController extends UserBase
{
    public function actionIndex($page = 1)
    {
        $latestResumes = array();
        $latestResumes = Resume::getLatestResume($page);

        $categories = array();
        $categories = AdminCategory::getCategoriesList();

        $total = Resume::getTotalResumesList();

        $pagination = new Pagination($total, $page, Resume::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/resume/index.php');
        return true;
    }

    public function actionView($resumeId)
    {
        $resume = Resume::getResumeById($resumeId);

        $tagsResume = array();
        $tagsResume = Tag::getTagsListByResume($resumeId);

        $educationResume = array();
        $educationResume = Education::getEducationsListByResume($resumeId);

        $workExperienceResume = array();
        $workExperienceResume = WorkExperience::getWorkExperienceListByResume($resumeId);

        require_once(ROOT . '/views/resume/view.php');
        return true;
    }

    public function actionManage()
    {
        self::checkAspirant();

        $resumesUser = array();
        $resumesUser = Resume::getResumesByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/resume/manage.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAspirant();

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

            if ($errors == false) {
                $id = Resume::createResume($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/resume/{$id}.jpg");
                    }
                };
                header("Location: /resume-manage/");
            }
        }
        require_once(ROOT . '/views/resume/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAspirant();

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

            if (Resume::updateResumeById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/resume/{$id}.jpg");
                }
            }
            header("Location: /resume-manage/");
        }
        require_once(ROOT . '/views/resume/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAspirant();

        if (isset($_POST['submit'])) {
            Resume::deleteResumeById($id);

            header("Location: /resume-manage/");
        }
        require_once(ROOT . '/views/resume/delete.php');
        return true;
    }
}