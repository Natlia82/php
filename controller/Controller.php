<?php
session_start();
include 'model/model.php';
class Controller
{
    /**
     * Получение всех книг
     */
    public function getList()
    {  if (isset($_POST['but'])) {
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

        if (isset($_POST['butinsert'])) {
          if (empty($_POST['text']) and empty($_POST['textarea'])) {
       ///
     } else {
              $book = new Book();
              $books = $book->insv($_POST['text'], $_POST['textarea'], $_POST['select']);
              unset($_SESSION['getList']);
         }

        }

        $book = new Book();
        $books = $book->findAll();
        $question = $book -> findAllQuestion();
        Di::get()->render('model/list.php', ['books' => $books, 'question' => $question]);
    }
    /**
    *Ввод пароля администратор
    **/
    public function admin() {
        if (isset($_POST['log']) and isset($_POST['pass'])) {
        $log = $_POST['log'];
        $pas = $_POST['pass'];
        $admin = new Book();
        $admin = $admin -> adminInput($log, $pas);

       if (!empty($admin)) {
        $_SESSION['variable'] = $admin[0][0];
         header('Location: /index.php?c=book&a=adminlist');

    } elseif ($log == 'admin' and $pas == 'admin') {
       $_SESSION['variable'] = "true";
       header('Location: /index.php?c=book&a=adminlist');
     } else  unset($_SESSION['variable']);
      }

      Di::get()->render('model/admin.php');
    }

    /**
    *Вxод администраторa
    **/

   public function adminlist($param) {
  //   echo "привет";
    if (empty($_SESSION['variable'])) {
        header('Location: /');
    } else {
    //   echo "controller";
            $book = new Book();
            if (isset($_POST["new"])) {
              if (!$_SESSION["new"]) {
                $_SESSION["new"] = 'true';
              } else {
                       unset($_SESSION["new"]);
                     }
            }
            if (isset($_POST["delet"])) {
              if (!$_SESSION["delet"]) {
                $_SESSION["delet"] = 'true';
              } else {
                       unset($_SESSION["delet"]);
                     }
            }
            if (isset($_POST["cansel2"])) {
               unset($_SESSION["delet"]);
            }

            if (isset($_POST["del"])) {
               $del = $book -> del($_POST["option"]);
               unset($_SESSION["delet"]);
            }
            if (isset($_POST["cansel"])) {
               unset($_SESSION["new"]);
            }

            if (isset($_POST["save"])) {
            //  $sql = "INSERT INTO `topic`(`mane`) VALUES ('".$_POST["newtema"]."')";
            //  $dbcon->exec($sql);
               $ins = $book-> add($_POST["newtema"]);
               unset($_SESSION["new"]);
            }

         $books = $book->findAll();
         $question = $book -> findAllQuestion();
         $administrator = $book -> findAdmin();
         if ($param !== null) {
           $del = $book -> delAdmin($param);
         }

         if (isset($_POST["newadmin"])) {
           if (!$_SESSION["newadmin"]) {
             $_SESSION["newadmin"] = 'true';
           } else {
                    unset($_SESSION["newadmin"]);
                  }
         }

         if (isset($_POST["savadmin"])) {
            $ins = $book-> addadmin($_POST["login"], $_POST["passw"]);
            unset($_SESSION["new"]);
         }

        //   echo "мы тут";
        if ($_POST["checkbox"] == on) {
        //  echo "мы и тут";
          $_SESSION["checkbox"] = "checked='checke'";

          $question = $book -> findAllQuestion2();
          } else {
                   $_SESSION["checkbox"] = "";
                //   echo "и сдесь";

                   $question = $book -> findAllQuestion();
                 }


         Di::get()->render('model/adminlist.php', ['books' => $books, 'question' => $question, 'administrator' => $administrator ]);

    }

   }

   /**
    * Редактирование данных
    */
    public function update($params)
   {
               $book = new Book();
               $books = $book->find($params);
              echo "</br>"."тутик ".$books;
             Di::get()->render('model/update.php', ['result' => $result]);

   }

	/**
	 *
	 */
/*	function add()
	{
        $book = new Book();
	    $errors = [];
        if (count($_POST) > 0) {
            $data = [];
            if (isset($_POST['name']) && preg_match('/[A-zА-я\s]+/', $_POST['name'])) {
                $data['name'] = $_POST['name'];
            } else {
                $errors['name'] = 'Error name';
            }
            if (isset($_POST['author']) && preg_match('/[A-zА-я\s]+/', $_POST['author'])) {
                $data['author'] = $_POST['author'];
            } else {
                $errors['author'] = 'Error author';
            }
            if (isset($_POST['year']) && is_numeric($_POST['year'])) {
                $data['year'] = $_POST['year'];
            } else {
                $errors['year'] = 'Error year';
            }
            if (isset($_POST['genre']) && preg_match('/[A-zА-я\s]+/', $_POST['author'])) {
                $data['genre'] = $_POST['genre'];
            } else {
                $errors['genre'] = 'Error genre';
            }
            if (count($errors) == 0) {
                $idAdd = $book->add($data);
                if ($idAdd) {
                    header('Location: /');
                }
            }
        }
        Di::get()->render('book/add.php');
    }


}
*/ }

?>
