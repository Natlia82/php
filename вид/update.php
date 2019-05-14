<!DOCTYPE html>
<html>
<head>
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
                <li><a href="sass.html">Здесь</a></li>
                <li><a href="badges.html">Ничего</a></li>
                <li><a href="collapsible.html">Нет</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h5 class="left-align"><span class="teal-text text-lighten-2">ВОПРОС ОТ:<?php echo " ".$question[data]; ?></span></h5>
        <form class="col s10" action="?c=admin&a=update&id=<?php echo $question[id];?>" method="post">
            <div class="input-field col s10">
                <div class="left teal-text text-lighten-2">Автор:</div>
                <textarea id="textarea1" class="materialize-textarea teal-text text-lighten-2" name="autor"><?php echo $question[autor]; ?></textarea>
            </div>
            <h7 class="left-align"><span class="teal-text text-lighten-2">Выбранная тема:</span></h7>
            <div class="row">

                <div class="row">

                    <select class="browser-default  col s10 teal-text text-lighten-2" name="option">
                        <?php

                        foreach ($topics as $top) :
                            if ($top[0] == $question[id_topic]) {
                                ?>
                                <option  value="<?php echo $top[0]; ?>" disabled selected><?php echo $top[1]; ?></option>
                            <?php } ?>
                            <option value="<?php echo $top[0]; ?>"><?php echo $top[1]; ?></option>
                            <?php
                        endforeach;

                        ?>

                    </select>
                    <div class="input-field col s10">
                        <div class="left teal-text text-lighten-2">Вопрос:</div>
                        <textarea id="textarea1" class="materialize-textarea teal-text text-lighten-2" name="textarea"><?php echo $question[question]; ?></textarea>
                    </div>
                    <div class="input-field col s10">
                        <div class="left teal-text text-lighten-2">Ответ:</div>
                        <textarea id="textarea1" class="materialize-textarea teal-text text-lighten-2" name="textarea2"><?php echo $question[answer]; ?></textarea>
                    </div>
                </div>
                <p>
                    <label>
                        <input type="checkbox" name="checkbox" <?php if ($question[status]==1) {$chec = "checked='checke'";} else $chec = ""; echo $chec;?>/>
                        <span class="teal-text text-lighten-2">Опубликован</span>
                    </label>
                </p>
                <button class="btn waves-effect waves-light" type="submit" name="action">Сохранить изменения
                </button>
                <button class="btn waves-effect waves-light" type="submit" name="submit" formaction="?c=admin&a=delet&id=<?php echo $question[id];?>">Удалить вопрос
                </button>
                <button class="btn waves-effect waves-light" type="submit" name="submit2">Отмена
                </button>
            </form>
        </div>

    </div>


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
