<?php

class AdminTagController extends UserBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $tagsList = AdminTag::getTagsList();

        require_once(ROOT . '/views/admin_tag/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

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
                $id = AdminTag::createTag($options);

                header("Location: /admin/tag");
            }
        }
        require_once(ROOT . '/views/admin_tag/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $tag = AdminTag::getTagById($id);

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['status'] = $_POST['status'];

            AdminTag::updateTagById($id, $options);

            header("Location: /admin/tag");
        }
        require_once(ROOT . '/views/admin_tag/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            AdminTag::deleteTagById($id);

            header("Location: /admin/tag");
        }
        require_once(ROOT . '/views/admin_tag/delete.php');
        return true;
    }
}