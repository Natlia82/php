<?php
session_start();
include 'model/model.php';
class ControllerAdmin
{
    /**
    *Ввод пароля администратор
    **/
    public function admin() {
        if (isset($_POST['log']) and isset($_POST['pass'])) {
            $log = $_POST['log'];
            $pas = $_POST['pass'];
            $admin = new Topic();
            $admin = $admin -> adminInput($log, $pas);

            if (!empty($admin)) {
                $_SESSION['variable'] = $admin[0][0];
                header('Location: /index.php?c=admin&a=adminlist');

            } elseif ($log == 'admin' and $pas == 'admin') {
                $_SESSION['variable'] = "true";
                header('Location: /index.php?c=admin&a=adminlist');
            } else  unset($_SESSION['variable']);
        }
        Di::get()->render('view/admin.php');
    }

    /**
    *главная страница для администратора
    **/
    public function adminlist() {
        // если нет пароля (сессия) то на стартовую страницу
        if (empty($_SESSION['variable'])) {
            header('Location: /');
        } else {
            $topic = new Topic();

            //добавить администратора при нажатие открываются поля для ввода при повторном нажатие поля не видны
            if (isset($_POST["newadmin"])) {
                if (!$_SESSION["newadmin"]) {
                    $_SESSION["newadmin"] = 'true';
                } else {
                    unset($_SESSION["newadmin"]);
                }
            }

            //массив всех тем
            $topics = $topic->findAll();
            //массив всех вопросов
            $question = $topic -> findAllQuestion();
            //массив всех админов
            $administrator = $topic -> findAdmin();
            //если выбран чекбокс показывать без ответа
            if ($_POST["checkbox"] == on) {
                //  echo "мы и тут";
                $_SESSION["checkbox"] = "checked='checke'";
                // массив всех вопросов без ответа отсортированных по дате
                $question = $topic -> findAllQuestion2();
            } else {
                $_SESSION["checkbox"] = "";
                $question = $topic -> findAllQuestion();
            }
            Di::get()->render('view/adminlist.php', ['topics' => $topics, 'question' => $question, 'administrator' => $administrator ]);
        }
    }

    /******
    *  удаление администратора
    ****/
    public function admindel($param) {
        $topic = new Topic();
        //удаление админив
        if ($param !== null) {
            $del = $topic -> delAdmin($param);
        }
        // перенаправляем на главную стр администратира
        header('Location: /index.php?c=admin&a=adminlist');
    }

    /******
    ****добавляем администратора
    ****/
    public function adminadd() {
        $topic = new Topic();
        //сохраняем
        $ins = $topic-> addadmin($_POST["login"], $_POST["passw"]);
        unset($_SESSION["newadmin"]);
        //перенаправляем на главную стр. админа
        header('Location: /index.php?c=admin&a=adminlist');

    }

    /****
    ***изменяем админа
    ***/
    public function updadm($param) {
        // не могу передать значние из input
    }

    /***
    ** Добавление новой темы
    **/
    public function topicAdd()
    {
        //добавить новую тему при нажатие открываются поля для ввода
        if (isset($_POST["new"])) {
            if (!$_SESSION["new"]) {
                $_SESSION["new"] = 'true';
            } else {
                unset($_SESSION["new"]);
            }
            // перенаправляем на главную страницу админа
            header('Location: /index.php?c=admin&a=adminlist');
        }
        // отменить добавление темы
        if (isset($_POST["cansel"])) {
            unset($_SESSION["new"]);
            // перенаправляем на главную страницу админа
            header('Location: /index.php?c=admin&a=adminlist');
        }
        //сохраняем новую тему
        if (isset($_POST["save"])) {
            $topic = new Topic();
            $ins = $topic-> add($_POST["newtema"]);
            unset($_SESSION["new"]);
            // перенаправляем на главную страницу админа
            header('Location: /index.php?c=admin&a=adminlist');

        }

    }

    /***
    ***удаление темы
    ***/
    public function topicDell()
    {
        //кнопка удалить тему , открывается доп меню для удаления
        if (isset($_POST["delet"])) {
            if (!$_SESSION["delet"]) {
                $_SESSION["delet"] = 'true';
            } else {
                unset($_SESSION["delet"]);
            }
            // перенаправляем на главную страницу админа
            header('Location: /index.php?c=admin&a=adminlist');
        }
        // отменить удаления
        if (isset($_POST["cansel2"])) {
            unset($_SESSION["delet"]);
            // перенаправляем на главную страницу админа
            header('Location: /index.php?c=admin&a=adminlist');
        }
        //удаление темы
        if (isset($_POST["del"])) {
            $topic = new Topic();
            $del = $topic -> del($_POST["option"]);
            unset($_SESSION["delet"]);
            // перенаправляем на главную страницу админа
            header('Location: /index.php?c=admin&a=adminlist');
        }
    }



    /**
    *Удаление вопроса
    **/
    public function delet($param) {
        $topic = new Topic();
        if (!empty($param)) {
            $delete = $topic -> deleteQuestion($param);
        }
        header('Location: /index.php?c=admin&a=adminlist');
    }

    /**
    * Редактирование вопроса
    */
    public function update($params)
    {
        $topic = new Topic();
        //отмена перенаправляем на страницу администратора
        if (isset($_POST['submit2'])) {
            header('Location: /index.php?c=admin&a=adminlist');
        }

        // сохраняем изменения и перенаправляем на страницу администратора

        if (isset($_POST["action"])) {

            if ($_POST["checkbox"] == on) {
                $status = 1;
            } else {
                $status = 0;
            }

            if ($_POST["option"]) {
                $option = $_POST["option"];
            } else $option = "";
            //сохраняем изменения
            $ins = $topic-> updateQuestion($_POST["textarea"], $_POST["textarea2"], $status, $option, $_POST["autor"], $params);
            header('Location: /index.php?c=admin&a=adminlist');
        }

        //массив с информацией о вопросе
        $question = $topic->find($params);
        //массив всех тем
        $topics = $topic->findAll();
        Di::get()->render('view/update.php', ['question' => $question, 'topics' => $topics]);

    }

}

?>
