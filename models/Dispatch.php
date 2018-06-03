<?php

class Dispatch
{
    public static function getAddEmailForDispatch($email)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO dispatch '
            . '(email)'
            . 'VALUES '
            . '(:email)';

        $result = $db->prepare($sql);
        $result->bindParam(':email', strip_tags($email), PDO::PARAM_STR);

        if ($result->execute())
            return $db->lastInsertId();

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