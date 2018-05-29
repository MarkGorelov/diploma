<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 09.05.2018
 * Time: 17:10
 */

class Vacancy
{
    const SHOW_BY_DEFAULT = 1;


    /**
     * Returns an array of products
     */
    public static function getVacanciesListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            $vacancies = array();
            $result = $db->query("SELECT id, img, company_name, job_title, short_description, type_of_employment, location, salary, gender FROM vacancy "
                . "WHERE status = '1' AND category_id = '$categoryId' "
                . "ORDER BY id DESC "
                . "LIMIT ".self::SHOW_BY_DEFAULT
                . ' OFFSET '. $offset);

            $i = 0;
            while ($row = $result->fetch()) {
                $vacancies[$i]['id'] = $row['id'];
                $vacancies[$i]['img'] = $row['img'];
                $vacancies[$i]['company_name'] = $row['company_name'];
                $vacancies[$i]['job_title'] = $row['job_title'];
                $vacancies[$i]['short_description'] = $row['short_description'];
                $vacancies[$i]['type_of_employment'] = $row['type_of_employment'];
                $vacancies[$i]['location'] = $row['location'];
                $vacancies[$i]['salary'] = $row['salary'];
                $vacancies[$i]['gender'] = $row['gender'];
                $i++;
            }

            return $vacancies;
        }
    }

    /**
     * Returns total products
     */
    public static function getTotalVacanciesInCategory($categoryId)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM vacancy '
            . 'WHERE status="1" AND category_id ="'.$categoryId.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    /**
     * Выводим список последних созданных вакансий
     */
    public static function getLatestVacancy($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $vacanciesList = array();

        $result = $db->query('SELECT id, img, company_name, job_title, type_of_employment, short_description, location, salary, gender FROM vacancy '
            . 'WHERE status = "1"'
            . 'ORDER BY id DESC '
            . 'LIMIT ' . $count);

        $i = 0;
        while ($row = $result->fetch()) {
            $vacanciesList[$i]['id'] = $row['id'];
            $vacanciesList[$i]['img'] = $row['img'];
            $vacanciesList[$i]['company_name'] = $row['company_name'];
            $vacanciesList[$i]['job_title'] = $row['job_title'];
            $vacanciesList[$i]['type_of_employment'] = $row['type_of_employment'];
            $vacanciesList[$i]['short_description'] = $row['short_description'];
            $vacanciesList[$i]['location'] = $row['location'];
            $vacanciesList[$i]['salary'] = $row['salary'];
            $vacanciesList[$i]['gender'] = $row['gender'];
            $i++;
        }

        return $vacanciesList;
    }

    /**
     * Выводим количество вакансий
     */
    public static function getCountVacancies()
    {
        $db = Db::getConnection();
        $vacancies=$db->query("SELECT COUNT(*) as count FROM vacancy")->fetchColumn();
        return $vacancies;
    }

    /**
     * Выводим список последних созданных компаний текущим пользователем
     */
    public static function getVacanciesByUser($userId = false)
    {
        if ($userId) {
            $db = Db::getConnection();
            $vacancies = array();
            $result = $db->query("SELECT id, img, job_title, company_name, location, status FROM vacancy "
                . "WHERE user_id = '$userId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $vacancies[$i]['id'] = $row['id'];
                $vacancies[$i]['img'] = $row['img'];
                $vacancies[$i]['job_title'] = $row['job_title'];
                $vacancies[$i]['company_name'] = $row['company_name'];
                $vacancies[$i]['location'] = $row['location'];
                $vacancies[$i]['status'] = $row['status'];
                $i++;
            }
            return $vacancies;
        }
    }

    /*
     * Return company item by id
     * @param integer $id
     */
    public static function getVacancyById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM vacancy WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    /**
     * Возвращает список вакансий компании
     * @return array <p>Массив с вакансиями</p>
     */
    public static function getVacanciesListByCompany($companyId = false)
    {
        if ($companyId) {
            $db = Db::getConnection();
            $vacancies = array();
            $result = $db->query("SELECT id, img, job_title, company_name, type_of_employment, short_description, location, salary, gender FROM vacancy "
                . "WHERE status = '1' AND company_id = '$companyId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $vacancies[$i]['id'] = $row['id'];
                $vacancies[$i]['img'] = $row['img'];
                $vacancies[$i]['job_title'] = $row['job_title'];
                $vacancies[$i]['company_name'] = $row['company_name'];
                $vacancies[$i]['type_of_employment'] = $row['type_of_employment'];
                $vacancies[$i]['short_description'] = $row['short_description'];
                $vacancies[$i]['location'] = $row['location'];
                $vacancies[$i]['salary'] = $row['salary'];
                $vacancies[$i]['gender'] = $row['gender'];
                $i++;
            }
            return $vacancies;
        }
    }

    /**
     * Возвращает список вакансий
     * @return array <p>Массив с вакансиями</p>
     */
    public static function getVacancyList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, company_name, job_title, website_address, job_detail FROM vacancy ORDER BY id ASC');
        $vacanciesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $vacanciesList[$i]['id'] = $row['id'];
            $vacanciesList[$i]['company_name'] = $row['company_name'];
            $vacanciesList[$i]['job_title'] = $row['job_title'];
            $vacanciesList[$i]['website_address'] = $row['website_address'];
            $vacanciesList[$i]['job_detail'] = $row['job_detail'];
            $i++;
        }
        return $vacanciesList;
    }

    /**
     * Добавляет новую вакансию
     * @param array $options <p>Массив с информацией о вакансии</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createVacancy($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO vacancy '
            . '(company_name, job_title, user_id, company_id, short_description, website_address, location, type_of_employment, salary, working, experince, gender, job_detail, category_id, status)'
            . 'VALUES '
            . '(:company_name, :job_title, :user_id, :company_id, :short_description, :website_address, :location, :type_of_employment, :salary, :working, :experince, :gender, :job_detail, :category_id, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':job_title', $options['job_title'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':company_id', $options['company_id'], PDO::PARAM_INT);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':website_address', $options['website_address'], PDO::PARAM_STR);
        $result->bindParam(':location', $options['location'], PDO::PARAM_STR);
        $result->bindParam(':type_of_employment', $options['type_of_employment'], PDO::PARAM_STR);
        $result->bindParam(':salary', $options['salary'], PDO::PARAM_INT);
        $result->bindParam(':working', $options['working'], PDO::PARAM_STR);
        $result->bindParam(':experince', $options['experince'], PDO::PARAM_STR);
        $result->bindParam(':gender', $options['gender'], PDO::PARAM_STR);
        $result->bindParam(':job_detail', $options['job_detail'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Редактирует вакансию с заданным id
     * @param integer $id <p>id вакансии</p>
     * @param array $options <p>Массив с информацей о вакансии</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateVacancyById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE vacancy
            SET 
                company_name = :company_name, 
                job_title = :job_title, 
                company_id = :company_id, 
                user_id = :user_id,
                short_description = :short_description,
                website_address = :website_address, 
                location = :location, 
                type_of_employment = :type_of_employment, 
                salary = :salary,
                working = :working, 
                experince = :experince, 
                gender = :gender, 
                job_detail = :job_detail, 
                category_id = :category_id, 
                status = :status
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':job_title', $options['job_title'], PDO::PARAM_STR);
        $result->bindParam(':company_id', $options['company_id'], PDO::PARAM_INT);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':website_address', $options['website_address'], PDO::PARAM_STR);
        $result->bindParam(':location', $options['location'], PDO::PARAM_STR);
        $result->bindParam(':type_of_employment', $options['type_of_employment'], PDO::PARAM_STR);
        $result->bindParam(':salary', $options['salary'], PDO::PARAM_INT);
        $result->bindParam(':working', $options['working'], PDO::PARAM_STR);
        $result->bindParam(':experince', $options['experince'], PDO::PARAM_STR);
        $result->bindParam(':gender', $options['gender'], PDO::PARAM_STR);
        $result->bindParam(':job_detail', $options['job_detail'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Удаляет вакансию с указанным id
     * @param integer $id <p>id вакансии</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteVacancyById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM vacancy WHERE id = :id';

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
        $path = '/upload/img/vacancy/';

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