<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 17:30
 */

class AdminEducationController extends AdminBase
{
    /**
     * Action для страницы "Управление образования"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список вакнсий
        $listOfEducation = Education::getEducationList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_education/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить образование"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['degree'] = $_POST['degree'];
            $options['branch'] = $_POST['branch'];
            $options['school_name'] = $_POST['school_name'];
            $options['date_of_education'] = $_POST['date_of_education'];
            $options['short_description'] = $_POST['short_description'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['school_name']) || empty($options['school_name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую вакансию
                $id = Education::createEducation($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/education/{$id}.jpg");
                    }
                };

                // Перенаправляем пользователя на страницу управлениями образованием
                header("Location: /admin/education");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_education/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать образование"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $education = Education::getEducationById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['degree'] = $_POST['degree'];
            $options['branch'] = $_POST['branch'];
            $options['school_name'] = $_POST['school_name'];
            $options['date_of_education'] = $_POST['date_of_education'];
            $options['short_description'] = $_POST['short_description'];
            $options['status'] = $_POST['status'];

            // Сохраняем изменения
            if (Education::updateEducationById($id, $options)) {

                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {

                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/education/{$id}.jpg");
                }
            }

            // Перенаправляем пользователя на страницу управлениями образованием
            header("Location: /admin/education");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_education/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить образование"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем образование
            Education::deleteEducationById($id);

            // Перенаправляем пользователя на страницу управлениями образованием
            header("Location: /admin/education");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_education/delete.php');
        return true;
    }
}