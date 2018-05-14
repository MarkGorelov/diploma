<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 14.05.2018
 * Time: 17:30
 */

class AdminUserController extends AdminBase
{
    /**
     * Action для страницы "Управление пользователями"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список товаров
        $usersList = User::getUsersList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_user/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить пользователя"
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
            $options['email'] = $_POST['email'];
            $options['password'] = $_POST['password'];
            $options['role'] = $_POST['role'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем нового пользователя
                $id = User::createUser($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/user/{$id}.jpg");
                    }
                };

                // Перенаправляем пользователя на страницу управлениями пользователями
                header("Location: /admin/user");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_user/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать данные пользователя"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном пользователе
        $user = User::getUserById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['name'] = $_POST['name'];
            $options['email'] = $_POST['email'];
            $options['password'] = $_POST['password'];
            $options['role'] = $_POST['role'];

            // Сохраняем изменения
            if (User::updateUserById($id, $options)) {

                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {

                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/user/{$id}.jpg");
                }
            }

            // Перенаправляем администартора на страницу управлениями пользователями
            header("Location: /admin/user");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_user/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить пользователя"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем товар
            User::deleteUserById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/user");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_user/delete.php');
        return true;
    }
}