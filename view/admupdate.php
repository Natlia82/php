<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
    <nav>
        <div class="nav-wrapper teal lighten-2">
            <a href="#" class="brand-logo">Вопросник</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="admin.php">Администаторы</a></li>
                <li><a href="badges.html">Контакты</a></li>
                <li><a href="collapsible.html">Инфа</a></li>
            </ul>
        </div>
    </nav>

    <form action="?c=admin&a=adminlist&b=updadm&id=<?php echo $question['id'];?>" method="post">
        <div class="container">
            <div class="row">
                <div class="input-field col s4">
                    <input id="first_name" type="text" class="validate" name="login" value="<?php echo $question['login'];?>">
                    <label for="first_name">Логин</label>
                </div>
                <div class="input-field col s4">
                    <input id="last_name" type="text" class="validate" name="password" value="<?php echo $question['password'];?>">
                    <label for="first_name">Пароль</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Сохранить</button>
            <button class="btn waves-effect waves-light" type="submit" name="cansel">Отменить</button>
        </div>
    </form>

    <footer class="page-footer  teal lighten-2">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Footer</h5>
                    <p class="grey-text text-lighten-4">Здесь могла быть информация о Вас</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Подробнее</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Адресс</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Телефон</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">FB</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Контакт</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2019 Работа над проектом
                <a class="grey-text text-lighten-4 right" href="#!">2019 год</a>
            </div>
        </div>
    </footer>
    <!--JavaScript at end of body for optimized loading-->

    <script type="text/javascript" src="js/materialize.min.js"></script>

</body>
</html>
