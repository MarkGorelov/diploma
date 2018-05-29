<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Post a job position or create your online resume by TheJobs!">
    <meta name="keywords" content="">

    <title>DreamWork</title>

    <!-- Styles -->
    <link href="/template/css/app.min.css" rel="stylesheet">
    <link href="/template/css/custom.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700'
          rel='stylesheet' type='text/css'>

</head>

<body class="nav-on-header">

<!--Navigation -->
<nav class="navbar">
    <div class="container">

        <!-- logo -->
        <div class="pull-left">
            <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

            <div class="logo-wrapper">
                <a class="logo" href="/"><img src="/template/img/logo.png" alt="logo"></a>
                <a class="logo-alt" href="/"><img src="/template/img/logo-alt.png" alt="logo-alt"></a>
            </div>
        </div>
        <!-- END logo -->

        <!-- user -->
        <div class="pull-right">
            <div class="dropdown user-account">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                    <img src="/template/img/user_avatar.png" alt="avatar">
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <?php if (User::isGuest()): ?>
                        <li><a href="/user/login/">Войти</a></li>
                        <li><a href="/user/register/">Регистрация</a></li>
                    <?php else: ?>
                        <li><a href="/cabinet/">Аккаунт</a></li>
                        <li><a href="/user/logout/">Выход</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- END user -->

        <!-- nav-menu -->
        <ul class="nav-menu">
            <li>
                <a href="/">Главная</a>
            </li>
            <li>
                <a href="#">Ищу работу</a>
                <ul>
                    <li><a href="/vacancies-category/3/page-1">Найти работу</a></li>
                    <li><a href="/companies-category/3/page-1">Найти компанию</a></li>
                    <li><a href="/resume-manage/create">Создать резюме</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Ищу сотрудников</a>
                <ul>
                    <li><a href="/resumes-category/3/page-1">Найти резюме</a></li>
                    <li><a href="/company-manage/create">Создать компанию</a></li>
                    <li><a href="/vacancy-manage/create">Создать вакансию</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Помощь</a>
                <ul>
                    <li><a href="/">О нас</a></li>
                    <li><a href="/">Контакты</a></li>
                    <li><a href="/">FAQ</a></li>
                </ul>
            </li>
        </ul>
        <!-- END nav-menu -->

    </div>
</nav>
<!-- END navigation -->