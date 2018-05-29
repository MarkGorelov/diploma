<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 29.05.2018
 * Time: 16:43
 */

class CatalogController
{
    public function actionVacancy($categoryId, $page = 1)
    {
        $categories = array();
        $categories = AdminCategory::getCategoriesList();

        $categoryVacancies = array();
        $categoryVacancies = Vacancy::getVacanciesListByCategory($categoryId, $page);

        $total = Vacancy::getTotalVacanciesInCategory($categoryId);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Vacancy::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/vacancy.php');
        return true;
    }

    public function actionResume($categoryId, $page = 1)
    {
        $categories = array();
        $categories = AdminCategory::getCategoriesList();

        $categoryResumes = array();
        $categoryResumes = Resume::getResumesListByCategory($categoryId, $page);

        $total = Resume::getTotalResumesInCategory($categoryId);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Resume::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/resume.php');
        return true;
    }

    public function actionCompany($categoryId, $page = 1)
    {
        $categories = array();
        $categories = AdminCategory::getCategoriesList();

        $categoryCompanies = array();
        $categoryCompanies = Company::getCompaniesListByCategory($categoryId, $page);

        $total = Company::getTotalCompaniesInCategory($categoryId);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Vacancy::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/company.php');
        return true;
    }
}