<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 15.05.2018
 * Time: 20:23
 */

class Resume
{
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
     * Возвращает список резюме
     * @return array <p>Массив с резюме</p>
     */
    public static function getResumeList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, headline, short_description, website_address, email_address FROM resume ORDER BY id ASC');
        $vacanciesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $vacanciesList[$i]['id'] = $row['id'];
            $vacanciesList[$i]['name'] = $row['name'];
            $vacanciesList[$i]['headline'] = $row['headline'];
            $vacanciesList[$i]['short_description'] = $row['short_description'];
            $vacanciesList[$i]['website_address'] = $row['website_address'];
            $vacanciesList[$i]['email_address'] = $row['email_address'];
            $i++;
        }
        return $vacanciesList;
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
            . '(name, headline, short_description, location, website_address, salary, age, phone_number, email_address, gender, tag_id, education_id, work_experience_id, category_id, status)'
            . 'VALUES '
            . '(:name, :headline, :short_description, :location, :website_address, :salary, :age, :phone_number, :email_address, :gender, :tag_id, :education_id, :work_experience_id, :category_id, :status)';

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
        $result->bindParam(':tag_id', $options['tag_id'], PDO::PARAM_INT);
        $result->bindParam(':education_id', $options['education_id'], PDO::PARAM_INT);
        $result->bindParam(':work_experience_id', $options['work_experience_id'], PDO::PARAM_INT);
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
                tag_id = :tag_id, 
                education_id = :education_id, 
                work_experience_id = :work_experience_id, 
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
        $result->bindParam(':tag_id', $options['tag_id'], PDO::PARAM_INT);
        $result->bindParam(':education_id', $options['education_id'], PDO::PARAM_INT);
        $result->bindParam(':work_experience_id', $options['work_experience_id'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
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