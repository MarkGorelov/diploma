<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 22.05.2018
 * Time: 15:42
 */

/**
 * Класс AdminCompany - модель для работы с компаниями в административной панели
 */
class AdminCompany
{
    /**
     * Возвращаем массив компаний для списка в административной панели
     * @return array <p>Массив компаний</p>
     */
    public static function getCompaniesList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, user_id, category_id, company_name, headline, short_description, location, founded, employees, website_address, phone_number, email_address, company_detail, status FROM company ORDER BY id ASC');
        // Получение и возврат результатов
        $companiesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $companiesList[$i]['id'] = $row['id'];
            $companiesList[$i]['user_id'] = $row['user_id'];
            $companiesList[$i]['category_id'] = $row['category_id'];
            $companiesList[$i]['company_name'] = $row['company_name'];
            $companiesList[$i]['headline'] = $row['headline'];
            $companiesList[$i]['short_description'] = $row['short_description'];
            $companiesList[$i]['location'] = $row['location'];
            $companiesList[$i]['founded'] = $row['founded'];
            $companiesList[$i]['employees'] = $row['employees'];
            $companiesList[$i]['website_address'] = $row['website_address'];
            $companiesList[$i]['phone_number'] = $row['phone_number'];
            $companiesList[$i]['email_address'] = $row['email_address'];
            $companiesList[$i]['company_detail'] = $row['company_detail'];
            $companiesList[$i]['status'] = $row['status'];
            $i++;
        }
        return $companiesList;
    }

    /**
     * Добавляем новую компанию в административной панели
     * @param array $options <p>Массив с информацией о компании</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createCompany($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO company '
            . '(company_name, user_id, category_id, headline, short_description, location, founded, employees, website_address, phone_number, email_address, company_detail, status)'
            . 'VALUES '
            . '(:company_name, :user_id, :category_id, :headline, :short_description, :location, :founded, :employees, :website_address, :phone_number, :email_address, :company_detail, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':headline', $options['headline'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':location', $options['location'], PDO::PARAM_INT);
        $result->bindParam(':founded', $options['founded'], PDO::PARAM_STR);
        $result->bindParam(':employees', $options['employees'], PDO::PARAM_STR);
        $result->bindParam(':website_address', $options['website_address'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_INT);
        $result->bindParam(':email_address', $options['email_address'], PDO::PARAM_STR);
        $result->bindParam(':company_detail', $options['company_detail'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute())
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();

        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Редактирует компанию с заданным id
     * @param integer $id <p>id компании</p>
     * @param array $options <p>Массив с информацей о компании</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateCompanyById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE company
            SET 
                company_name = :company_name, 
                category_id = :category_id, 
                headline = :headline, 
                short_description = :short_description,
                location = :location, 
                founded = :founded, 
                employees = :employees, 
                website_address = :website_address,
                phone_number = :phone_number, 
                email_address = :email_address, 
                company_detail = :company_detail, 
                status = :status
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':headline', $options['headline'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':location', $options['location'], PDO::PARAM_INT);
        $result->bindParam(':founded', $options['founded'], PDO::PARAM_STR);
        $result->bindParam(':employees', $options['employees'], PDO::PARAM_STR);
        $result->bindParam(':website_address', $options['website_address'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_INT);
        $result->bindParam(':email_address', $options['email_address'], PDO::PARAM_STR);
        $result->bindParam(':company_detail', $options['company_detail'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Возвращает компанию по индентификатору
     * @param integer $id <p>id компании</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function getCompanyById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM company WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    /**
     * Удаляет компанию с указанным id
     * @param integer $id <p>id компании</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteCompanyById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM company WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImg = 'no-img.jpg';

        // Путь к папке с картинками пользователями
        $path = '/upload/img/company/';

        // Путь к изображению пользователя
        $pathToUserImg = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToUserImg))
            // Если изображение для пользователя существует
            // Возвращаем путь изображения пользователя
            return $pathToUserImg;

        // Возвращаем путь изображения-пустышки
        return $path . $noImg;
    }

    /**
     * Возвращает текстое пояснение статуса для компании :<br/>
     * <i>0 - Скрыта, 1 - Отображается</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }
}