<?php

class Vacancy
{
    const SHOW_BY_DEFAULT = 1;

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

    public static function getTotalVacanciesInCategory($categoryId)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM vacancy '
            . 'WHERE status="1" AND category_id ="'.$categoryId.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

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

    public static function getCountVacancies()
    {
        $db = Db::getConnection();
        $vacancies=$db->query("SELECT COUNT(*) as count FROM vacancy")->fetchColumn();
        return $vacancies;
    }

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

    public static function getVacancyList()
    {
        $db = Db::getConnection();

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

    public static function createVacancy($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO vacancy '
            . '(company_name, job_title, user_id, company_id, short_description, website_address, location, type_of_employment, salary, working, experince, gender, job_detail, category_id, status)'
            . 'VALUES '
            . '(:company_name, :job_title, :user_id, :company_id, :short_description, :website_address, :location, :type_of_employment, :salary, :working, :experince, :gender, :job_detail, :category_id, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':company_name', strip_tags($options['company_name']), PDO::PARAM_STR);
        $result->bindParam(':job_title', strip_tags($options['job_title']), PDO::PARAM_STR);
        $result->bindParam(':user_id', strip_tags($options['user_id']), PDO::PARAM_INT);
        $result->bindParam(':company_id', strip_tags($options['company_id']), PDO::PARAM_INT);
        $result->bindParam(':short_description', strip_tags($options['short_description']), PDO::PARAM_STR);
        $result->bindParam(':website_address', strip_tags($options['website_address']), PDO::PARAM_STR);
        $result->bindParam(':location', strip_tags($options['location']), PDO::PARAM_STR);
        $result->bindParam(':type_of_employment', strip_tags($options['type_of_employment']), PDO::PARAM_STR);
        $result->bindParam(':salary', strip_tags($options['salary']), PDO::PARAM_INT);
        $result->bindParam(':working', strip_tags($options['working']), PDO::PARAM_STR);
        $result->bindParam(':experince', strip_tags($options['experince']), PDO::PARAM_STR);
        $result->bindParam(':gender', strip_tags($options['gender']), PDO::PARAM_STR);
        $result->bindParam(':job_detail', strip_tags($options['job_detail']), PDO::PARAM_STR);
        $result->bindParam(':category_id', strip_tags($options['category_id']), PDO::PARAM_INT);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);

        if ($result->execute())
            return $db->lastInsertId();

        return 0;
    }

    public static function updateVacancyById($id, $options)
    {
        $db = Db::getConnection();

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

        $result = $db->prepare($sql);
        $result->bindParam(':id', strip_tags($id), PDO::PARAM_INT);
        $result->bindParam(':company_name', strip_tags($options['company_name']), PDO::PARAM_STR);
        $result->bindParam(':job_title', strip_tags($options['job_title']), PDO::PARAM_STR);
        $result->bindParam(':company_id', strip_tags($options['company_id']), PDO::PARAM_INT);
        $result->bindParam(':user_id', strip_tags($options['user_id']), PDO::PARAM_INT);
        $result->bindParam(':short_description', strip_tags($options['short_description']), PDO::PARAM_STR);
        $result->bindParam(':website_address', strip_tags($options['website_address']), PDO::PARAM_STR);
        $result->bindParam(':location', strip_tags($options['location']), PDO::PARAM_STR);
        $result->bindParam(':type_of_employment', strip_tags($options['type_of_employment']), PDO::PARAM_STR);
        $result->bindParam(':salary', strip_tags($options['salary']), PDO::PARAM_INT);
        $result->bindParam(':working', strip_tags($options['working']), PDO::PARAM_STR);
        $result->bindParam(':experince', strip_tags($options['experince']), PDO::PARAM_STR);
        $result->bindParam(':gender', strip_tags($options['gender']), PDO::PARAM_STR);
        $result->bindParam(':job_detail', strip_tags($options['job_detail']), PDO::PARAM_STR);
        $result->bindParam(':category_id', strip_tags($options['category_id']), PDO::PARAM_INT);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);
        return $result->execute();
    }

    public static function deleteVacancyById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM vacancy WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getImage($id)
    {
        $noImg = 'no-img.jpg';

        $path = '/upload/img/vacancy/';

        $pathToUserImg = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToUserImg))
            return $pathToUserImg;

        return $path . $noImg;
    }
}