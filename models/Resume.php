<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 20:23
 */

class Resume
{

    const SHOW_BY_DEFAULT = 4;

    /*
     * Returns an array of vacancies
     */
    public static function getLatestResume($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $resumesList = array();

        $result = $db->query('SELECT id, img,  name, headline, short_description, tag_id, location, salary, gender FROM resume '
            . 'WHERE status = "1"'
            . 'ORDER BY id DESC '
            . 'LIMIT ' . $count);

        $i = 0;
        while ($row = $result->fetch()) {
            $resumesList[$i]['id'] = $row['id'];
            $resumesList[$i]['img'] = $row['img'];
            $resumesList[$i]['name'] = $row['name'];
            $resumesList[$i]['headline'] = $row['headline'];
            $resumesList[$i]['short_description'] = $row['short_description'];
            $resumesList[$i]['tag_id'] = $row['tag_id'];
            $resumesList[$i]['location'] = $row['location'];
            $resumesList[$i]['salary'] = $row['salary'];
            $resumesList[$i]['gender'] = $row['gender'];
            $i++;
        }
        return $resumesList;
    }

    /**
     * Возвращает список резюме
     * @return array <p>Массив с резюме</p>
     */
    public static function getResumeList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
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

    /**
     * Выводим список последних созданных резюме текущим пользователем
     */
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

    /**
     * Добавляет новое резюме
     * @param array $options <p>Массив с информацией о резюме</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createResume($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO resume '
            . '(name, headline, short_description, location, website_address, salary, age, phone_number, email_address, gender, category_id, user_id, status)'
            . 'VALUES '
            . '(:name, :headline, :short_description, :location, :website_address, :salary, :age, :phone_number, :email_address, :gender, :category_id, :user_id, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':headline', $options['headline'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':location', $options['location'], PDO::PARAM_STR);
        $result->bindParam(':website_address', $options['website_address'], PDO::PARAM_STR);
        $result->bindParam(':salary', $options['salary'], PDO::PARAM_INT);
        $result->bindParam(':age', $options['age'], PDO::PARAM_INT);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_INT);
        $result->bindParam(':email_address', $options['email_address'], PDO::PARAM_STR);
        $result->bindParam(':gender', $options['gender'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Редактирует резюме с заданным id
     * @param integer $id <p>id резюме</p>
     * @param array $options <p>Массив с информацей о резюме</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateResumeById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
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

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':headline', $options['headline'], PDO::PARAM_STR);
        $result->bindParam(':short_description', $options['short_description'], PDO::PARAM_STR);
        $result->bindParam(':location', $options['location'], PDO::PARAM_STR);
        $result->bindParam(':website_address', $options['website_address'], PDO::PARAM_STR);
        $result->bindParam(':salary', $options['salary'], PDO::PARAM_INT);
        $result->bindParam(':age', $options['age'], PDO::PARAM_INT);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_INT);
        $result->bindParam(':email_address', $options['email_address'], PDO::PARAM_STR);
        $result->bindParam(':gender', $options['gender'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Возвращает резюме по индентификатору
     * @param integer $id <p>id резюме</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
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

    /**
     * Удаляет резюме с указанным id
     * @param integer $id <p>id резюме</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteResumeById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM resume WHERE id = :id';

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
        $path = '/upload/img/resume/';

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