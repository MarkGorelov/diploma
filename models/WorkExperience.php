<?php

class WorkExperience
{
    public static function getWorkExperienceById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM work_experience WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    public static function getWorkExperienceListByResume($resumeId = false)
    {
        if ($resumeId) {
            $db = Db::getConnection();
            $workExperience = array();
            $result = $db->query("SELECT id, img, company_name , position , date_of_experience, short_description, status FROM work_experience "
                . "WHERE resume_id = '$resumeId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $workExperience[$i]['id'] = $row['id'];
                $workExperience[$i]['img'] = $row['img'];
                $workExperience[$i]['company_name'] = $row['company_name'];
                $workExperience[$i]['position'] = $row['position'];
                $workExperience[$i]['date_of_experience'] = $row['date_of_experience'];
                $workExperience[$i]['short_description'] = $row['short_description'];
                $workExperience[$i]['status'] = $row['status'];
                $i++;
            }
            return $workExperience;
        }
    }

    public static function getWorkExperienceByUser($userId = false)
    {
        if ($userId) {
            $db = Db::getConnection();
            $workExperience = array();
            $result = $db->query("SELECT id, img, company_name , position , date_of_experience, short_description, status FROM work_experience "
                . "WHERE user_id = '$userId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $workExperience[$i]['id'] = $row['id'];
                $workExperience[$i]['img'] = $row['img'];
                $workExperience[$i]['company_name'] = $row['company_name'];
                $workExperience[$i]['position'] = $row['position'];
                $workExperience[$i]['date_of_experience'] = $row['date_of_experience'];
                $workExperience[$i]['short_description'] = $row['short_description'];
                $workExperience[$i]['status'] = $row['status'];
                $i++;
            }
            return $workExperience;
        }
    }

    public static function createWorkExperience($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO work_experience '
            . '(user_id, resume_id, company_name, position, date_of_experience, short_description, status)'
            . 'VALUES '
            . '(:user_id, :resume_id, :company_name, :position, :date_of_experience, :short_description, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':position', $options['position'], PDO::PARAM_STR);
        $result->bindParam(':date_of_experience', $options['date_of_experience'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':resume_id', $options['resume_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute())
            return $db->lastInsertId();

        return 0;
    }

    public static function updateWorkExperienceById($id, $options)
    {
        $db = Db::getConnection();

        $sql = "UPDATE work_experience
            SET 
                company_name = :company_name, 
                position = :position, 
                date_of_experience = :date_of_experience, 
                short_description = :short_description,
                user_id = :user_id,
                resume_id = :resume_id, 
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':position', $options['position'], PDO::PARAM_STR);
        $result->bindParam(':date_of_experience', $options['date_of_experience'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':resume_id', $options['resume_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    public static function deleteWorkExperienceById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM work_experience WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getImage($id)
    {
        $noImg = 'no-img.jpg';

        $path = '/upload/img/work_experience/';

        $pathToUserImg = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToUserImg))
            return $pathToUserImg;

        return $path . $noImg;
    }
}