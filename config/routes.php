<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 05.05.2018
 * Time: 19:22
 */

return array(

    'companies' => 'company/index', // actionIndex в CompanyController
    'company/([0-9]+)' => 'company/view/$1', // actionView в CompanyController

    'vacancies' => 'vacancy/index', //actionIndex в VacancyController
    'vacancy/([0-9]+)' => 'vacancy/view/$1', //actionView в VacancyController

    'user/register' => 'user/register', // actionRegister в UserController
    'user/login' => 'user/login', //actionLogin в UserController
    'user/logout' => 'user/logout', //actionLogout в UserController

    'cabinet/edit' => 'cabinet/edit', //actionEdit в CabinetController
    'cabinet' => 'cabinet/index', //actionIndex в CabinetController

    '' => 'site/index', // actionIndex в SiteController

);