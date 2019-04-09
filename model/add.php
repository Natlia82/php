<?php
include 'connect.php';
coonSQL();
//$kod = 1;
$idvopr = $_GET["id"];
$i = 0;
$result = $dbcon->query("SELECT * FROM question where id = $idvopr");
$znac = $result->fetch(PDO::FETCH_NUM);
if ($znac[4] == 1) {
  $chec = "checked='checke'";
} else {
  $chec = "";
}

if (isset($_POST["action"])) {

if ($_POST["checkbox"] == on) {
  $status = 1;
} else {
  $status = 0;
}

if ($_POST["option"]) {
  $option = $_POST["option"];
} else $option = $znac[5];

    $sql = "UPDATE `question` SET `question`= '".$_POST["textarea"]."' ,
    `answer`= '".$_POST["textarea2"]."',`status`= '".$status."', `id_topic`= '".$option."',`autor`= '".$_POST["autor"]."'  WHERE `id`= $idvopr";
    $dbcon->exec($sql);
  //  echo '<meta http-equiv="refresh" content="0;URL=list.php">';
             header('Location: index1.php');

}

if (isset($_POST['submit'])) {
  $sql = "DELETE FROM `question` WHERE id = '".$idvopr."'";
  $dbcon->exec($sql);
   header('Location: index1.php');
}
if (isset($_POST['submit2'])) {

   header('Location: index1.php');
}

?>

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
   <h5 class="left-align"><span class="teal-text text-lighten-2">ВОПРОС ОТ:<?php echo " ".$znac[3]; ?></span></h5>
  <form class="col s10" method="post">
   <div class="input-field col s10">
     <div class="left teal-text text-lighten-2">Автор:</div>
     <textarea id="textarea1" class="materialize-textarea teal-text text-lighten-2" name="autor"><?php echo $znac[6]; ?></textarea>
   </div>
      <h7 class="left-align"><span class="teal-text text-lighten-2">Выбранная тема:</span></h7>
      <div class="row">

           <div class="row">

              <select class="browser-default  col s10 teal-text text-lighten-2" name="option">
              <?php
              $i = 0;
                $result = $dbcon->query("SELECT * FROM topic");
                while ($row = $result->fetch(PDO::FETCH_NUM)) {
                if ($row[0] == $znac[5]) {
                  $tema = $row[1];
                    ?>
                <option  value="" disabled selected><?php echo $row[1]; ?></option>
                 <?php
               }
                 $i++;
                 ?>
                   <option value="<?php echo $i; ?>"><?php echo $row[1]; ?></option>
                  <?php


                }

                ?>

              </select>
             <div class="input-field col s10">
               <div class="left teal-text text-lighten-2">Вопрос:</div>
               <textarea id="textarea1" class="materialize-textarea teal-text text-lighten-2" name="textarea"><?php echo $znac[1]; ?></textarea>
             </div>
             <div class="input-field col s10">
               <div class="left teal-text text-lighten-2">Ответ:</div>
               <textarea id="textarea1" class="materialize-textarea teal-text text-lighten-2" name="textarea2"><?php echo $znac[2]; ?></textarea>
             </div>
           </div>
           <p>
            <label>
              <input type="checkbox" name="checkbox" <?php echo $chec;?>/>
              <span class="teal-text text-lighten-2">Опубликован</span>
            </label>
          </p>
           <button class="btn waves-effect waves-light" type="submit" name="action">Сохранить изменения
           </button>
           <button class="btn waves-effect waves-light" type="submit" name="submit">Удалить вопрос
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
