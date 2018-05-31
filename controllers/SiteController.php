<?php

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
        $categories = AdminCategory::getPopularCategoriesList(6);

        $latestVacancies = array();
        $latestVacancies = Vacancy::getLatestVacancy();

        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    public function actionContact() {

        $userEmail = '';
        $userText = '';
        $result = false;

        if (isset($_POST['submit'])) {

            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            if (!User::checkEmail($userEmail))
                $errors[] = 'Неправильный email';

            if ($errors == false) {
                $adminEmail = 'gorelov.dev@gmail.com';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }
        require_once(ROOT . '/views/site/contact.php');
        return true;
    }
}