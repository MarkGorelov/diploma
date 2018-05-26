<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 19:06
 */

class Tag
{
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

    /**
     * Выводим список добавленых тегов текущим пользователем
     */
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

    /**
     * Добавляет новое образование
     * @param array $options <p>Массив с информацией о образование</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createTag($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO tag '
            . '(user_id, resume_id, name, status)'
            . 'VALUES '
            . '(:user_id, :resume_id, :name, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':resume_id', $options['resume_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Редактирует образование с заданным id
     * @param integer $id <p>id образования</p>
     * @param array $options <p>Массив с информацей о образовании</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateTagById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE tag
            SET 
                name = :name, 
                user_id = :user_id,
                resume_id = :resume_id, 
                status = :status
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':resume_id', $options['resume_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Удаляет образование с указанным id
     * @param integer $id <p>id образования</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteTagById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM tag WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}