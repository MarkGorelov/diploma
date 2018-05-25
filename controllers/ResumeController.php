<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 22.05.2018
 * Time: 12:35
 */

class ResumeController extends UserBase
{
    public function actionIndex()
    {
        $latestResumes = array();
        $latestResumes = Resume::getLatestResume();

        $tagsResume = array();
        $tagsResume = Tag::getTagListByResume();

        $categories = array();
        $categories = AdminCategory::getCategoriesList();

        require_once(ROOT . '/views/resume/index.php');
        return true;
    }

    public function actionView($resumeId)
    {
        $resume = Resume::getResumeById($resumeId);

        $tagsResume = array();
        $tagsResume = Tag::getTagListByResume();

        $workExperienceResume = array();
        $workExperienceResume = WorkExperience::getWorkExperienceListByResume();

        $educationResume = array();
        $educationResume = Education::getEducationListByResume();

        require_once(ROOT . '/views/resume/view.php');
        return true;
    }

    public function actionManage()
    {
        self::checkAspirant();

        // получаем список компаний пользователя
        $resumesUser = array();
        $resumesUser = Resume::getResumesByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/resume/manage.php');
        return true;
    }

    /**
     * Action для страницы "Добавить резюме"
     */
    public function actionCreate()
    {
        self::checkAspirant();
        // Получаем список категорий для выпадающего списка
        $categoriesList = AdminCategory::getCategoriesList();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['headline'] = $_POST['headline'];
            $options['short_description'] = $_POST['short_description'];
            $options['location'] = $_POST['location'];
            $options['website_address'] = $_POST['website_address'];
            $options['salary'] = $_POST['salary'];
            $options['age'] = $_POST['age'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['email_address'] = $_POST['email_address'];
            $options['gender'] = $_POST['gender'];
            $options['category_id'] = $_POST['category_id'];
            $options['user_id'] = $_POST['user_id'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую вакансию
                $id = Resume::createResume($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/resume/{$id}.jpg");
                    }
                };
                // Перенаправляем пользователя на страницу управлениями вакансиями
                header("Location: /resume-manage/");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/resume/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать резюме"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAspirant();

        // Получаем список категорий для выпадающего списка
        $categoriesList = AdminCategory::getCategoriesList();
        // Получаем данные о конкретной компании
        $resume = Resume::getResumeById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['name'] = $_POST['name'];
            $options['headline'] = $_POST['headline'];
            $options['short_description'] = $_POST['short_description'];
            $options['location'] = $_POST['location'];
            $options['website_address'] = $_POST['website_address'];
            $options['salary'] = $_POST['salary'];
            $options['age'] = $_POST['age'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['email_address'] = $_POST['email_address'];
            $options['gender'] = $_POST['gender'];
            $options['category_id'] = $_POST['category_id'];
            $options['user_id'] = $_POST['user_id'];
            $options['status'] = $_POST['status'];

            // Сохраняем изменения
            if (Resume::updateResumeById($id, $options)) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/resume/{$id}.jpg");
                }
            }
            // Перенаправляем администратора на страницу управлениями компаниями
            header("Location: /resume-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/resume/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить компанию"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAspirant();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем компанию
            Resume::deleteResumeById($id);

            // Перенаправляем пользователя на страницу управлениями компаниями
            header("Location: /resume-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/resume/delete.php');
        return true;
    }
}