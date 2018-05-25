<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 25.05.2018
 * Time: 19:40
 */

class EducationController extends UserBase
{

    public function actionManage()
    {
        // проверка доступа
        self::checkAspirant();

        // получаем список компаний пользователя
        $educationsUser = array();
        $educationsUser = Education::getEducationsByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/education/manage.php');
        return true;
    }

    /**
     * Action для страницы "Добавить новое учебное учреждение"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAspirant();

        $resumesList = Resume::getResumesByUser($userID = $_SESSION['user']);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['degree'] = $_POST['degree'];
            $options['branch'] = $_POST['branch'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
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
                // Перенаправляем администартора на страницу управлениями учебным учреждением
                header("Location: /education-manage/");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/education/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать учебное учреждение"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAspirant();

        // Получаем данные о конкретном учебном учреждение
        $education = Education::getEducationById($id);

        $resumesList = Resume::getResumesByUser($userID = $_SESSION['user']);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['degree'] = $_POST['degree'];
            $options['branch'] = $_POST['branch'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
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
            // Перенаправляем администартора на страницу управлениями учебным учреждением
            header("Location: /education-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/education/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить учебное учреждение"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAspirant();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем учебное учреждение
            Education::deleteEducationById($id);

            // Перенаправляем администартора на страницу управлениями учебным учреждением
            header("Location: /education-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/education/delete.php');
        return true;
    }
}