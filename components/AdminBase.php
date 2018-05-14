<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 14.05.2018
 * Time: 16:12
 */

abstract class AdminBase
{
    /**
     * Метод, который проверяет пользователя на то, является ли он администратором
     * @return boolean
     */
    public static function checkAdmin()
    {
        // Проверяем авторизирован ли пользователь. Если нет, он будет переадресован
        $userId = User::checkLogged();

        // Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        // Если роль текущего пользователя "admin", пускаем его в админпанель
        if ($user['role'] == 'admin') {
            return true;
        }

        // Иначе завершаем работу с сообщением об закрытом доступе
        die('Access denied');
    }
}