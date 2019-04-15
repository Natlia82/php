<?php
if (! isset($_GET['c']) || ! isset($_GET['a'])) {
  $controller = 'topic';
  $action = 'list';
} else {
  $controller = $_GET['c'];
  $action = $_GET['a'];
}
if ($controller == 'topic') {
  include 'controller/Controller.php';
  $Controller = new Controller();
  //стартавая страница пользователя
  if ($action == 'list') {
    $Controller->getList();
  }
  //страница для ввода пароля
  elseif ($action == 'admin') {
    $Controller->admin();
  }

  //главная страница администратора
  elseif ($action == 'adminlist') {
    if (isset($_GET['id'])) {
      $param = $_GET['id'];
    } else {
      $param = null;
    }
    $Controller->adminlist($param);
  }
  
  //редактирование вопроса
  elseif ($action == 'update') {
    $Controller->update($_GET['id']);
  }

}

?>
