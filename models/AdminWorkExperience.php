<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 22.05.2018
 * Time: 15:44
 */

/**
 * Класс AdminWorkExperience - модель для работы с опытом работы пользователей в административной панели
 */
class AdminWorkExperience
{
    /**
     * Возвращает список опыта работы пользователей
     * @return array <p>Массив с опытом работы пользователей</p>
     */
    public static function getListOfWorkExperiences()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, company_name, position, date_of_experience, short_description FROM work_experience ORDER BY id ASC');
        $listOfWorkExperiences = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $listOfWorkExperiences[$i]['id'] = $row['id'];
            $listOfWorkExperiences[$i]['company_name'] = $row['company_name'];
            $listOfWorkExperiences[$i]['position'] = $row['position'];
            $listOfWorkExperiences[$i]['date_of_experience'] = $row['date_of_experience'];
            $listOfWorkExperiences[$i]['short_description'] = $row['short_description'];
            $i++;
        }
        return $listOfWorkExperiences;
    }

    /**
     * Добавляет новый опыт работы
     * @param array $options <p>Массив с информацией об опыте работы</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createWorkExperience($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO work_experience '
            . '(company_name, position, date_of_experience, short_description, status)'
            . 'VALUES '
            . '(:company_name, :position, :date_of_experience, :short_description, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':position', $options['position'], PDO::PARAM_STR);
        $result->bindParam(':date_of_experience', $options['date_of_experience'], PDO::PARAM_STR);
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
     * Возвращает опыт работы пользователя по индентификатору
     * @param integer $id <p>id опыта работы</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
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
     * Редактирует опыт работы пользователя с заданным id
     * @param integer $id <p>id опыта работы</p>
     * @param array $options <p>Массив с информацей об опыте работы</p>
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
                status = :status
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':position', $options['position'], PDO::PARAM_STR);
        $result->bindParam(':date_of_experience', $options['date_of_experience'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Удаляет опыт работы с указанным id
     * @param integer $id <p>id опыта работы</p>
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