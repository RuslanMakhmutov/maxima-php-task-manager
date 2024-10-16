<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $meta_title ?? \app\Helpers\Config::option('app_name') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
        }

        a:hover,
        a:focus {
            text-decoration: none;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            font-size: 16px;
            font-family: sans-serif;
            line-height: 1.5;
            color: #333;
        }

        #app {
            padding: 0 15px;
            max-width: 980px;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
            background-color: cornflowerblue;
            padding: 10px;
        }

        nav {
            padding: 10px;
            background-color: navajowhite;
            display: flex;
            flex-wrap: wrap;
            gap: 20px
        }

        main {

        }

        main p {
            text-align: justify;
        }
    </style>
</head>
<body>
<div id="app">
    <header>
        <nav>
            <a href="/">Главная страница</a>
            <a href="/login">Вход</a>
            <a href="/registration">Регистрация</a>
            <a href="/tasks">Список задач</a>
        </nav>
    </header>
    <main>
