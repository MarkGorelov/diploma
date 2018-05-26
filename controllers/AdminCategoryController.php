<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 14.05.2018
 * Time: 18:58
 */

/**
 * Контроллер AdminCategoryController
 * Страницы управления категориями в административной панели
 */
class AdminCategoryController extends UserBase
{
    /**
     * Action для страницы "Управление категориями"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий
        $categoriesList = AdminCategory::getCategoriesList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить категорию"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую категорию
                AdminCategory::createCategory($name, $sortOrder, $status);

                // Перенаправляем администратора на страницу управлениями категориями
                header("Location: /admin/category");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать категорию"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретной категории
        $category = AdminCategory::getCategoryById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // Сохраняем изменения
            AdminCategory::updateCategoryById($id, $name, $sortOrder, $status);

            // Перенаправляем администратора на страницу управлениями категориями
            header("Location: /admin/category");
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить категорию"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем категорию
            AdminCategory::deleteCategoryById($id);

            // Перенаправляем администратора на страницу управлениями товарами
            header("Location: /admin/category");
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }
}