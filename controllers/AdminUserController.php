<?php

class AdminUserController extends UserBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $usersList = User::getUsersList();

        require_once(ROOT . '/views/admin_user/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['email'] = $_POST['email'];
            $options['password'] = $_POST['password'];
            $options['role'] = $_POST['role'];

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = User::createUser($options);

                header("Location: /admin/user");
            }
        }
        require_once(ROOT . '/views/admin_user/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $user = User::getUserById($id);

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['email'] = $_POST['email'];
            $options['password'] = $_POST['password'];
            $options['role'] = $_POST['role'];

            if (User::updateUserById($id, $options)) {
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/user/{$id}.jpg");
                }
            }
            header("Location: /admin/user");
        }
        require_once(ROOT . '/views/admin_user/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            User::deleteUserById($id);

            header("Location: /admin/user");
        }
        require_once(ROOT . '/views/admin_user/delete.php');
        return true;
    }
}