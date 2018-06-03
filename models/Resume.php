<?php

class Resume
{
    const SHOW_BY_DEFAULT = 1;

    public static function getResumesListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            $resumes = array();
            $result = $db->query("SELECT id, img, name, headline, short_description, location, salary, gender FROM resume "
                . "WHERE status = '1' AND category_id = '$categoryId' "
                . "ORDER BY id DESC "
                . "LIMIT ".self::SHOW_BY_DEFAULT
                . ' OFFSET '. $offset);

            $i = 0;
            while ($row = $result->fetch()) {
                $resumes[$i]['id'] = $row['id'];
                $resumes[$i]['img'] = $row['img'];
                $resumes[$i]['name'] = $row['name'];
                $resumes[$i]['headline'] = $row['headline'];
                $resumes[$i]['short_description'] = $row['short_description'];
                $resumes[$i]['location'] = $row['location'];
                $resumes[$i]['salary'] = $row['salary'];
                $resumes[$i]['gender'] = $row['gender'];
                $i++;
            }

            return $resumes;
        }
    }

    public static function getTotalResumesInCategory($categoryId)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM resume '
            . 'WHERE status="1" AND category_id ="'.$categoryId.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function getCountResumes()
    {
        $db = Db::getConnection();
        $resumes = $db->query("SELECT COUNT(*) as count FROM resume")->fetchColumn();
        return $resumes;
    }

    public static function getLatestResume($page = 1)
    {
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        $resumesList = array();

        $result = $db->query('SELECT id, user_id, img,  name, headline, short_description, location, salary, gender FROM resume '
            . 'WHERE status = "1"'
            . 'ORDER BY id DESC '
            . " LIMIT " . self::SHOW_BY_DEFAULT
            . ' OFFSET ' . $offset);

        $i = 0;
        while ($row = $result->fetch()) {
            $resumesList[$i]['id'] = $row['id'];
            $resumesList[$i]['img'] = $row['img'];
            $resumesList[$i]['name'] = $row['name'];
            $resumesList[$i]['headline'] = $row['headline'];
            $resumesList[$i]['short_description'] = $row['short_description'];
            $resumesList[$i]['location'] = $row['location'];
            $resumesList[$i]['salary'] = $row['salary'];
            $resumesList[$i]['gender'] = $row['gender'];
            $i++;
        }
        return $resumesList;
    }

    public static function getTotalResumesList()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM resume '
            . 'WHERE status="1"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function getResumeList()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, headline, short_description, website_address, email_address FROM resume ORDER BY id ASC');
        $resumesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $resumesList[$i]['id'] = $row['id'];
            $resumesList[$i]['name'] = $row['name'];
            $resumesList[$i]['headline'] = $row['headline'];
            $resumesList[$i]['short_description'] = $row['short_description'];
            $resumesList[$i]['website_address'] = $row['website_address'];
            $resumesList[$i]['email_address'] = $row['email_address'];
            $i++;
        }
        return $resumesList;
    }

    public static function getResumesByUser($userId = false)
    {
        if ($userId) {
            $db = Db::getConnection();
            $resumes = array();
            $result = $db->query("SELECT id, img, name, headline, location, salary, status FROM resume "
                . "WHERE user_id = '$userId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $resumes[$i]['id'] = $row['id'];
                $resumes[$i]['img'] = $row['img'];
                $resumes[$i]['name'] = $row['name'];
                $resumes[$i]['headline'] = $row['headline'];
                $resumes[$i]['location'] = $row['location'];
                $resumes[$i]['salary'] = $row['salary'];
                $resumes[$i]['status'] = $row['status'];
                $i++;
            }
            return $resumes;
        }
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