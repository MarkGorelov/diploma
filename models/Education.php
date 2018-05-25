<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 17:29
 */

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

    /**
     * Выводим список последних созданных учебных учреждений текущим пользователем
     */
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

    /**
     * Добавляет новое образование
     * @param array $options <p>Массив с информацией о образование</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createEducation($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO education '
            . '(user_id, resume_id, degree, branch, school_name, date_of_education, short_description, status)'
            . 'VALUES '
            . '(:user_id, :resume_id, :degree, :branch, :school_name, :date_of_education, :short_description, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':degree', $options['degree'], PDO::PARAM_STR);
        $result->bindParam(':branch', $options['branch'], PDO::PARAM_STR);
        $result->bindParam(':school_name', $options['school_name'], PDO::PARAM_STR);
        $result->bindParam(':date_of_education', $options['date_of_education'], PDO::PARAM_STR);
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
    public static function updateEducationById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
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

        // Получение и возврат результатов. Используется подготовленный запрос
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

    /**
     * Удаляет образование с указанным id
     * @param integer $id <p>id образования</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteEducationById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM education WHERE id = :id';

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
        $path = '/upload/img/education/';

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