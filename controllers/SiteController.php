<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 06.05.2018
 * Time: 12:52
 */

include_once ROOT . '/models/Resumes.php';

class SiteController
{
    public function actionIndex()
    {
        require_once(ROOT . '/views/site/index.php');
        return true;
    }
}