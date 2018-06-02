<?php

class CabinetController
{
    public function actionIndex()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    public function actionSendingLetter()
    {
        $toUsers = '';
        $userEmail = '';
        $userText = '';
        $result = false;

        if (isset($_POST['submit'])) {

            $toUsers =  $_POST['toUsers'];
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            if (!User::checkEmail($userEmail))
                $errors[] = 'Неправильный email';

            if ($errors == false) {
                $toUsers = "Отправитель: {$toUsers}" . ",";
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($toUsers, $subject, $message);
                $result = true;
            }
        }
        require_once(ROOT . '/views/cabinet/sendingLetters.php');
        return true;
    }
}