<?php
if (! isset($_GET['c']) || ! isset($_GET['a'])) {
    $controller = 'topic';
    $action = 'list';
} else {
    $controller = $_GET['c'];
    $action = $_GET['a'];
}

// страница пользователя
if ($controller == 'topic') {
    include 'controller/Controller.php';
    $controller = new Controller();

    //стартавая страница пользователя
    if ($action == 'list') {
        $controller->getList();
    }
    //добавление вопроса
    elseif ($action == 'questionAdd') {
        $controller->questionAdd();
    }
}


//страница для ввода пароля
elseif ($controller == 'admin') {
    include 'controller/ControllerAdmin.php';
    $controllerAdmin = new ControllerAdmin();
    if (isset($_GET['b'])) {
        $activity = $_GET['b'];
    }
    else {
        $activity = null;
    }
    if ($action == 'pass')  {
        $controllerAdmin->admin();
    }


    //главная страница администратора
    elseif ($action == 'adminlist') {
        if (isset($_GET['id'])) {
            $param = $_GET['id'];
        } else {
            $param = null;
        }
        // стартовая страница администратора
        if ($activity == null) {
            $controllerAdmin->adminlist();
        }
        // удаление администратора
        elseif ($activity == 'deladm') {
            $controllerAdmin->admindel($param);
        }
        //добавление админситраора
        elseif  ($activity == 'adminadd') {
            $controllerAdmin->adminadd();
        }
        //изменяем администратора
        elseif ($activity == 'updadm') {
            $controllerAdmin->updadm($param);
        }
        //добавляем новую тему
        elseif ($activity == 'topicAdd') {
            $controllerAdmin->topicAdd();
        }
        //удаление темы
        elseif ($activity == 'topicDell') {
            $controllerAdmin->topicDell();
        }

    }

    //редактирование вопроса
    elseif ($action == 'update') {
        $controllerAdmin->update($_GET['id']);
    }
    //удаление вопроса
    elseif ($action == 'delet') {
        $controllerAdmin->delet($_GET['id']);
    }

}

?>
