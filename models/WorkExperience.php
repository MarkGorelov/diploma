<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 18:36
 */

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

    /**
     * Выводим список последних созданных учебных учреждений текущим пользователем
     */
    public static function getWorkExperienceByUser($userId = false)
    {
        if ($userId) {
            $db = Db::getConnection();
            $educations = array();
            $result = $db->query("SELECT id, img, company_name , position , date_of_experience, short_description, status FROM work_experience "
                . "WHERE user_id = '$userId' "
                . "ORDER BY id DESC ");

            $i = 0;
            while ($row = $result->fetch()) {
                $educations[$i]['id'] = $row['id'];
                $educations[$i]['img'] = $row['img'];
                $educations[$i]['company_name'] = $row['company_name'];
                $educations[$i]['position'] = $row['position'];
                $educations[$i]['date_of_experience'] = $row['date_of_experience'];
                $educations[$i]['short_description'] = $row['short_description'];
                $educations[$i]['status'] = $row['status'];
                $i++;
            }
            return $educations;
        }
    }

    /**
     * Добавляет новое образование
     * @param array $options <p>Массив с информацией о образование</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createWorkExperience($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO work_experience '
            . '(user_id, resume_id, company_name, position, date_of_experience, short_description, status)'
            . 'VALUES '
            . '(:user_id, :resume_id, :company_name, :position, :date_of_experience, :short_description, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':position', $options['position'], PDO::PARAM_STR);
        $result->bindParam(':date_of_experience', $options['date_of_experience'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
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
    public static function updateWorkExperienceById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
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

        // Получение и возврат результатов. Используется подготовленный запрос
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

    /**
     * Удаляет образование с указанным id
     * @param integer $id <p>id образования</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteWorkExperienceById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM work_experience WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImg = 'no-img.jpg';

        // Путь к папке с картинками пользователями
        $path = '/upload/img/work_experience/';

        // Путь к изображению пользователя
        $pathToUserImg = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToUserImg)) {
            // Если изображение для пользователя существует
            // Возвращаем путь изображения пользователя
            return $pathToUserImg;
        }
        // Возвращаем путь изображения-пустышки
        return $path . $noImg;
    }
}