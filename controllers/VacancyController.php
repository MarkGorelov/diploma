<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 09.05.2018
 * Time: 17:47
 */

class VacancyController
{
    public function actionIndex()
    {
        $latestVacancies = array();
        $latestVacancies = Vacancy::getLatestVacancy();

        $categories = array();
        $categories = Category::getCategoryList();

        require_once(ROOT . '/views/vacancy/index.php');
        return true;
    }

    public function actionView($vacancyId)
    {
        $vacancy = Vacancy::getVacancyById($vacancyId);

        require_once(ROOT . '/views/vacancy/view.php');
        return true;
    }
}