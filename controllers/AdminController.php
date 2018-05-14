<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 14.05.2018
 * Time: 16:14
 */

/**
 * Контроллер AdminController
 * Главная страница в админпанели
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартовой страницы "Панель администратора"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Подключаем вид
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }
}