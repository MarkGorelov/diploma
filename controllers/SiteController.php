<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 06.05.2018
 * Time: 12:52
 */

/**
 * Контроллер SiteController
 */
class SiteController extends UserBase
{
    public function actionIndex()
    {
        $categories = array();
        $categories = AdminCategory::getCategoriesList();

        $latestVacancies = array();
        $latestVacancies = Vacancy::getLatestVacancy();

        require_once(ROOT . '/views/site/index.php');
        return true;
    }
}