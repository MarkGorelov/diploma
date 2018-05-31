<?php

class AdminVacancy
{
    public static function getVacanciesList()
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
            . '(company_name, job_title, user_id company_id, short_description, website_address, location, type_of_employment, salary, working, experince, gender, job_detail, category_id, status)'
            . 'VALUES '
            . '(:company_name, :job_title, :user_id, :company_id, :short_description, :website_address, :location, :type_of_employment, :salary, :working, :experince, :gender, :job_detail, :category_id, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':job_title', $options['job_title'], PDO::PARAM_STR);
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
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute())
            return $db->lastInsertId();

        return 0;
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

    public static function updateVacancyById($id, $options)
    {
        $db = Db::getConnection();

        $sql = "UPDATE vacancy
            SET 
                company_name = :company_name, 
                job_title = :job_title, 
                company_id = :company_id, 
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
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':job_title', $options['job_title'], PDO::PARAM_STR);
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