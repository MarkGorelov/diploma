<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 25.05.2018
 * Time: 21:46
 */

class WorkExperienceController extends UserBase
{
    public function actionManage()
    {
        // проверка доступа
        self::checkAspirant();

        // получаем список компаний пользователя
        $workExperienceUser = array();
        $workExperienceUser = WorkExperience::getWorkExperienceByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/work_experience/manage.php');
        return true;
    }

    /**
     * Action для страницы "Добавить новый опыт работы"
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
            $options['company_name'] = $_POST['company_name'];
            $options['position'] = $_POST['position'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
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
                // Перенаправляем администартора на страницу управлениями учебным учреждением
                header("Location: /work-experience-manage/");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/work_experience/create.php');
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
        $workExperience = WorkExperience::getWorkExperienceById($id);

        $resumesList = Resume::getResumesByUser($userID = $_SESSION['user']);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['company_name'] = $_POST['company_name'];
            $options['position'] = $_POST['position'];
            $options['user_id'] = $_POST['user_id'];
            $options['resume_id'] = $_POST['resume_id'];
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
            // Перенаправляем администартора на страницу управлениями учебным учреждением
            header("Location: /work-experience-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/work_experience/update.php');
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
            WorkExperience::deleteWorkExperienceById($id);

            // Перенаправляем администартора на страницу управлениями учебным учреждением
            header("Location: /work-experience-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/work_experience/delete.php');
        return true;
    }
}