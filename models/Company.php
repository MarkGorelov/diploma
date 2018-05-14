<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 09.05.2018
 * Time: 15:40
 */

class Company
{
    const SHOW_BY_DEFAULT = 10;

    /*
     * Returns an array of companies
     */
    public static function getLatestCompany($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $companiesList = array();

        $result = $db->query('SELECT id, img, company_name, headline, short_description FROM company '
            . 'WHERE status = "1"'
            . 'ORDER BY id DESC '
            . 'LIMIT ' . $count);

        $i = 0;
        while ($row = $result->fetch()) {
            $companiesList[$i]['id'] = $row['id'];
            $companiesList[$i]['img'] = $row['img'];
            $companiesList[$i]['company_name'] = $row['company_name'];
            $companiesList[$i]['headline'] = $row['headline'];
            $companiesList[$i]['short_description'] = $row['short_description'];
            $i++;
        }
        return $companiesList;
    }


    /*
     * Return company item by id
     * @param integer $id
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
     * Возвращает список компаний
     * @return array <p>Массив с компаниями</p>
     */
    public static function getCompanyList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, company_name, website_address, phone_number, email_address FROM company ORDER BY id ASC');
        $companiesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $companiesList[$i]['id'] = $row['id'];
            $companiesList[$i]['company_name'] = $row['company_name'];
            $companiesList[$i]['website_address'] = $row['website_address'];
            $companiesList[$i]['phone_number'] = $row['phone_number'];
            $companiesList[$i]['email_address'] = $row['email_address'];
            $i++;
        }
        return $companiesList;
    }

    /**
     * Добавляет новую компанию
     * @param array $options <p>Массив с информацией о компании</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createCompany($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO company '
            . '(company_name, category_id, headline, short_description, location, founded, employees, website_address, phone_number, email_address, company_detail, status)'
            . 'VALUES '
            . '(:company_name, :category_id, :headline, :short_description, :location, :founded, :employees, :website_address, :phone_number, :email_address, :company_detail, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':headline', $options['headline'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':location', $options['location'], PDO::PARAM_INT);
        $result->bindParam(':founded', $options['founded'], PDO::PARAM_STR);
        $result->bindParam(':employees', $options['employees'], PDO::PARAM_INT);
        $result->bindParam(':website_address', $options['website_address'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_INT);
        $result->bindParam(':email_address', $options['email_address'], PDO::PARAM_STR);
        $result->bindParam(':company_detail', $options['company_detail'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
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
        $result->bindParam(':employees', $options['employees'], PDO::PARAM_INT);
        $result->bindParam(':website_address', $options['website_address'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_INT);
        $result->bindParam(':email_address', $options['email_address'], PDO::PARAM_STR);
        $result->bindParam(':company_detail', $options['company_detail'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
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

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToUserImg)) {
            // Если изображение для пользователя существует
            // Возвращаем путь изображения пользователя
            return $pathToUserImg;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImg;
    }
}