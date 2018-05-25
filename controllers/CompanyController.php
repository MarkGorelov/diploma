<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 09.05.2018
 * Time: 15:53
 */

/**
 * Контроллер CompanyController
 * Для управления страницами просмотра всех компаний, отдельной компаниий,
 * созданием компании, редактирования компании, удаление компании
 */
class CompanyController extends UserBase
{
    /**
     * Action для страницы "Просмотр недавно созданных компаний"
     */
    public function actionIndex()
    {
        $latestCompanies = array();
        $latestCompanies = Company::getLatestCompany(3);

        require_once(ROOT . '/views/company/index.php');
        return true;
    }

    /**
     * Action для страницы "Просмотр конкретной компании"
     */
    public function actionView($companyId)
    {
        $company = Company::getCompanyById($companyId);

        $jobsCompany = array();
        $jobsCompany = Vacancy::getVacanciesListByCompany($companyId);

        require_once(ROOT . '/views/company/view.php');
        return true;
    }

    /**
     * Action для страницы "Список компаний пользователя"
     */
    public function actionManage()
    {
        // проверка доступа
        self::checkEmployer();

        // получаем список компаний пользователя
        $companiesUser = array();
        $companiesUser = Company::getCompaniesByUser($userID = $_SESSION['user']);

        require_once(ROOT . '/views/company/manage.php');
        return true;
    }

    /**
     * Action для страницы "Добавить компанию"
     */
    public function actionCreate()
    {
        self::checkEmployer();
        // Получаем список категорий для выпадающего списка
        $categoriesList = AdminCategory::getCategoriesList();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['company_name'] = $_POST['company_name'];
            $options['user_id'] = $_POST['user_id'];
            $options['category_id'] = $_POST['category_id'];
            $options['headline'] = $_POST['headline'];
            $options['short_description'] = $_POST['short_description'];
            $options['location'] = $_POST['location'];
            $options['founded'] = $_POST['founded'];
            $options['employees'] = $_POST['employees'];
            $options['website_address'] = $_POST['website_address'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['email_address'] = $_POST['email_address'];
            $options['company_detail'] = $_POST['company_detail'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую вакансию
                $id = Company::createCompany($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/company/{$id}.jpg");
                    }
                };
                // Перенаправляем пользователя на страницу управлениями вакансиями
                header("Location: /company-manage/");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/company/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать компанию"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkEmployer();

        // Получаем список категорий для выпадающего списка
        $categoriesList = AdminCategory::getCategoriesList();
        // Получаем данные о конкретной компании
        $company = Company::getCompanyById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['company_name'] = $_POST['company_name'];
            $options['user_id'] = $_POST['user_id'];
            $options['category_id'] = $_POST['category_id'];
            $options['headline'] = $_POST['headline'];
            $options['short_description'] = $_POST['short_description'];
            $options['location'] = $_POST['location'];
            $options['founded'] = $_POST['founded'];
            $options['employees'] = $_POST['employees'];
            $options['website_address'] = $_POST['website_address'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['email_address'] = $_POST['email_address'];
            $options['company_detail'] = $_POST['company_detail'];
            $options['status'] = $_POST['status'];

            // Сохраняем изменения
            if (Company::updateCompanyById($id, $options)) {
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/company/{$id}.jpg");
                }
            }
            // Перенаправляем администратора на страницу управлениями компаниями
            header("Location: /company-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/company/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить компанию"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkEmployer();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем компанию
            Company::deleteCompanyById($id);

            // Перенаправляем пользователя на страницу управлениями компаниями
            header("Location: /company-manage/");
        }
        // Подключаем вид
        require_once(ROOT . '/views/company/delete.php');
        return true;
    }
}