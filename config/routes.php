<?php

return array(

    // Каталог с категорями для вакансий, резюме, компаний
    'vacancies-category/([0-9]+)/page-([0-9]+)' => 'catalog/vacancy/$1/$2',
    'resumes-category/([0-9]+)/page-([0-9]+)' => 'catalog/resume/$1/$2',
    'companies-category/([0-9]+)/page-([0-9]+)' => 'catalog/company/$1/$2',

    // Управление компаниями:
    'company-manage/create' => 'company/create',
    'company-manage/update/([0-9]+)' => 'company/update/$1',
    'company-manage/delete/([0-9]+)' => 'company/delete/$1',
    'company-manage' => 'company/manage',
    'company/([0-9]+)' => 'company/view/$1',

    // Управление вакансиями:
    'vacancy-manage/create' => 'vacancy/create',
    'vacancy-manage/update/([0-9]+)' => 'vacancy/update/$1',
    'vacancy-manage/delete/([0-9]+)' => 'vacancy/delete/$1',
    'vacancy-manage' => 'vacancy/manage',
    'vacancy/([0-9]+)' => 'vacancy/view/$1',

    // Управление тегами:
    'tag-manage/create' => 'tag/create',
    'tag-manage/update/([0-9]+)' => 'tag/update/$1',
    'tag-manage/delete/([0-9]+)' => 'tag/delete/$1',
    'tag-manage' => 'tag/manage',

    // Управление образованием:
    'education-manage/create' => 'education/create',
    'education-manage/update/([0-9]+)' => 'education/update/$1',
    'education-manage/delete/([0-9]+)' => 'education/delete/$1',
    'education-manage' => 'education/manage',

    // Управление опытом работы:
    'work-experience-manage/create' => 'workExperience/create',
    'work-experience-manage/update/([0-9]+)' => 'workExperience/update/$1',
    'work-experience-manage/delete/([0-9]+)' => 'workExperience/delete/$1',
    'work-experience-manage' => 'workExperience/manage',

    // Управление резюме:
    'resume-manage/create' => 'resume/create',
    'resume-manage/update/([0-9]+)' => 'resume/update/$1',
    'resume-manage/delete/([0-9]+)' => 'resume/delete/$1',
    'resume-manage' => 'resume/manage',
    'resumes/page-([0-9]+)' => 'resume/index/$1',
    'resume/([0-9]+)' => 'resume/view/$1',

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

    'contacts' => 'site/contact',

    'admin' => 'admin/index',

    '' => 'site/index', // actionIndex в SiteController
);