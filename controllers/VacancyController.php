<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 09.05.2018
 * Time: 17:47
 */

/**
 * Контроллер VacancyController
 * Для управления страницами просмотра всех вакансий, отдельной вакансии,
 * созданием вакансии, редактирования вакансии, удаления вакансии
 */
class VacancyController extends UserBase
{
    /**
     * Action для страницы "Просмотр недавно созданных вакансий"
     */
    public function actionIndex()
    {
        $latestVacancies = array();
        $latestVacancies = Vacancy::getLatestVacancy();

        $categories = array();
        $categories = AdminCategory::getCategoriesList();

        require_once(ROOT . '/views/vacancy/index.php');
        return true;
    }

    /**
     * Action для страницы "Просмотр конкретной вакансии"
     */
    public function actionView($vacancyId)
    {
        $vacancy = Vacancy::getVacancyById($vacancyId);

        require_once(ROOT . '/views/vacancy/view.php');
        return true;
    }

    /**
     * Action для страницы "Список вакансий пользователя"
     */
    public function actionManage()
    {
        // проверка доступа
        self::checkEmployer();

        // получаем список компаний пользователя
        $vacanciesUser = array();
        $vacanciesUser = Vacancy::getVacanciesByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/vacancy/manage.php');
        return true;
    }

    /**
     * Action для страницы "Создать вакансию"
     */
    public function actionCreate()
    {
        self::checkEmployer();
        // Получаем список категорий для выпадающего списка
        $categoriesList = AdminCategory::getCategoriesList();
        // Получаем список компаний пользователя для выпадающего списка
        $companiesList = Company::getCompaniesListByUser($userID = $_SESSION['user']);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['company_name'] = $_POST['company_name'];
            $options['job_title'] = $_POST['job_title'];
            $options['user_id'] = $_POST['user_id'];
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

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую вакансию
                $id = Vacancy::createVacancy($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/vacancy/{$id}.jpg");
                    }
                };
                // Перенаправляем пользователя на страницу управлениями вакансиями
                header("Location: /vacancy-manage/");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/vacancy/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать вакансию"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkEmployer();

        // Получаем список категорий для выпадающего списка
        $categoriesList = AdminCategory::getCategoriesList();
        // Получаем список компаний пользователя для выпадающего списка
        $companiesList = Company::getCompaniesListByUser($userID = $_SESSION['user']);
        // Получаем данные о конкретной вакансии
        $vacancy = Vacancy::getVacancyById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['company_name'] = $_POST['company_name'];
            $options['job_title'] = $_POST['job_title'];
            $options['user_id'] = $_POST['user_id'];
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
            if (Vacancy::updateVacancyById($id, $options)) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/vacancy/{$id}.jpg");
                }
            }
            // Перенаправляем администратора на страницу управлениями компаниями
            header("Location: /vacancy-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/vacancy/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить вакансию"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkEmployer();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем вакансию
            Vacancy::deleteVacancyById($id);

            // Перенаправляем пользователя на страницу управлениями компаниями
            header("Location: /vacancy-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/vacancy/delete.php');
        return true;
    }
}