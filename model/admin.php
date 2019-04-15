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
  <div class="container">
    <div class="row">
      <form action="?c=topic&a=admin" method="POST">
        <div class="col s4 offset-s4">
          <label for="last_name">Last Name</label>
          <input id="last_name" type="text" class="validate" name="log">
          <label for="password">Password</label>
          <input id="password" type="password" class="validate" name="pass">
        </div>
        <div class="col s4 offset-s4">
          <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
