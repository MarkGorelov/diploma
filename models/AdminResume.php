<?php

class AdminResume
{
    public static function getListResumes()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, headline, short_description, website_address, email_address FROM resume ORDER BY id ASC');
        $listResumes = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $listResumes[$i]['id'] = $row['id'];
            $listResumes[$i]['name'] = $row['name'];
            $listResumes[$i]['headline'] = $row['headline'];
            $listResumes[$i]['short_description'] = $row['short_description'];
            $listResumes[$i]['website_address'] = $row['website_address'];
            $listResumes[$i]['email_address'] = $row['email_address'];
            $i++;
        }
        return $listResumes;
    }

    public static function createResume($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO resume '
            . '(name, headline, short_description, location, website_address, salary, age, phone_number, email_address, gender, category_id, user_id, status)'
            . 'VALUES '
            . '(:name, :headline, :short_description, :location, :website_address, :salary, :age, :phone_number, :email_address, :gender, :category_id, :user_id, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', strip_tags($options['name']), PDO::PARAM_STR);
        $result->bindParam(':headline', strip_tags($options['headline']), PDO::PARAM_STR);
        $result->bindParam(':short_description', strip_tags($options['short_description']), PDO::PARAM_STR);
        $result->bindParam(':location', strip_tags($options['location']), PDO::PARAM_STR);
        $result->bindParam(':website_address', strip_tags($options['website_address']), PDO::PARAM_STR);
        $result->bindParam(':salary', strip_tags($options['salary']), PDO::PARAM_INT);
        $result->bindParam(':age', strip_tags($options['age']), PDO::PARAM_INT);
        $result->bindParam(':phone_number', strip_tags($options['phone_number']), PDO::PARAM_INT);
        $result->bindParam(':email_address', strip_tags($options['email_address']), PDO::PARAM_STR);
        $result->bindParam(':gender', strip_tags($options['gender']), PDO::PARAM_STR);
        $result->bindParam(':user_id', strip_tags($options['user_id']), PDO::PARAM_INT);
        $result->bindParam(':category_id', strip_tags($options['category_id']), PDO::PARAM_INT);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);

        if ($result->execute())
            return $db->lastInsertId();

        return 0;
    }

    public static function getResumeById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM resume WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    public static function updateResumeById($id, $options)
    {
        $db = Db::getConnection();

        $sql = "UPDATE resume
            SET 
                name = :name, 
                headline = :headline, 
                short_description = :short_description, 
                location = :location,
                website_address = :website_address, 
                salary = :salary, 
                age = :age, 
                phone_number = :phone_number,
                email_address = :email_address, 
                gender = :gender, 
                user_id = :user_id, 
                category_id = :category_id,
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', strip_tags($id), PDO::PARAM_INT);
        $result->bindParam(':name', strip_tags($options['name']), PDO::PARAM_STR);
        $result->bindParam(':headline', strip_tags($options['headline']), PDO::PARAM_STR);
        $result->bindParam(':short_description', strip_tags($options['short_description']), PDO::PARAM_STR);
        $result->bindParam(':location', strip_tags($options['location']), PDO::PARAM_STR);
        $result->bindParam(':website_address', strip_tags($options['website_address']), PDO::PARAM_STR);
        $result->bindParam(':salary', strip_tags($options['salary']), PDO::PARAM_INT);
        $result->bindParam(':age', strip_tags($options['age']), PDO::PARAM_INT);
        $result->bindParam(':phone_number', strip_tags($options['phone_number']), PDO::PARAM_INT);
        $result->bindParam(':email_address', strip_tags($options['email_address']), PDO::PARAM_STR);
        $result->bindParam(':gender', strip_tags($options['gender']), PDO::PARAM_STR);
        $result->bindParam(':user_id', strip_tags($options['user_id']), PDO::PARAM_INT);
        $result->bindParam(':category_id', strip_tags($options['category_id']), PDO::PARAM_INT);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);
        return $result->execute();
    }

    public static function deleteResumeById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM resume WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getImage($id)
    {
        $noImg = 'no-img.jpg';

        $path = '/upload/img/resume/';

        $pathToUserImg = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToUserImg))
            return $pathToUserImg;

        return $path . $noImg;
    }
}