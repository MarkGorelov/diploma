<?php

class Tag
{
    public static function getTagsListByResume($resumeId = false)
    {
        if ($resumeId) {
            $db = Db::getConnection();
            $tags = array();
            $result = $db->query("SELECT id, name FROM tag "
                . "WHERE status = '1' AND resume_id = '$resumeId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $tags[$i]['id'] = $row['id'];
                $tags[$i]['name'] = $row['name'];
                $i++;
            }
            return $tags;
        }
    }

    public static function getTagById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM tag WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
    }

    public static function getTagsByUser($userId = false)
    {
        if ($userId) {
            $db = Db::getConnection();
            $tags = array();
            $result = $db->query("SELECT id, name, status FROM tag "
                . "WHERE user_id = '$userId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $tags[$i]['id'] = $row['id'];
                $tags[$i]['name'] = $row['name'];
                $tags[$i]['status'] = $row['status'];
                $i++;
            }
            return $tags;
        }
    }

    public static function createTag($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO tag '
            . '(user_id, resume_id, name, status)'
            . 'VALUES '
            . '(:user_id, :resume_id, :name, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', strip_tags($options['name']), PDO::PARAM_STR);
        $result->bindParam(':user_id', strip_tags($options['user_id']), PDO::PARAM_INT);
        $result->bindParam(':resume_id', strip_tags($options['resume_id']), PDO::PARAM_INT);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);

        if ($result->execute())
            return $db->lastInsertId();

        return 0;
    }

    public static function updateTagById($id, $options)
    {
        $db = Db::getConnection();

        $sql = "UPDATE tag
            SET 
                name = :name, 
                user_id = :user_id,
                resume_id = :resume_id, 
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', strip_tags($id), PDO::PARAM_INT);
        $result->bindParam(':name', strip_tags($options['name']), PDO::PARAM_STR);
        $result->bindParam(':user_id', strip_tags($options['user_id']), PDO::PARAM_INT);
        $result->bindParam(':resume_id', strip_tags($options['resume_id']), PDO::PARAM_INT);
        $result->bindParam(':status', strip_tags($options['status']), PDO::PARAM_INT);
        return $result->execute();
    }

    public static function deleteTagById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM tag WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}