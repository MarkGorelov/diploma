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
        $email = '';

        if (isset($_POST['submit'])) {

            $email = $_POST['email'];

            $errors = false;

            if (!Dispatch::checkEmail($email))
                $errors[] = 'Неправильный email';

            if ($errors == false)
                $result = Dispatch::getAddEmailForDispatch($email);
        }

        $categories = array();
        $categories = AdminCategory::getCategoriesList(6);

        $latestVacancies = array();
        $latestVacancies = Vacancy::getLatestVacancy();

        require_once(ROOT . '/views/site/index.php');
        return true;
    }
}