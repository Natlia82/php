<?php
session_start();
include 'model/model.php';
class Controller
{
  /**
  * главная страница пользователя
  */
  public function getList()
  {   $topic = new Topic();
    //добавление нового вопроса
    if (isset($_POST['but'])) {
      if ($_SESSION['getList']) {
        unset($_SESSION['getList']);
      }
      else {
        $_SESSION['getList'] = true;
      }
    }
    if (isset($_POST['butcancel'])) {
      unset($_SESSION['getList']);
    }
    // при нажатие на кнопку сохранить добавляем вопрос
    if (isset($_POST['butinsert'])) {
      if (empty($_POST['text']) and empty($_POST['textarea'])) {
      } else {
        $insertTopic = $topic->insv($_POST['text'], $_POST['textarea'], $_POST['select']);
        unset($_SESSION['getList']);
      }
    }
    //получение всех тем
    $allTopics = $topic->findAll();
    //получение всех вопросов
    $question = $topic -> findAllQuestion();
    Di::get()->render('model/list.php', ['allTopics' => $allTopics, 'question' => $question]);
  }
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
        header('Location: /index.php?c=topic&a=adminlist');

      } elseif ($log == 'admin' and $pas == 'admin') {
        $_SESSION['variable'] = "true";
        header('Location: /index.php?c=topic&a=adminlist');
      } else  unset($_SESSION['variable']);
    }
    Di::get()->render('model/admin.php');
  }
  /**
  *главная страница для администратора
  **/
  public function adminlist($param) {
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
      //сохраняем нового администратора
      if (isset($_POST["savadmin"])) {
        $ins = $topic-> addadmin($_POST["login"], $_POST["passw"]);
        unset($_SESSION["new"]);
      }
      //удаление админив
      if ($param !== null) {
        $del = $topic -> delAdmin($param);
      }
      //добавить новую тему при нажатие открываются поля для ввода
      if (isset($_POST["new"])) {
        if (!$_SESSION["new"]) {
          $_SESSION["new"] = 'true';
        } else {
          unset($_SESSION["new"]);
        }
      }
      // отменить добавление темы
      if (isset($_POST["cansel"])) {
        unset($_SESSION["new"]);
      }
      //сохраняем новую тему
      if (isset($_POST["save"])) {
        $ins = $topic-> add($_POST["newtema"]);
        unset($_SESSION["new"]);
      }
      //кнопка удалить тему , открывается доп меню для удаления
      if (isset($_POST["delet"])) {
        if (!$_SESSION["delet"]) {
          $_SESSION["delet"] = 'true';
        } else {
          unset($_SESSION["delet"]);
        }
      }
      // отменить удаления
      if (isset($_POST["cansel2"])) {
        unset($_SESSION["delet"]);
      }
      //удаление темы
      if (isset($_POST["del"])) {
        $del = $topic -> del($_POST["option"]);
        unset($_SESSION["delet"]);
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
      Di::get()->render('model/adminlist.php', ['topics' => $topics, 'question' => $question, 'administrator' => $administrator ]);
    }
  }

  /**
  * Редактирование вопроса
  */
  public function update($params)
  {
    $topic = new Topic();
    //отмена перенаправляем на страницу администратора
    if (isset($_POST['submit2'])) {
      header('Location: /index.php?c=topic&a=adminlist');
    }
    // удаляем вопрос и перенаправляем на страницу администратора
    if (isset($_POST['submit'])) {
      $delete = $topic -> deleteQuestion($params);
      header('Location: /index.php?c=topic&a=adminlist');
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
      header('Location: /index.php?c=topic&a=adminlist');
    }

    //массив с информацией о вопросе
    $question = $topic->find($params);
    //массив всех тем
    $topics = $topic->findAll();
    Di::get()->render('model/update.php', ['question' => $question, 'topics' => $topics]);

  }

}

?>
