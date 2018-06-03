<?php

class Company
{
    const SHOW_BY_DEFAULT = 1;

    public static function getCompaniesListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            $companies = array();
            $result = $db->query("SELECT id, img, company_name, headline, short_description FROM company "
                . "WHERE status = '1' AND category_id = '$categoryId' "
                . "ORDER BY id DESC "
                . "LIMIT ".self::SHOW_BY_DEFAULT
                . ' OFFSET '. $offset);

            $i = 0;
            while ($row = $result->fetch()) {
                $companies[$i]['id'] = $row['id'];
                $companies[$i]['img'] = $row['img'];
                $companies[$i]['company_name'] = $row['company_name'];
                $companies[$i]['headline'] = $row['headline'];
                $companies[$i]['short_description'] = $row['short_description'];
                $i++;
            }

            return $companies;
        }
    }

    public static function getTotalCompaniesInCategory($categoryId)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM company '
            . 'WHERE status="1" AND category_id ="'.$categoryId.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function getCountCompanies()
    {
        $db = Db::getConnection();
        $companies=$db->query("SELECT COUNT(*) as count FROM company")->fetchColumn();
        return $companies;
    }

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

    public static function getCompaniesByUser($userId = false)
    {
        if ($userId) {
            $db = Db::getConnection();
            $companies = array();
            $result = $db->query("SELECT id, img, company_name, headline FROM company "
                . "WHERE status = '1' AND user_id = '$userId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $companies[$i]['id'] = $row['id'];
                $companies[$i]['img'] = $row['img'];
                $companies[$i]['headline'] = $row['headline'];
                $companies[$i]['company_name'] = $row['company_name'];
                $i++;
            }
            return $companies;
        }
    }

    public static function getCompaniesListByUser($userId = false)
    {
        if ($userId) {
            $db = Db::getConnection();
            $companies = array();
            $result = $db->query("SELECT id, company_name FROM company "
                . "WHERE user_id = '$userId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $companies[$i]['id'] = $row['id'];
                $companies[$i]['company_name'] = $row['company_name'];
                $i++;
            }
            return $companies;
        }
    }

    public static function createCompany($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO company '
            . '(company_name, user_id, category_id, headline, short_description, location, founded, employees, website_address, phone_number, email_address, company_detail, status)'
            . 'VALUES '
            . '(:company_name, :user_id, :category_id, :headline, :short_description, :location, :founded, :employees, :website_address, :phone_number, :email_address, :company_detail, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':company_name', strip_tags($options['company_name']), PDO::PARAM_STR);
        $result->bindParam(':user_id', strip_tags($options['user_id']), PDO::PARAM_INT);
        $result->bindParam(':category_id', strip_tags($options['category_id']), PDO::PARAM_INT);
        $result->bindParam(':headline', strip_tags($options['headline']), PDO::PARAM_STR);
        $result->bindParam(':short_description', strip_tags($options['short_description']), PDO::PARAM_STR);
        $result->bindParam(':location', strip_tags($options['location']), PDO::PARAM_INT);
        $result->bindParam(':founded', strip_tags($options['founded']), PDO::PARAM_STR);
        $result->bindParam(':employees', strip_tags($options['employees']), PDO::PARAM_STR);
        $result->bindParam(':website_address', strip_tags($options['website_address']), PDO::PARAM_STR);
        $result->bindParam(':phone_number', strip_tags($options['phone_number']), PDO::PARAM_INT);
        $result->bindParam(':email_address', strip_tags($options['email_address']), PDO::PARAM_STR);
        $result->bindParam(':company_detail', strip_tags($options['company_detail']), PDO::PARAM_STR);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);

        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }

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

    public static function updateCompanyById($id, $options)
    {
        $db = Db::getConnection();

        $sql = "UPDATE company
            SET 
                company_name = :company_name,
                user_id = :user_id, 
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

        $result = $db->prepare($sql);
        $result->bindParam(':id', strip_tags($id), PDO::PARAM_INT);
        $result->bindParam(':company_name', strip_tags($options['company_name']), PDO::PARAM_STR);
        $result->bindParam(':user_id', strip_tags($options['user_id']), PDO::PARAM_INT);
        $result->bindParam(':category_id', strip_tags($options['category_id']), PDO::PARAM_INT);
        $result->bindParam(':headline', strip_tags($options['headline']), PDO::PARAM_STR);
        $result->bindParam(':short_description', strip_tags($options['short_description']), PDO::PARAM_STR);
        $result->bindParam(':location', strip_tags($options['location']), PDO::PARAM_INT);
        $result->bindParam(':founded', strip_tags($options['founded']), PDO::PARAM_STR);
        $result->bindParam(':employees', strip_tags($options['employees']), PDO::PARAM_STR);
        $result->bindParam(':website_address', strip_tags($options['website_address']), PDO::PARAM_STR);
        $result->bindParam(':phone_number', strip_tags($options['phone_number']), PDO::PARAM_INT);
        $result->bindParam(':email_address', strip_tags($options['email_address']), PDO::PARAM_STR);
        $result->bindParam(':company_detail', strip_tags($options['company_detail']), PDO::PARAM_STR);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);
        return $result->execute();
    }

    public static function deleteCompanyById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM company WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getImage($id)
    {
        $noImg = 'no-img.jpg';

        $path = '/upload/img/company/';

        $pathToUserImg = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToUserImg))
            return $pathToUserImg;

        return $path . $noImg;
    }
}