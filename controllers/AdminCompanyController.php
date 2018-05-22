<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 14.05.2018
 * Time: 19:20
 */

class AdminCompanyController extends AdminBase
{
    /**
     * Action для страницы "Управление компаниями"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список компаний
        $companiesList = Company::getCompanyList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_company/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить компанию"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['company_name'] = $_POST['company_name'];
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

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['company_name']) || empty($options['company_name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую компанию
                $id = Company::createCompany($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/company/{$id}.jpg");
                    }
                };

                // Перенаправляем пользователя на страницу управлениями компаниями
                header("Location: /admin/company");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_company/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать компанию"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();

        // Получаем данные о конкретном заказе
        $company = Company::getCompanyById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['company_name'] = $_POST['company_name'];
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
                    move_uploaded_file($_FILES["img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/img/category/{$id}.jpg");
                }
            }

            // Перенаправляем пользователя на страницу управлениями компаниями
            header("Location: /admin/company");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_company/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить компанию"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем компанию
            Company::deleteCompanyById($id);

            // Перенаправляем пользователя на страницу управлениями компаниями
            header("Location: /admin/company");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_company/delete.php');
        return true;
    }
}