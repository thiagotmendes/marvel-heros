<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>

<header class="main-header">
    <div class="container main-header__container">
        <div class="">
            <img src="assets/images/logo-2.svg" alt="">
        </div>
        <div class="">
            <strong> Thiago Mendes </strong> | Teste front-end
        </div>
    </div>
</header>

<section class="main-section main-section--gray">
    <div class="container container__row-app">
        <!-- Left Panel -->
        <div class="main-section__app main-section__app__left">
            <h1 class="main-title">
                Busca de personagens
            </h1>

            <div class="main-section__search">
                <input type="text" placeholder="Search" class="">
            </div>

            <div class="main-section__grid main-section__grid--header">
                <div class="">Personagens</div>
                <div class="">Séries</div>
                <div class="">Eventos</div>
            </div>
            <div id="character_list" class="main-section__character-list">
<!--                <div class="main-section__grid main-section__grid__box" data-characterid="100">-->
<!--                    teste-->
<!--                </div>-->
            </div>
        </div>
        <!-- Right Panel -->
        <div class="main-section__character-bio main-section__app main-section__app__right">
            <div class="container">
                <div id="characte_bio" class="">

                </div>
            </div>
        </div>
    </div>
</section>

<script src="./assets/js/scripts.min.js"></script>
</body>
</html>