<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 29.05.2018
 * Time: 16:31
 */

class Dispatch
{
    public static function getAddEmailForDispatch($email)
    {
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO dispatch '
            . '(email)'
            . 'VALUES '
            . '(:email)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            return true;

        return false;
    }

    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM dispatch WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;

        return false;
    }
}