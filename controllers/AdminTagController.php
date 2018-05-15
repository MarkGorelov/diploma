<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 19:06
 */

class AdminTagController extends AdminBase
{
    /**
     * Action для страницы "Управление тегами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список тегов
        $tagsList = Tag::getTagList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_tag/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить тег"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую вакансию
                $id = Tag::createTag($options);

                // Перенаправляем пользователя на страницу управлениями тегами
                header("Location: /admin/tag");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_tag/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать тег"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $tag = Tag::getTagById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['name'] = $_POST['name'];
            $options['status'] = $_POST['status'];

            // Перенаправляем пользователя на страницу управлениями тегами
            header("Location: /admin/tag");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_tag/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить тег"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем опыт работы
            Tag::deleteTagById($id);

            // Перенаправляем пользователя на страницу управлениями тегами
            header("Location: /admin/tag");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_tag/delete.php');
        return true;
    }
}