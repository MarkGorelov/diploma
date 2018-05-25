<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 05.05.2018
 * Time: 19:22
 */

return array(

    // Управление компаниями:
    'company-manage/create' => 'company/create',
    'company-manage/update/([0-9]+)' => 'company/update/$1',
    'company-manage/delete/([0-9]+)' => 'company/delete/$1',
    'company-manage' => 'company/manage',
    'companies' => 'company/index',
    'company/([0-9]+)' => 'company/view/$1',

    // Управление вакансиями:
    'vacancy-manage/create' => 'vacancy/create',
    'vacancy-manage/update/([0-9]+)' => 'vacancy/update/$1',
    'vacancy-manage/delete/([0-9]+)' => 'vacancy/delete/$1',
    'vacancy-manage' => 'vacancy/manage',
    'vacancies' => 'vacancy/index',
    'vacancy/([0-9]+)' => 'vacancy/view/$1',

    'resumes' => 'resume/index', //actionIndex в ResumeController
    'resume/([0-9]+)' => 'resume/view/$1', //actionView в ResumeController

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

    // Управление категориями в административной панели:
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    // Управление компаниями в административной панели:
    'admin/company/create' => 'adminCompany/create',
    'admin/company/update/([0-9]+)' => 'adminCompany/update/$1',
    'admin/company/delete/([0-9]+)' => 'adminCompany/delete/$1',
    'admin/company' => 'adminCompany/index',

    // Управление вакансиями в административной панели:
    'admin/vacancy/create' => 'adminVacancy/create',
    'admin/vacancy/update/([0-9]+)' => 'adminVacancy/update/$1',
    'admin/vacancy/delete/([0-9]+)' => 'adminVacancy/delete/$1',
    'admin/vacancy' => 'adminVacancy/index',

    // Управление образованием в административной панели:
    'admin/education/create' => 'adminEducation/create',
    'admin/education/update/([0-9]+)' => 'adminEducation/update/$1',
    'admin/education/delete/([0-9]+)' => 'adminEducation/delete/$1',
    'admin/education' => 'adminEducation/index',

    // Управление опыт работы в административной панели:
    'admin/work-experience/create' => 'adminWorkExperience/create',
    'admin/work-experience/update/([0-9]+)' => 'adminWorkExperience/update/$1',
    'admin/work-experience/delete/([0-9]+)' => 'adminWorkExperience/delete/$1',
    'admin/work-experience' => 'adminWorkExperience/index',

    // Управление тегами в административной панели:
    'admin/tag/create' => 'adminTag/create',
    'admin/tag/update/([0-9]+)' => 'adminTag/update/$1',
    'admin/tag/delete/([0-9]+)' => 'adminTag/delete/$1',
    'admin/tag' => 'adminTag/index',

    // Управление резюме в административной панели:
    'admin/resume/create' => 'adminResume/create',
    'admin/resume/update/([0-9]+)' => 'adminResume/update/$1',
    'admin/resume/delete/([0-9]+)' => 'adminResume/delete/$1',
    'admin/resume' => 'adminResume/index',

    'admin' => 'admin/index',

    '' => 'site/index', // actionIndex в SiteController

);