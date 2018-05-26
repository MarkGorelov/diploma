<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 17:30
 */

/**
 * Контроллер AdminEducationController
 */
class AdminEducationController extends UserBase
{
    /**
     * Action для страницы "Управление  информацией об учебных учреждениях пользователя"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список учебных учреждений
        $listOfEducations = AdminEducation::getListOfEducations();

        // Подключаем вид
        require_once(ROOT . '/views/admin_education/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить новое учебное учреждение"
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
                $id = AdminEducation::createEducation($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/education/{$id}.jpg");
                    }
                };
                // Перенаправляем администартора на страницу управлениями учебным учреждением
                header("Location: /admin/education");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_education/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать учебное учреждение"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном учебном учреждение
        $education = AdminEducation::getEducationById($id);

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
            if (AdminEducation::updateEducationById($id, $options)) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/education/{$id}.jpg");
                }
            }
            // Перенаправляем администартора на страницу управлениями учебным учреждением
            header("Location: /admin/education");
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_education/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить учебное учреждение"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем учебное учреждение
            AdminEducation::deleteEducationById($id);

            // Перенаправляем администартора на страницу управлениями учебным учреждением
            header("Location: /admin/education");
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_education/delete.php');
        return true;
    }
}