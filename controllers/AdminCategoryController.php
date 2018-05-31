<?php

class AdminCategoryController extends UserBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $categoriesList = AdminCategory::getCategoriesList();

        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            $errors = false;

            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                AdminCategory::createCategory($name, $sortOrder, $status);

                header("Location: /admin/category");
            }
        }
        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $category = AdminCategory::getCategoryById($id);

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            AdminCategory::updateCategoryById($id, $name, $sortOrder, $status);

            header("Location: /admin/category");
        }
        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            AdminCategory::deleteCategoryById($id);

            header("Location: /admin/category");
        }
        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }
}