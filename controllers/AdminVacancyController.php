<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 15:36
 */

/**
 * Контроллер AdminVacancyController
 */
class AdminVacancyController extends UserBase
{
    /**
     * Action для страницы "Управление вакансиями"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список вакнсий
        $vacanciesList = AdminVacancy::getVacanciesList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_vacancy/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить вакансию"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = AdminCategory::getCategoriesList();
        // Получаем список компаний для выпадающего списка
        $companiesList = AdminCompany::getCompaniesList();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['company_name'] = $_POST['company_name'];
            $options['job_title'] = $_POST['job_title'];
            $options['company_id'] = $_POST['company_id'];
            $options['short_description'] = $_POST['short_description'];
            $options['website_address'] = $_POST['website_address'];
            $options['location'] = $_POST['location'];
            $options['type_of_employment'] = $_POST['type_of_employment'];
            $options['salary'] = $_POST['salary'];
            $options['working'] = $_POST['working'];
            $options['experince'] = $_POST['experince'];
            $options['gender'] = $_POST['gender'];
            $options['job_detail'] = $_POST['job_detail'];
            $options['category_id'] = $_POST['category_id'];
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
                $id = AdminVacancy::createVacancy($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/vacancy/{$id}.jpg");
                    }
                };
                // Перенаправляем администратора на страницу управлениями вакансиями
                header("Location: /admin/vacancy");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_vacancy/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать вакансию"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = AdminCategory::getCategoriesList();
        // Получаем список компаний для выпадающего списка
        $companiesList = AdminCompany::getCompaniesList();

        // Получаем данные о конкретном заказе
        $vacancy = AdminVacancy::getVacancyById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['company_name'] = $_POST['company_name'];
            $options['job_title'] = $_POST['job_title'];
            $options['company_id'] = $_POST['company_id'];
            $options['short_description'] = $_POST['short_description'];
            $options['website_address'] = $_POST['website_address'];
            $options['location'] = $_POST['location'];
            $options['type_of_employment'] = $_POST['type_of_employment'];
            $options['salary'] = $_POST['salary'];
            $options['working'] = $_POST['working'];
            $options['experince'] = $_POST['experince'];
            $options['gender'] = $_POST['gender'];
            $options['job_detail'] = $_POST['job_detail'];
            $options['category_id'] = $_POST['category_id'];
            $options['status'] = $_POST['status'];

            // Сохраняем изменения
            if (AdminVacancy::updateVacancyById($id, $options)) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/vacancy/{$id}.jpg");
                }
            }
            // Перенаправляем администратора на страницу управлениями вакансиями
            header("Location: /admin/vacancy");
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_vacancy/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить вакансию"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем вакансию
            AdminVacancy::deleteVacancyById($id);

            // Перенаправляем администратора на страницу управлениями вакансиями
            header("Location: /admin/vacancy");
        }
        // Подключаем вид
        require_once(ROOT . '/views/admin_vacancy/delete.php');
        return true;
    }
}