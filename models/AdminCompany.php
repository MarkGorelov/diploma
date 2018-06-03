<?php

class AdminCompany
{
    public static function getCompaniesList()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, user_id, category_id, company_name, headline, short_description, location, founded, employees, website_address, phone_number, email_address, company_detail, status FROM company ORDER BY id ASC');

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

    public static function createCompany($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO company '
            . '(company_name, user_id, category_id, headline, short_description, location, founded, employees, website_address, phone_number, email_address, company_detail, status)'
            . 'VALUES '
            . '(:company_name, :user_id, :category_id, :headline, :short_description, :location, :founded, :employees, :website_address, :phone_number, :email_address, :company_detail, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':company_name', strip_tags($options['company_name']), PDO::PARAM_STR);
        $result->bindParam(':headline', strip_tags($options['headline']), PDO::PARAM_STR);
        $result->bindParam(':short_description', strip_tags($options['short_description']), PDO::PARAM_STR);
        $result->bindParam(':location', strip_tags($options['location']), PDO::PARAM_STR);
        $result->bindParam(':founded', strip_tags($options['founded']), PDO::PARAM_STR);
        $result->bindParam(':employees', strip_tags($options['employees']), PDO::PARAM_STR);
        $result->bindParam(':website_address', strip_tags($options['website_address']), PDO::PARAM_STR);
        $result->bindParam(':phone_number', strip_tags($options['phone_number']), PDO::PARAM_INT);
        $result->bindParam(':email_address', strip_tags($options['email_address']), PDO::PARAM_STR);
        $result->bindParam(':company_detail', strip_tags($options['company_detail']), PDO::PARAM_STR);
        $result->bindParam(':category_id', strip_tags($options['category_id']), PDO::PARAM_INT);
        $result->bindParam(':user_id', strip_tags($options['user_id']), PDO::PARAM_INT);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);

        if ($result->execute())
            return $db->lastInsertId();

        return 0;
    }

    public static function updateCompanyById($id, $options)
    {
        $db = Db::getConnection();

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

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':company_name', strip_tags($options['company_name']), PDO::PARAM_STR);
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