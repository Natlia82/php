<?php
/**
 * Первый уровень понимания роутеров.
 * Намерено сделано через if и else
 * Пример урла: /?c={controller}&a={action}&{param1}={value1}&{param2}={value2}
 * /?c=book&a=update&id=1
  /?c=book&a=add
 */
if (! isset($_GET['c']) || ! isset($_GET['a'])) {
    $controller = 'book';
    $action = 'list';
} else {
    $controller = $_GET['c'];
    $action = $_GET['a'];
}
if ($controller == 'book') {
    include 'controller/Controller.php';
    $Controller = new Controller();
    if ($action == 'list') {
        $Controller->getList();
        //controllerList();
    }

   elseif ($action == 'admin') {
      $Controller->admin();

   }
   elseif ($action == 'adminlist') {
  //   echo "router";
      if (isset($_GET['id'])) {
        $param = $_GET['id'];
      } else {
        $param = null;
      }
      $Controller->adminlist($param);
   }
   elseif ($action == 'update') {
     echo "router".$_GET['id'];
         $Controller->update($_GET['id']);
       //controllerUpdate();
     }

   } 


 ?>
