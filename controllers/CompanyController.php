<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 09.05.2018
 * Time: 15:53
 */

class CompanyController
{
    public function actionIndex()
    {
        $latestCompanies = array();
        $latestCompanies = Company::getLatestCompany(3);

        require_once(ROOT . '/views/company/index.php');
        return true;
    }

    public function actionView($companyId)
    {
        $company = Company::getCompanyById($companyId);

        $jobsCompany = array();
        $jobsCompany = Vacancy::getVacanciesListByCompany($companyId);

        require_once (ROOT . '/views/company/view.php');
        return true;
    }
}