<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 22.05.2018
 * Time: 15:42
 */

/**
 * Класс AdminEducation - модель для работы с учебными учреждениями в административной панели
 */
class AdminEducation
{
    /**
     * Возвращает список учебных учреждений пользователя
     * @return array <p>Массив с учебными учреждениями пользователя</p>
     */
    public static function getListOfEducations()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, school_name, date_of_education, degree, short_description FROM education ORDER BY id ASC');
        $listOfEducations = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $listOfEducations[$i]['id'] = $row['id'];
            $listOfEducations[$i]['school_name'] = $row['school_name'];
            $listOfEducations[$i]['short_description'] = $row['short_description'];
            $listOfEducations[$i]['degree'] = $row['degree'];
            $listOfEducations[$i]['date_of_education'] = $row['date_of_education'];
            $i++;
        }
        return $listOfEducations;
    }

    /**
     * Добавляет новое учебное учреждение
     * @param array $options <p>Массив с информацией об учебных учреждениях</p>
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
     * Возвращает учебное учреждение по индентификатору
     * @param integer $id <p>id учебного учреждения</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
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
     * Редактирует учебное учреждение с заданным id
     * @param integer $id <p>id учебного учреждения</p>
     * @param array $options <p>Массив с информацей об учебном учреждении</p>
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
     * Удаляет учебное учреждение с указанным id
     * @param integer $id <p>id учебного учреждение</p>
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