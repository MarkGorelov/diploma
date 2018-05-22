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
     * Возвращает массив образований для списка в админпанели <br/>
     * (при этом в результат попадают и включенные и выключенные компании)
     * @return array <p>Массив компаний</p>
     */
    public static function getEducationListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, school_name, degree, branch, short_description FROM education ORDER BY id ASC');

        $listOfEducation = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $listOfEducation[$i]['id'] = $row['id'];
            $listOfEducation[$i]['school_name'] = $row['school_name'];
            $listOfEducation[$i]['degree'] = $row['degree'];
            $listOfEducation[$i]['branch'] = $row['branch'];
            $listOfEducation[$i]['short_description'] = $row['short_description'];
            $i++;
        }
        return $listOfEducation;
    }

    public static function getEducationListByResume()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, school_name, degree, branch, short_description, date_of_education FROM education ORDER BY id ASC');

        $listOfEducation = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $listOfEducation[$i]['id'] = $row['id'];
            $listOfEducation[$i]['school_name'] = $row['school_name'];
            $listOfEducation[$i]['degree'] = $row['degree'];
            $listOfEducation[$i]['branch'] = $row['branch'];
            $listOfEducation[$i]['short_description'] = $row['short_description'];
            $listOfEducation[$i]['date_of_education'] = $row['date_of_education'];
            $i++;
        }
        return $listOfEducation;
    }

    /**
     * Возвращает список образования
     * @return array <p>Массив с образования</p>
     */
    public static function getEducationList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, school_name, date_of_education, degree, short_description FROM education ORDER BY id ASC');
        $listOfEducation = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $listOfEducation[$i]['id'] = $row['id'];
            $listOfEducation[$i]['school_name'] = $row['school_name'];
            $listOfEducation[$i]['short_description'] = $row['short_description'];
            $listOfEducation[$i]['degree'] = $row['degree'];
            $listOfEducation[$i]['date_of_education'] = $row['date_of_education'];
            $i++;
        }
        return $listOfEducation;
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
            . '(degree, branch, school_name, date_of_education, short_description, status)'
            . 'VALUES '
            . '(:degree, :branch, :school_name, :date_of_education, :short_description, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':degree', $options['degree'], PDO::PARAM_STR);
        $result->bindParam(':branch', $options['branch'], PDO::PARAM_STR);
        $result->bindParam(':school_name', $options['school_name'], PDO::PARAM_STR);
        $result->bindParam(':date_of_education', $options['date_of_education'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
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