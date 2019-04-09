<?php
session_start();
/*include 'connect.php';
coonSQL();
session_start();





if ($_POST["adminin"]) {
  echo "string";
 if (!$_SESSION["adminin"]) {
   $_SESSION["adminin"] = "true";
 } else {
   unset($_SESSION["adminin"]);
 }

}
*/

?>
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


  <form method="post">

      <div class="row">
        <div class="col s4">
        <table>
             <h6>Администраторы</h6>
                <thead>
                  <tr>
                      <th>login</th>
                      <th>password</th>
                      <th></th>
                  </tr>
                </thead>

                <tbody>
                <?php foreach ($administrator as $adm): ?>
                  <tr>
                    <td><?php echo $adm[1]; ?></td>
                    <td><?php echo $adm[2]; ?></td>
                    <td><a href="?c=book&a=adminlist&id=<?= $adm[0]?>">Удалить</a></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
              <button class="waves-effect waves-teal btn-flat col s10 left-align" type="submit" name="newadmin" >Добавить администратора</button>
              <?php if ($_SESSION['newadmin']) { ?>
              <div class="input-field inline">
                <input id="email_inline" type="text" class="validate" name="login">
                <span class="helper-text" data-error="wrong" data-success="right">Логин</span>
             </div>
             <div class="input-field inline">
               <input id="email_inline" type="text" class="validate" name="passw">
               <span class="helper-text" data-error="wrong" data-success="right">Пароль</span>
            </div>
            <button class="waves-effect waves-teal btn-flat col s10 left-align" type="submit" name="savadmin" >Сохранить</button>
            <button class="waves-effect waves-teal btn-flat col s10 left-align" type="submit" name="newadmin" >Отменить</button>
          <?php } ?>
           </div>

      <div class="col s8">
       <h5 class="left-align"><span class="teal-text text-lighten-2">Темы:</span></h5>
        <label>
        <input type="checkbox" name="checkbox" <?php echo $_SESSION["checkbox"];?>/>
        <span class="col s6 offset-s1">Показывать только без ответа</span>
      </label>

      <button class="waves-effect waves-teal btn-flat waves-light" type="sub" name="save">Применить
      </button>
    <?php
    $i = 0;
  // print_r($books);
   //echo "string.</br>";
    foreach ($books as $quest) :

     $i++;
    $button = $quest[0];

     ?>
       <button class="waves-effect waves-teal btn-flat col s10 left-align" type="submit" name="submit" ><?php  echo $quest[1]; ?>
           <i class="material-icons right">send</i>
        </button>
         <?php

              foreach ($question as $qu) :
                if ($qu[5] == $quest[0]) {
          ?>
          <a href="index.php?c=book&a=update&id=<?php echo $qu[0];?>" class="collection-item col s7 offset-s2"><?php echo $qu[1]." Создан: ".$qu[3].
             $infa = ($qu[2] == null)?' Ожидает ответа':' Отвечен'.$inf = ($qu[4] == 0)?' Скрыт':' Опубликован' ; ?></a>
          <?php
             }
            endforeach;

        endforeach;
        ?>
        <button class="waves-effect waves-teal btn-flat col s10 left-align" type="submit" name="new" >Создать тему
            <i class="material-icons right">send</i>
          </button>
      <?php
      if ($_SESSION["new"])  { ?>
        <div class="input-field col s10">
          <div class="left ">Введите название темы:</div>
          <textarea id="textarea1" class="materialize-textarea" name="newtema">Новая тема</textarea>
        </div>
        <button class="waves-effect waves-teal btn-flat waves-light" type="submit" name="save">Сохранить тему
        </button>
        <button class="waves-effect waves-teal btn-flat waves-light" type="submit" name="cansel">Отмена
        </button>
    <?php  }
      ?>
      <button class="waves-effect waves-teal btn-flat col s10 left-align" type="submit" name="delet" >Удалить тему
          <i class="material-icons right">send</i>
        </button>
         <?php
           if ($_SESSION["delet"]) {
            ?>
            <select class="browser-default  col s10" name="option">
              <option  value="" disabled selected>Выбирите тему</option>
              <?php
              $ii = 0;
               foreach ($books as $quest) :
                 $ii++;
                 ?>
                 <option value="<?php echo $quest[0]; ?>"><?php echo $quest[1]; ?></option>
                 <?php
              endforeach;
               ?>
            </select>
            <button class="waves-effect waves-teal btn-flat waves-light col s6 left-align" type="submit" name="del">Удалить тему
            </button>
            <button class="waves-effect waves-teal btn-flat waves-light col s6 left-align" type="submit" name="cansel2">Отмена
            </button>
          <?
         }
        ?>
      </div>
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
