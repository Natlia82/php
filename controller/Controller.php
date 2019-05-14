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

        //получение всех тем
        $allTopics = $topic->findAll();
        //получение всех вопросов
        $question = $topic -> findAllQuestion();
        Di::get()->render('view/list.php', ['allTopics' => $allTopics, 'question' => $question]);
    }

    /***
    ***добавлнеи вопроса
    **/
    public function questionAdd()
    {
        //добавление нового вопроса появляютя поля для ввода вопроса
        if (isset($_POST['but'])) {
            if ($_SESSION['getList']) {
                unset($_SESSION['getList']);
            }
            else {
                $_SESSION['getList'] = true;
            }
            //перенаправляем  на страницу пользователя
            header('Location: /index.php?c=topic&a=list');
        }
        // кнопка отмены
        if (isset($_POST['butcancel'])) {
            unset($_SESSION['getList']);
            //перенаправляем  на страницу пользователя
            header('Location: /index.php?c=topic&a=list');
        }
        // при нажатие на кнопку сохранить добавляем вопрос
        if (isset($_POST['butinsert'])) {
            if (empty($_POST['text']) and empty($_POST['textarea'])) {
            } else {
                $topic = new Topic();
                $insertTopic = $topic->insv($_POST['text'], $_POST['textarea'], $_POST['select']);
                unset($_SESSION['getList']);
            }
            //перенаправляем  на страницу пользователя
            header('Location: /index.php?c=topic&a=list');
        }
    }

}

?>
