<?php
session_start();
include 'model/admin.php';
include 'model/questions.php';
class ControllerAdmin
{
    /**
    *Ввод пароля администратор
    **/
    public function admin() {
        if (isset($_POST['log']) and isset($_POST['pass'])) {
            $log = $_POST['log'];
            $pas = $_POST['pass'];
            $admin = new Admin();
            $admin = $admin -> adminPassword($log, $pas);

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
            $topic = new Admin();

            //добавить администратора при нажатие открываются поля для ввода при повторном нажатие поля не видны
            if (isset($_POST["newadmin"])) {
                if (!$_SESSION["newadmin"]) {
                    $_SESSION["newadmin"] = 'true';
                } else {
                    unset($_SESSION["newadmin"]);
                }
            }

            //массив всех тем
            $topics = $topic->topicsAll();
            //массив всех вопросов
            $question = $topic -> QuestionAll();
            //массив всех админов
            $administrator = $topic -> AdminAll();
            //если выбран чекбокс показывать без ответа
            if ($_POST["checkbox"] == on) {
                //  echo "мы и тут";
                $_SESSION["checkbox"] = "checked='checke'";
                // массив всех вопросов без ответа отсортированных по дате
                $question = $topic -> QuestionAllSorted();
            } else {
                $_SESSION["checkbox"] = "";
                $question = $topic -> QuestionAll();
            }
            Di::get()->render('view/adminlist.php', ['topics' => $topics, 'question' => $question, 'administrator' => $administrator ]);
        }
    }

    /******
    *  удаление администратора
    ****/
    public function admindel($param) {
        $topic = new Admin();
        //удаление админив
        if ($param !== null) {
            $del = $topic -> AdminDelete($param);
        }
        // перенаправляем на главную стр администратира
        header('Location: /index.php?c=admin&a=adminlist');
    }

    /******
    ****добавляем администратора
    ****/
    public function adminadd() {
        $topic = new Admin();
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
        $topic = new Admin();
        //отмена перенаправляем на страницу администратора
        if (isset($_POST['cansel'])) {
            header('Location: /index.php?c=admin&a=adminlist');
        }

        // сохраняем изменения и перенаправляем на страницу администратора

        if (isset($_POST["action"])) {

            //сохраняем изменения
            $ins = $topic-> adminUpdate($_POST["login"], $_POST["password"], $param);
            header('Location: /index.php?c=admin&a=adminlist');
        }


        //массив с информацией о админе
        $question = $topic->adminfind($param);

        Di::get()->render('view/admupdate.php', ['question' => $question]);
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
            $topic = new Admin();
            $ins = $topic-> topicsAdd($_POST["newtema"]);
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
            $topic = new Admin();
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
        $topic = new Questions();
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
        $topic = new Questions();
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
        $question = $topic->Questionsfind($params);
        //массив всех тем
        $topics = $topic->topicsAll();
        Di::get()->render('view/update.php', ['question' => $question, 'topics' => $topics]);

    }

}

?>
