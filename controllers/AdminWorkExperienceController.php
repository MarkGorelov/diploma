<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 18:35
 */

class AdminWorkExperienceController extends AdminBase
{
    /**
     * Action для страницы "Управление опытом работы"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список вакнсий
        $listOfWorkExperience = WorkExperience::getWorkExperienceList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_work_experience/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить опыт работы"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['company_name'] = $_POST['company_name'];
            $options['position'] = $_POST['position'];
            $options['date_of_experience'] = $_POST['date_of_experience'];
            $options['short_description'] = $_POST['short_description'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['company_name']) || empty($options['company_name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую вакансию
                $id = WorkExperience::createWorkExperience($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/work_experience/{$id}.jpg");
                    }
                };

                // Перенаправляем пользователя на страницу управлениями опытом работы
                header("Location: /admin/work-experience");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_work_experience/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать опыт работы"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $workExperience = WorkExperience::getWorkExperienceById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['company_name'] = $_POST['company_name'];
            $options['position'] = $_POST['position'];
            $options['date_of_experience'] = $_POST['date_of_experience'];
            $options['short_description'] = $_POST['short_description'];
            $options['status'] = $_POST['status'];

            // Сохраняем изменения
            if (WorkExperience::updateWorkExperienceById($id, $options)) {

                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {

                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/work_experience/{$id}.jpg");
                }
            }

            // Перенаправляем пользователя на страницу управлениями образованием
            header("Location: /admin/work-experience");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_work_experience/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить опыт работы"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем опыт работы
            WorkExperience::deleteWorkExperienceById($id);

            // Перенаправляем пользователя на страницу управлениями опытом работы
            header("Location: /admin/work-experience");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_work_experience/delete.php');
        return true;
    }
}