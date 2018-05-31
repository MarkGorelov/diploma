<?php

class AdminTag
{
    public static function getTagsList()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, status FROM tag ORDER BY id ASC');
        $tagsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $tagsList[$i]['id'] = $row['id'];
            $tagsList[$i]['name'] = $row['name'];
            $tagsList[$i]['status'] = $row['status'];
            $i++;
        }
        return $tagsList;
    }

    public static function createTag($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO tag '
            . '(user_id, resume_id, name, status)'
            . 'VALUES '
            . '(:user_id, :resume_id, :name, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':resume_id', $options['resume_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute())
            return $db->lastInsertId();

        return 0;
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

    public static function updateTagById($id, $options)
    {
        $db = Db::getConnection();

        $sql = "UPDATE tag
            SET 
                name = :name,
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
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