<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 23.05.2018
 * Time: 18:47
 */

abstract class UserBase
{
    public static function checkAspirant()
    {
        // Проверяем авторизирован ли пользователь. Если нет, он будет переадресован
        $userId = User::checkLogged();

        // Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        // Если роль текущего пользователя "aspirant", пускаем его в часть сайта для соискателей
        if ($user['role'] == 'aspirant')
            return true;

        // Иначе завершаем работу с сообщением об закрытом доступе
        die('К сожалению, вы не имеете доступа к данной части сайта :(');
    }

    public static function checkEmployer()
    {
        // Проверяем авторизирован ли пользователь. Если нет, он будет переадресован
        $userId = User::checkLogged();

        // Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        // Если роль текущего пользователя "employer", пускаем его в часть сайта для работадателей
        if ($user['role'] == 'employer')
            return true;

        // Иначе завершаем работу с сообщением об закрытом доступе
        die('К сожалению, вы не имеете доступа к данной части сайта :(');
    }
}