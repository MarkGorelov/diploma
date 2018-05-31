<?php

class TagController extends UserBase
{
    public function actionManage()
    {
        self::checkAspirant();

        $tagsUser = array();
        $tagsUser = Tag::getTagsByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/tag/manage.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAspirant();

        $resumesList = Resume::getResumesByUser($userID = $_SESSION['user']);

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                Tag::createTag($options);

                header("Location: /tag-manage/");
            }
        }
        require_once(ROOT . '/views/tag/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAspirant();

        $tag = Tag::getTagById($id);

        $resumesList = Resume::getResumesByUser($userID = $_SESSION['user']);

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
            $options['status'] = $_POST['status'];

            Tag::updateTagById($id, $options);

            header("Location: /tag-manage/");
        }
        require_once(ROOT . '/views/tag/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAspirant();

        if (isset($_POST['submit'])) {
            $tag = Tag::deleteTagById($id);

            header("Location: /tag-manage/");
        }
        require_once(ROOT . '/views/tag/delete.php');
        return true;
    }
}