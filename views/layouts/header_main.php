<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Post a job position or create your online resume by TheJobs!">
    <meta name="keywords" content="">

    <title>DreamWork</title>

    <!-- Styles -->
    <link href="template/css/app.min.css" rel="stylesheet">
    <link href="template/css/custom.css" rel="stylesheet">

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
                    <li><a href="/">Войти</a></li>
                    <li><a href="/">Регистрация</a></li>
                </ul>
            </div>
        </div>
        <!-- END user -->

        <!-- nav-menu -->
        <ul class="nav-menu">
            <li>
                <a href="index.html">Главная</a>
            </li>
            <li>
                <a href="#">Ищу работу</a>
                <ul>
                    <li><a href="job-list-1.html">Найти работу</a></li>
                    <li><a href="job-detail.html">Создать резюме</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Ищу сотрудников</a>
                <ul>
                    <li><a href="resume-list.html">Найти резюме</a></li>
                    <li><a href="resume-detail.html">Создать вакансию</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Помощь</a>
                <ul>
                    <li><a href="page-about.html">О нас</a></li>
                    <li><a href="page-contact.html">Контакты</a></li>
                    <li><a href="page-faq.html">FAQ</a></li>
                </ul>
            </li>
        </ul>
        <!-- END nav-menu -->

    </div>
</nav>
<!-- END navigation -->

<!-- Site header -->
<header class="site-header size-lg text-center" style="background-image: url(/template/img/bg-banner1.jpg)">
    <div class="container">
        <div class="col-xs-12">
            <br><br>
            <h2>
                Мы предлагаем
                <mark>1 259</mark>
                вакансий прямо сейчас!
            </h2>
            <h5 class="font-alt">Найди работу своей мечты.</h5>
            <br><br><br>
            <form class="header-job-search">
                <div class="input-keyword">
                    <input type="text" class="form-control" placeholder="Название должности или компании">
                </div>

                <div class="input-location">
                    <input type="text" class="form-control" placeholder="Страну, город">
                </div>

                <div class="btn-search">
                    <button class="btn btn-primary" type="submit">Найти работу</button>
                    <a href="">Расширенный поиск работы</a>
                </div>
            </form>
        </div>
    </div>
</header>
<!-- END Site header -->