<?php

class AdminEducation
{
    public static function getListOfEducations()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, school_name, date_of_education, degree, short_description FROM education ORDER BY id ASC');
        $listOfEducations = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $listOfEducations[$i]['id'] = $row['id'];
            $listOfEducations[$i]['school_name'] = $row['school_name'];
            $listOfEducations[$i]['short_description'] = $row['short_description'];
            $listOfEducations[$i]['degree'] = $row['degree'];
            $listOfEducations[$i]['date_of_education'] = $row['date_of_education'];
            $i++;
        }
        return $listOfEducations;
    }

    public static function createEducation($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO education '
            . '(user_id, resume_id, degree, branch, school_name, date_of_education, short_description, status)'
            . 'VALUES '
            . '(:user_id, :resume_id, :degree, :branch, :school_name, :date_of_education, :short_description, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':degree', strip_tags($options['degree']), PDO::PARAM_STR);
        $result->bindParam(':branch', strip_tags($options['branch']), PDO::PARAM_STR);
        $result->bindParam(':school_name', strip_tags($options['school_name']), PDO::PARAM_STR);
        $result->bindParam(':date_of_education', strip_tags($options['date_of_education']), PDO::PARAM_STR);
        $result->bindParam(':short_description', strip_tags($options['short_description']), PDO::PARAM_STR);
        $result->bindParam(':user_id', strip_tags($options['user_id']), PDO::PARAM_INT);
        $result->bindParam(':resume_id', strip_tags($options['resume_id']), PDO::PARAM_INT);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);

        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }

    public static function getEducationById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM education WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    public static function updateEducationById($id, $options)
    {
        $db = Db::getConnection();

        $sql = "UPDATE education
            SET 
                degree = :degree, 
                branch = :branch, 
                school_name = :school_name, 
                date_of_education = :date_of_education,
                short_description = :short_description, 
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', strip_tags($id), PDO::PARAM_INT);
        $result->bindParam(':degree', strip_tags($options['degree']), PDO::PARAM_STR);
        $result->bindParam(':branch', strip_tags($options['branch']), PDO::PARAM_STR);
        $result->bindParam(':school_name', strip_tags($options['school_name']), PDO::PARAM_STR);
        $result->bindParam(':date_of_education', strip_tags($options['date_of_education']), PDO::PARAM_STR);
        $result->bindParam(':short_description', strip_tags($options['short_description']), PDO::PARAM_STR);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);
        return $result->execute();
    }

    public static function deleteEducationById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM education WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getImage($id)
    {
        $noImg = 'no-img.jpg';

        $path = '/upload/img/education/';

        $pathToUserImg = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToUserImg))
            return $pathToUserImg;

        return $path . $noImg;
    }
}