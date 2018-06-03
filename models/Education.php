<?php

class Education
{
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

    public static function getEducationsListByResume($resumeId = false)
    {
        if ($resumeId) {
            $db = Db::getConnection();
            $educations = array();
            $result = $db->query("SELECT id, img, degree, branch, school_name, date_of_education, short_description, status FROM education "
                . "WHERE resume_id = '$resumeId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $educations[$i]['id'] = $row['id'];
                $educations[$i]['img'] = $row['img'];
                $educations[$i]['degree'] = $row['degree'];
                $educations[$i]['branch'] = $row['branch'];
                $educations[$i]['school_name'] = $row['school_name'];
                $educations[$i]['date_of_education'] = $row['date_of_education'];
                $educations[$i]['short_description'] = $row['short_description'];
                $educations[$i]['status'] = $row['status'];
                $i++;
            }
            return $educations;
        }
    }

    public static function getEducationsByUser($userId = false)
    {
        if ($userId) {
            $db = Db::getConnection();
            $educations = array();
            $result = $db->query("SELECT id, img, degree, branch, school_name, date_of_education, short_description, status FROM education "
                . "WHERE user_id = '$userId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $educations[$i]['id'] = $row['id'];
                $educations[$i]['img'] = $row['img'];
                $educations[$i]['degree'] = $row['degree'];
                $educations[$i]['branch'] = $row['branch'];
                $educations[$i]['school_name'] = $row['school_name'];
                $educations[$i]['date_of_education'] = $row['date_of_education'];
                $educations[$i]['short_description'] = $row['short_description'];
                $educations[$i]['status'] = $row['status'];
                $i++;
            }
            return $educations;
        }
    }

    public static function createEducation($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO education '
            . '(user_id, resume_id, degree, branch, school_name, date_of_education, short_description, status)'
            . 'VALUES '
            . '(:user_id, :resume_id, :degree, :branch, :school_name, :date_of_education, :short_description, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':degree', $options['degree'], PDO::PARAM_STR);
        $result->bindParam(':branch', $options['branch'], PDO::PARAM_STR);
        $result->bindParam(':school_name', $options['school_name'], PDO::PARAM_STR);
        $result->bindParam(':date_of_education', $options['date_of_education'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':resume_id', $options['resume_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute())
            return $db->lastInsertId();

        return 0;
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
                user_id = :user_id,
                resume_id = :resume_id, 
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':degree', $options['degree'], PDO::PARAM_STR);
        $result->bindParam(':branch', $options['branch'], PDO::PARAM_STR);
        $result->bindParam(':school_name', $options['school_name'], PDO::PARAM_STR);
        $result->bindParam(':date_of_education', $options['date_of_education'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':resume_id', $options['resume_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
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