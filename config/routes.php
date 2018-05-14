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

    // Управление пользователями:
    'admin/user/create' => 'adminUser/create',
    'admin/user/update/([0-9]+)' => 'adminUser/update/$1',
    'admin/user/delete/([0-9]+)' => 'adminUser/delete/$1',
    'admin/user' => 'adminUser/index',

    // Управление категориями:
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    // Управление компаниями:
    'admin/company/create' => 'adminCompany/create',
    'admin/company/update/([0-9]+)' => 'adminCompany/update/$1',
    'admin/company/delete/([0-9]+)' => 'adminCompany/delete/$1',
    'admin/company' => 'adminCompany/index',

    'admin' => 'admin/index',

    '' => 'site/index', // actionIndex в SiteController

);