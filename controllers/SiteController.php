<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 06.05.2018
 * Time: 12:52
 */

class SiteController
{
    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoryList();

        $latestVacancies = array();
        $latestVacancies = Vacancy::getLatestVacancy();

        require_once(ROOT . '/views/site/index.php');
        return true;
    }
}