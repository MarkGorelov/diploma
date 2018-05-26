<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 20:22
 */

/**
 * Контроллер AdminResumeController
 */
class AdminResumeController extends UserBase
{
    /**
     * Action для страницы "Управление резюме"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список резюме
        $listResumes = AdminResume::getListResumes();

        // Подключаем вид
        require_once(ROOT . '/views/admin_resume/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить резюме"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = AdminCategory::getCategoriesList();
        // Получаем список образований для выпадающего списка
        $listOfEducations = AdminEducation::getListOfEducations();
        // Получаем список опыта работы для выпадающего списка
        $listOfWorkExperiences = AdminWorkExperience::getListOfWorkExperiences();
        // Получаем список тегов для выпадающего списка
        $tagsList = AdminTag::getTagsList();

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
            $options['tag_id'] = $_POST['tag_id'];
            $options['education_id'] = $_POST['education_id'];
            $options['work_experience_id'] = $_POST['work_experience_id'];
            $options['category_id'] = $_POST['category_id'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новое резюме
                $id = AdminResume::createResume($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/resume/{$id}.jpg");
                    }
                };
                // Перенаправляем администратора на страницу управлениями резюме
                header("Location: /admin/resume");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_resume/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать резюме"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = AdminCategory::getCategoriesList();
        // Получаем список образований для выпадающего списка
        $listOfEducations = AdminEducation::getListOfEducations();
        // Получаем список опыта работы для выпадающего списка
        $listOfWorkExperiences = AdminWorkExperience::getListOfWorkExperiences();
        // Получаем список тегов для выпадающего списка
        $tagsList = AdminTag::getTagsList();

        // Получаем данные о конкретном резюме
        $resume = AdminResume::getResumeById($id);

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
            $options['tag_id'] = $_POST['tag_id'];
            $options['education_id'] = $_POST['education_id'];
            $options['work_experience_id'] = $_POST['work_experience_id'];
            $options['category_id'] = $_POST['category_id'];
            $options['status'] = $_POST['status'];

            // Сохраняем изменения
            if (AdminResume::updateResumeById($id, $options)) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/resume/{$id}.jpg");
                }
            }
            // Перенаправляем администратора на страницу управлениями резюме
            header("Location: /admin/resume");
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_resume/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить резюме"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем резюме
            AdminResume::deleteResumeById($id);

            // Перенаправляем администратора на страницу управлениями резюме
            header("Location: /admin/resume");
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_resume/delete.php');
        return true;
    }
}