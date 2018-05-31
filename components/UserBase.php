<?php

abstract class UserBase
{
    public static function checkAspirant()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        if ($user['role'] == 'aspirant')
            return true;

        die('К сожалению, вы не имеете доступа к данной части сайта :(');
    }

    public static function checkEmployer()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        if ($user['role'] == 'employer')
            return true;

        die('К сожалению, вы не имеете доступа к данной части сайта :(');
    }

    public static function checkAdmin()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        if ($user['role'] == 'admin')
            return true;

        die('К сожалению, вы не имеете доступа к административной части сайта :(');
    }
}