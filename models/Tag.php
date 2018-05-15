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
     * Возвращает массив тегов для списка в админпанели <br/>
     * (при этом в результат попадают и включенные и выключенные тегов)
     * @return array <p>Массив тегов</p>
     */
    public static function getTagListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
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

    /**
     * Возвращает список тегов
     * @return array <p>Массив с тегами</p>
     */
    public static function getTagList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
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

    /**
     * Добавляет новый тег
     * @param array $options <p>Массив с тегами</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createTag($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO tag '
            . '(name, status)'
            . 'VALUES '
            . '(:name, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Редактирует тег с заданным id
     * @param integer $id <p>id тега</p>
     * @param array $options <p>Массив с тегами</p>
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
                status = :status
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Удаляет тег с указанным id
     * @param integer $id <p>id тега</p>
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