<?php

class User
{
    public static function getCountUsers()
    {
        $db = Db::getConnection();
        $users=$db->query("SELECT COUNT(*) as count FROM user")->fetchColumn();
        return $users;
    }

    public static function register($name, $email, $password, $role)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO user (name, email, password, role) '
            . 'VALUES (:name, :email, :password, :role)';

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $hash, PDO::PARAM_STR);
        $result->bindParam(':role', $role, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function edit($id, $name, $password)
    {
        $db = Db::getConnection();

        $sql = "UPDATE user 
            SET name = :name, password = :password 
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';
        $check = password_verify($password, $hash);

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $check, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if ($user)
            return $user['id'];

        return false;
    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        if (isset($_SESSION['user']))
            return $_SESSION['user'];

        header("Location: /user/login");
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user']))
            return false;

        return true;
    }

    public static function checkName($name)
    {
        if (strlen($name) >= 2)
            return true;

        return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 6)
            return true;

        return false;
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

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;

        return false;
    }

    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();

            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }

    public static function getUsersList()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, email, role FROM user ORDER BY id ASC');

        $usersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $usersList[$i]['id'] = $row['id'];
            $usersList[$i]['name'] = $row['name'];
            $usersList[$i]['email'] = $row['email'];
            $usersList[$i]['role'] = $row['role'];
            $i++;
        }
        return $usersList;
    }

    public static function createUser($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO user '
            . '(name, email, password, role)'
            . 'VALUES '
            . '(:name, :email, :password, :role)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':password', $options['password'], PDO::PARAM_STR);
        $result->bindParam(':role', $options['role'], PDO::PARAM_STR);

        if ($result->execute())
            return $db->lastInsertId();

        return 0;
    }

    public static function updateUserById($id, $options)
    {
        $db = Db::getConnection();

        $sql = "UPDATE user
            SET 
                name = :name, 
                email = :email, 
                password = :password, 
                role = :role
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':password', $options['password'], PDO::PARAM_STR);
        $result->bindParam(':role', $options['role'], PDO::PARAM_STR);
        return $result->execute();
    }

    public static function deleteUserById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM user WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}